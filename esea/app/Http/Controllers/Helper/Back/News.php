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
use App\Models\MUser;
use App\Models\MAdvertsTranslation;
use App\Models\MActivityLog;
use App\Models\MCustomer;
use App\Models\MChild;
use Activity;
use App\Models\Role;
use App\Models\Config;
use App\Models\PermissionRole;
use App\Models\MNews;
use App\Models\MNewsTranslation;


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
            $data = MNews::with('mLayout','mNewsTranslations')->get();
            return Datatables::of($data)
            ->editColumn('title', function ($v){
                return $v->mNewsTranslations[0]->title;
            })
            ->editColumn('layout', function ($v){
                return $v->mLayout->name;
            })
            ->editColumn('active', function ($v){
                if($v->status ==1){
                    return '<i class="fas fa-check-circle text-green"></i>';
                } else {
                    return '';
                }
            })
            ->editColumn('action', function ($v){
                return '<a' .
							' class="table-action table-action-edit text-green cursor-pointer" data-lang="'.$this->lang_id.'" data-id="' .$v->id . '"><i' .
							' class="fa fa-edit"></i></a>' .
							' <a class="table-action text-red table-action-delete cursor-pointer" data-lang="'.$this->lang_id.'" data-id="' . $v->id . '"><i' .
							' class="fa fa-trash"></i></a>';
            })
            ->rawColumns(['id','title','layout','active','action'])
            ->make(true);
            
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getNews($id)
    {
        self::__construct();
        try {
            $data = MNews::with('mLayout','mNewsTranslationsAll')->where('id',$id)->get();
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
                $query = MNewsTranslation::where('id',$request->id);
                $old_query = $query->first();
                if(!$query) {
                    DB::rollback();
                    return false;
                }
            }
            $data=[];
            $news=[];
            if($request->has('inputEditName') && !empty($request->inputEditName)) {
                $data['title'] = $request->inputEditName;
            }

            if($request->has('inputEditSEO') && !empty($request->inputEditSEO)) {
                if($request->action == 'update'){
                    if($request->inputEditSEO != $old_query->slug) {
                        $data['slug'] = self::slugify($request->inputEditSEO, 'press');
                    }
                } else {
                    $data['slug_name'] = $request->inputEditSEO;
                    $data['slug_category'] = 'm_news';
                    $data['slug_prefix'] = 'press';
                }
            }

            if($request->has('inputDescription') && !empty($request->inputDescription)) {
                $data['meta_description'] = $request->inputDescription;
            }

            if($request->has('inputTitle') && !empty($request->inputTitle)) {
                $data['meta_title'] = $request->inputTitle;
            }

            if($request->has('inputKeyWord') && !empty($request->inputKeyWord)) {
                $data['meta_keyword'] = $request->inputKeyWord;
            }

            if($request->has('inputEditContent') && !empty($request->inputEditContent)) {
                $data['content'] = $request->inputEditContent;
            }

            if($request->has('inputEditLayout') && is_numeric($request->inputEditLayout)) {
                $news['layout_id'] = (int)$request->inputEditLayout;
            }

            if($request->editStatus == 'on') {
                $news['status'] = 1;
            } else {
                $news['status'] = 0;
            }

            if($request->action == 'update') {
                if(count($data) > 0) {
                    $translation_id = $old_query->translation_id;
                    $query->update($data);         
                    $new = MNews::where('id',$translation_id)->first();
                    if($new->status != $news['status']){
                        $new->update($news);
                    }
                    if(!$query && !$new) {
                        DB::rollback();
                        return false;
                    }
                }
            } else if($request->action == 'delete') {
                $newTrans = MNewsTranslation::where('translation_id',$request->id)->delete();
                if(!$newTrans) {
                    DB::rollback();
                    return false;
                } else {
                    $new = MNews::where('id',$request->id)->delete();
                    if(!$new){
                        DB::rollback();
                        return false;
                    } 
                }
            } else if($request->action == 'insert') {
                
                $new = MNews::create($news);
                if(!$new){
                    DB::rollback();
                    return false;
                } else {
                    $trans = self::renderTrans($new->mNewsTranslations(), $data);
                }
            }
            if ($new) {
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