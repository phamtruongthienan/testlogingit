<?php

namespace App\Http\Controllers\Helper\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
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
use App\Models\MNews;
use App\Models\MNewsTranslation;
use App\Models\MLayout;

class News extends Controller
{ 
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $lang;
    protected $lang_id;

    public function __construct()
    {
        $this->lang = LaravelLocalization::getCurrentLocale();
        $this->lang_id = LaravelLocalization::getCurrentLocaleID();
    }
    public function getDTNews()
    {
        self::__construct();
        try { 
                $data = MNews::with('mLayout','mNewsTranslations');
                return Datatables::of($data)
                ->editColumn('name', function ($v) { 
                    if(!empty($v->mNewsTranslations[0]->title)) {
                        return $v->mNewsTranslations[0]->title;
                    } else {
                        return '';
                    }
                })
                ->editColumn('layout', function ($v) { 
                    if(!empty($v->mLayout->name)) {
                        return $v->mLayout->name;
                    } else {
                        return '';
                    }
                })
                ->editColumn('active', function ($v){
                    switch($v->status) {
                        case 1:
                        return '<i class="fas fa-check-circle text-green"></i>';
                        break;
                        case 0:
                        return;
                        break;
                    }
                })
                ->addColumn('action', function ($v) {
                    return '<a' .
							' class="table-action table-action-edit text-green cursor-pointer" data-id="' . $v->id .'" data-lang="' . $this->lang_id .'"><i' .
							' class="fa fa-edit"></i></a>' .
							' <a class="table-action text-red table-action-delete cursor-pointer" data-id="'.$v->id . '"><i' .
                            ' class="fa fa-trash"></i></a>';
                })
                ->rawColumns(['active','action'])
                ->make(true);
        } catch (\Exception $e) {
            return null;
        }
    }
    public function getNews($id,$language = 1)
    {
        self::__construct();
        try {
            $data = MNews::with('mNewsTranslationsAll','mLayout')
                    ->where('id', $id)
                    ->whereHas('mNewsTranslationsAll', function ($query) use ($language) {
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

    public function postNews($request)
    {
        self::__construct();
        try {
            DB::beginTransaction();
            if($request->action == 'update' || $request->action == 'delete') {
                $query = MNews::find($request->id);
                if(!$query) {
                    DB::rollback();
                    return false;
                }
            }
            $data = [];
            $data_relationship = [];
            if($request->has('inputAddName') && !empty($request->inputAddName)) {
				$data_relationship['title'] = $request->inputAddName;
            }
            if($request->has('inputAddSEO') && !empty($request->inputAddSEO)) {
				$data_relationship['slug'] = "press/".$request->inputAddSEO;
            }
            if($request->has('inputKeyWord') && !empty($request->inputKeyWord)) {
                $data_relationship['meta_keyword'] = $request->inputKeyWord;
                $data_relationship['meta_title'] = $request->inputKeyWord;
            }
            if($request->has('inputDescription') && !empty($request->inputDescription)) {
				$data_relationship['meta_description'] = $request->inputDescription;
            }
            if($request->has('inputAddContent') && !empty($request->inputAddContent)) {
				$data_relationship['content'] = $request->inputAddContent;
            }
            if($request->has('inputAddLayout') && !empty($request->inputAddLayout)) {
				$data['layout_id'] = $request->inputAddLayout;
            }
            if($request->addStatus == 'on') {
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }
           
            
            if($request->action == 'update') {
                $query->update($data);
                if (!$query) {
                    DB::rollback();
                    return false;
                }
                if (count($data_relationship) > 0) {
                    $query->update($data);
                    $query->mNewsTranslationsAll()->where('language_id', $request->lang)->update($data_relationship);
                    if (!$query) {
                        DB::rollback();
                        return false;
                    }
                }         
            } else if($request->action == 'delete') {
                $ref = MNewsTranslation::where('translation_id', $request->id);
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
                $query = MNews::create($data);
                if(!$query) {
                    DB::rollback();
                    return false;
                }
                $data_relationship['translation_id'] = $query->id;
				$trans = self::renderTrans($query->mNewsTranslations(), $data_relationship);
                if(!$trans) {
                    DB::rollback();
                    return false;
                }
            }
            if ($query) {
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
    
}
