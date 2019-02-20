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
use Validator;
use Hash;
use Socialite;
use Auth;
use Carbon\Carbon;
use App\Models\MSchoolEvent;
use App\Models\MSchoolEventTranslation;

class Event extends Controller
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
    public function postEvent($request)
    {
        self::__construct();
        try {
            DB::beginTransaction();
            if($request->action == 'update' || $request->action == 'delete') {
                $query = MSchoolEvent::find($request->id);
								$old_query = MSchoolEventTranslation::where('translation_id', $request->id)
										->where('language_id', $request->lang)
										->first();
                if(!$query) {
                    DB::rollback();
                    return false;
                }
            }
            $data = [];
            $data_relationship = [];
						$img_translation = [];
            if($request->has('name') && !empty($request->name)) {
							$data_relationship['name'] = $request->name;
            }
						if($request->has('content') && !empty($request->content)) {
							$data_relationship['content'] = $request->content;
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
							$data_relationship['logo'] = $path;
						}
						if($request->has('slug') && !empty($request->slug)) {
							if($request->action == 'update'){
								if($request->slug != $old_query->slug) {
									$data_relationship['slug'] = self::slugify($request->slug, 'promo');
								}
							} else {
								$data_relationship['slug_name'] = $request->slug;
								$data_relationship['slug_category'] = 'm_school_event';
								$data_relationship['slug_prefix'] = 'promo';
							}
						}
      
						if($request->has('type') && !empty($request->type)) {
							$data['type'] = $request->type;
						}
						if($request->has('target') && !empty($request->target)) {
							$data['target'] = implode(",",$request->target);
						}
						if($request->has('date_type') && !empty($request->date_type)) {
							$data['date_type'] = $request->date_type;
							if($data['date_type'] == 1) {
								$data['start_date'] = null;
								$data['end_date'] = null;
							} else {
								$time = explode(' - ' , $request->date);
								$start_date = explode('/' , $time[0]);
								$end_date = explode('/' , $time[1]);
								$data['start_date'] = $start_date[2].'-'.$start_date[1].'-'.$start_date[0];
								$data['end_date'] = $end_date[2].'-'.$end_date[1].'-'.$end_date[0];
							}
						}
						
						if($request->has('discount_type') && !empty($request->discount_type)) {
							$data['discount_type'] = $request->discount_type;
						}
						if($request->has('discount') && !empty($request->discount)) {
							$data['discount'] = $request->discount;
						}
						if($request->has('code') && !empty($request->code)) {
							$data['code'] = $request->code;
						}
						if($request->has('position') && !empty($request->position)) {
							$data['position'] = $request->position;
						}
						if($request->status == 'on') {
							$data['status'] = 1;
						} else {
							$data['status'] = 0;
						}
						
            if($request->action == 'update') {
								if (count($data_relationship) > 0) {
									$query->mSchoolEventTranslationsAll()->where('language_id', $request->lang)->update($data_relationship);
									if (!$query) {
										DB::rollback();
										return false;
									}
									if(!empty($data_relationship['slug'])) {
										$slug = self::slugreload($old_query->slug, $data_relationship['slug'], 'm_school_event');
										if(!$slug) {
											DB::rollback();
											return false;
										}
									}
								}
								if (count($data) > 0) {
									$query->update($data);
									if (!$query) {
										DB::rollback();
										return false;
									}
								}
            } else if($request->action == 'delete') {
                $ref = MSchoolEventTranslation::where('translation_id', $request->id);
								foreach($ref->get() as $k => $v) {
									if(!empty($v->logo)) {
										array_push($img_translation, $v->logo);
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
                $query = MSchoolEvent::create($data);
                if(!$query) {
                    DB::rollback();
                    return false;
                }
                $data_relationship['translation_id'] = $query->id;
								$trans = self::renderTrans($query->mSchoolEventTranslations(), $data_relationship);
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

    public function getEvent($id, $language = 1)
    {
        self::__construct();
        try {
            $data = MSchoolEvent::with('mSchoolEventTranslationsAll')
                    ->where('id', $id)
                    ->whereHas('mSchoolEventTranslationsAll', function ($query) use ($language) {
                        $query->where('language_id', $language);
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

    public function getDTEvent()
    {
        self::__construct();
        try {
								$rate = self::ExchangeRate($this->lang_id);
								$instance = self::instance(\App\Http\Controllers\Helper\Front\Helper::class);
								$config_language = $instance->getConfigLanguage($this->lang_id);
                $data = MSchoolEvent::with('mSchoolEventTranslations');
                return Datatables::of($data)
								->editColumn('name', function ($v) {
									if(!empty($v->mSchoolEventTranslations[0]->name)) {
										return $v->mSchoolEventTranslations[0]->name;
									} else {
										return '';
									}
								})
								->editColumn('type', function ($v) {
									if(!empty($v->type)) {
										switch($v->type) {
											case 1:
												return 'Loại trường';
												break;
											case 2:
												return 'Danh sách trường';
												break;
											case 3:
												return 'Tất cả khách hàng';
												break;
											default:
												return 'Khách hàng được chọn';
										}
									} else {
										return '';
									}
								})
								->editColumn('time', function ($v) {
									if(!empty($v->start_date) && !empty($v->end_date)) {
										return Carbon::parse($v->start_date)->format('d/m/Y') . ' - ' . Carbon::parse($v->end_date)->format('d/m/Y');
									} else {
										return '';
									}
								})
								->editColumn('discount', function ($v) use ($rate, $config_language) {
									if(!empty($v->discount) && $v->discount_type == 1) {
										return $v->discount . '%';
									} else if(!empty($v->discount) && $v->discount_type == 2) {
										return number_format($v->discount/$rate)." ".$config_language[0]->currency_code;
									} else {
										return '';
									}
								})
								->editColumn('code', function ($v) {
									if(!empty($v->code)) {
										return $v->code;
									} else {
										return '';
									}
								})
								->editColumn('status', function ($v) {
									if(!empty($v->status) && $v->status == 1) {
										return '<i class="fas fa-check-circle text-green"></i>';
									} else {
										return '';
									}
								})
                ->addColumn('action', function ($v) {
                    return '<a data-toggle="tooltip" title="Chỉnh sửa sự kiện" class="table-action table-action-edit text-green cursor-pointer" data-lang="'.$this->lang_id.'" data-id="'.$v->id.'"><i class="fa fa-edit"></i></a><a data-toggle="tooltip" title="Xóa" class="table-action text-red table-action-delete cursor-pointer" data-lang="'.$this->lang_id.'" data-id="'.$v->id.'"><i class="fa fa-trash"></i></a>';
                })
								->addIndexColumn()
                ->rawColumns(['action', 'status'])
                ->make(true);
        } catch (\Exception $e) {
            return null;
        }
    }
    //DEMO
}
