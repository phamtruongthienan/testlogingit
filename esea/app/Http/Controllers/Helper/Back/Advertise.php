<?php

namespace App\Http\Controllers\Helper\Back;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Yajra\Datatables\Datatables;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;
use GuzzleHttp\Client;
use Validator;
use Hash;
use Socialite;
use Auth;
use Carbon\Carbon;
use App\Models\MAdvert;
use App\Models\MAdvertsTranslation;


class Advertise extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $lang;
    protected $lang_id;

    public function __construct()
    {
        $this->lang = LaravelLocalization::getCurrentLocale();
        $this->lang_id = LaravelLocalization::getCurrentLocaleID();
    }

    //DEMO
    public function postAdvertise($request)
    {
        self::__construct();
        try {
            DB::beginTransaction();
            if($request->action == 'update' || $request->action == 'delete') {
                $query = MAdvert::find($request->id);
                if(!$query) {
                    DB::rollback();
                    return false;
                }
            }
            $data = [];
            $data_relationship = [];
            $img_translation = [];
            if($request->has('type') && !empty($request->type)) {
                $data['type'] = $request->type;
            }

            if($request->has('position') && !empty($request->position)) {
                $data['position'] = $request->position;
            }

            if($request->has('target') && !empty($request->target)) {
                $data['target'] = $request->target;
            }

            if($request->has('link') && !empty($request->link)) {
                $data['link'] = $request->link;
            } else {
                $data['link'] = null;
            }

            if($request->has('start_date') && !empty($request->start_date)) {
                $data['start_date'] = $request->start_date;
            }

            if($request->has('end_date') && !empty($request->end_date)) {
                $data['end_date'] = $request->end_date;
            } else {
                $data['end_date'] = null;
            }

            if($request->status == 'on') {
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }

            if($request->has('content') && !empty($request->content)) {
                $data_relationship['content'] = $request->content;
            } else {
                $data_relationship['content'] = null;
            }

            if($request->has('image_hash') && !empty($request->image_hash)) {
                $dir = public_path('img/uploads/admin');
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, 0777, true, true);
                }
                $type = explode('/', substr($request->image_hash, 5, strpos($request->image_hash, ';')-5));
                $filename = mb_substr(md5(time().rand(1,100)),0,10).'.'.$type[1];
                $path = '/uploads/admin/' .$filename;
                $save_image = Image::make(self::DecodeImage($request->image_hash))->save(public_path('img'.$path), 100);
                $data_relationship['image'] = $path;
            }


            if($request->action == 'update') {
                if(count($data_relationship) > 0) {
                    $query->mAdvertsTranslations()->where('language_id', $this->lang_id)->update($data_relationship);
                    if(!$query) {
                        DB::rollback();
                        return false;
                    }
                }
                if(count($data) > 0) {
                    $query->update($data);
                    if(!$query) {
                        DB::rollback();
                        return false;
                    }
                }
            } else if($request->action == 'delete') {
                $ref = MAdvertsTranslation::where('translation_id', $request->id);
                foreach($ref->get() as $k => $v) {
                    if(!empty($v->image)) {
                        array_push($img_translation, $v->image);
                    }
                }
                $ref = $ref->delete();
                if(!$ref) {
                    DB::rollback();
                    return false;
                }
                $query->delete();
                if(!$query) {
                    DB::rollback();
                    return false;
                }
            } else {
                $query = MAdvert::create($data);
                if(!$query) {
                    DB::rollback();
                    return false;
                }
               
                $data_relationship['translation_id'] = $query->id;
                $trans = self::renderTrans($query->mAdvertsTranslations(), $data_relationship);
                if(!$trans) {
                    DB::rollback();
                    return false;
                }
            }
            if ($query) {
                if(count($img_translation) > 0) {
                    foreach($img_translation as $v) {
                        @unlink(public_path('img/'.$v));
                    }
                }
                DB::commit();
                return true;
            } else {
                DB::rollback();
                return false;
            }
       } catch (\Exception $e) {
           DB::rollback();
           return false;
       }
    }

    public function getAdvertise($id)
    {
        self::__construct();
        try {
            $data = MAdvert::with('mAdvertsTranslations')
                    ->where('id', $id)
                    ->whereHas('mAdvertsTranslations', function ($query) {
                        $query->where('language_id', $this->lang_id);
                    })->first();
            if (!empty($data)) {
                return self::JsonExport(200, 'success', $data);
            } else {
                return self::JsonExport(404, 'error', null);
            }
        } catch (\Exception $e) {
            return self::JsonExport(500, 'error', null);
        }
    }

    public function getDTAdvertise()
    {
        self::__construct();
        try {
                $data = MAdvert::with('mAdvertsTranslations');
                return Datatables::of($data)
                ->editColumn('type', function ($v) {
                    switch($v->type) {
                        case 1:
                        return 'Mở cửa sổ mới';
                        break;
                        case 2:
                        return 'Modal popup';
                        break;
                        case 3:
                        return 'Ảnh tĩnh';
                        break;
                        case 4:
                        return 'Video';
                        break;
                        default:
                        return 'Mở cửa sổ mới';
                    }
                })
                ->editColumn('position', function ($v) {
                    switch($v->position) {
                        case 1:
                        return 'Đầu trang';
                        break;
                        case 2:
                        return 'Cuối trang';
                        break;
                        case 3:
                        return 'Cột bên';
                        break;
                        default:
                        return 'Đầu trang';
                    }
                })
                ->editColumn('target', function ($v) {
                    switch($v->position) {
                        case 1:
                        return 'Tất cả';
                        break;
                        case 2:
                        return 'Chỉ trang chủ';
                        break;
                        case 3:
                        return 'Chi tiết trường';
                        break;
                        default:
                        return 'Tất cả';
                    }
                })
                ->editColumn('link', function ($v) {
                    if(!empty($v->link)) {
                        return '<a href="'.$v->link.'" target="_blank">'.$v->link.'</a>';
                    } else {
                        return '';
                    }
                })
                ->editColumn('status', function ($v) {
                    if($v->status == 1) {
                        return '<i class="fas fa-check-circle text-green"></i>';
                    } else {
                        return '';
                    }
                })
                ->editColumn('img', function ($v) {
                    if($v->type == 3) {
                        return '<a href="'.asset('img/'.$v->mAdvertsTranslations[0]->image).'" data-lightbox="image-'.str_random(10).'">
                        <img width="50px" height="50px" src="'.asset('img/'.$v->mAdvertsTranslations[0]->image).'" />
                        </a>';
                    } else {
                        return '';
                    }
                })
                ->addColumn('action', function ($v) {
                    return '<a class="table-action table-action-edit text-green cursor-pointer" data-id="'.$v->id.'"><i class="fa fa-edit"></i></a><a class="table-action text-red table-action-delete cursor-pointer" data-id="'.$v->id.'"><i class="fa fa-trash"></i></a>';
                })
                ->rawColumns(['status','link','type','img', 'action'])
                ->make(true);
        } catch (\Exception $e) {
            return null;
        }
    }
    //DEMO
}
