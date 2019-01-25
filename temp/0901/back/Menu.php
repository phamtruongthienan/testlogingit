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
use App\Models\MMenu;
use App\Models\MMenuTranslation;
use App\Models\MNewsTranslation;
use App\Models\MNews;

class Menu extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $lang;
    protected $lang_id;

    public function __construct()
    {
        $this->lang = LaravelLocalization::getCurrentLocale();
        $this->lang_id = LaravelLocalization::getCurrentLocaleID();
    }
    public function getDTMenu()
    {
        self::__construct();
        try { 
                $data = MMenu::with('mMenuTranslations');
                return Datatables::of($data)
                ->editColumn('name', function ($v) { 
                    if(!empty($v->mMenuTranslations[0]->name)) {
                        return $v->mMenuTranslations[0]->name;
                    } else {
                        return '';
                    }
                })
                ->editColumn('position', function ($v) { 
                    if(!empty($v->position)) {
                        if($v->position==1)
                            return "Header";
                        else if($v->position==2)
                            return "Sidebar";
                        else
                            return "Footer";
                    } else {
                        return '';
                    }
                })
                ->editColumn('slug', function ($v) { 
                    if(!empty($v->mMenuTranslations[0]->slug)) {
                        return $v->mMenuTranslations[0]->slug;
                    } else {
                        return '';
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
    public function getMenu($id,$language = 1)
    {
        self::__construct();
        try {
            $data = MMenu::with('mMenuTranslationsAll')
                    ->where('id', $id)
                    ->whereHas('mMenuTranslationsAll', function ($query) use ($language) {
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

    public function postMenu($request)
    {
        self::__construct();
        try {
            DB::beginTransaction();
            if($request->action == 'update' || $request->action == 'delete') {
                $query = MMenu::find($request->id);
                if(!$query) {
                    DB::rollback();
                    return false;
                }
            }
            $data = [];
            $data_relationship = [];
            if($request->has('inputAddName') && !empty($request->inputAddName)) {
				$data_relationship['name'] = $request->inputAddName;
            }
            if($request->has('inputAddPosition') && !empty($request->inputAddPosition)) {
				$data['position'] = $request->inputAddPosition;
            }
            if($request->has('inputAddLink') && !empty($request->inputAddLink)) {
                $data_relationship['slug'] = $request->inputAddLink;
            }
            if($request->has('inputAddSelect') && !empty($request->inputAddSelect)) {
                $data['news_id'] = $request->inputAddSelect;
                $query1 = MNewsTranslation::where('translation_id', $request->inputAddSelect)->where('language_id',1)->first();
                $data_relationship['slug'] = $query1->slug; 
            }
            // if($request->has('slug') && !empty($request->slug)) {
            //     if($request->action == 'update'){
            //         if($request->slug != $old_query->slug) {
            //             $data_relationship['slug'] = self::slugify($request->slug, 'promo');
            //         }
            //     } else {
                    $data_relationship['slug_name'] = "google";
                    $data_relationship['slug_category'] = 'm_menu';
                    $data_relationship['slug_prefix'] = "e";
            //     }
            // }
            
// var_dump($data_relationship); exit;

            if($request->action == 'update') {
                $query->update($data);
                if (!$query) {
                    DB::rollback();
                    return false;
                }
                if (count($data_relationship) > 0) {
                    $query->update($data);
                    $query->mMenuTranslationsAll()->where('language_id', $request->lang)->update($data_relationship);
                    if (!$query) {
                        DB::rollback();
                        return false;
                    }
                }         
            } else if($request->action == 'delete') {
                $ref = MMenuTranslation::where('translation_id', $request->id);
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
                $data['sort'] = 1;
                $query = MMenu::create($data);
                if(!$query) {
                    DB::rollback();
                    return false;
                }
                $data_relationship['translation_id'] = $query->id;
				$trans = self::renderTrans($query->mMenuTranslations(), $data_relationship);
                if(!$trans) {
                    DB::rollback();
                    return false;
                }
                $query2 = MNewsTranslation::where('translation_id', $request->inputAddSelect)->where('language_id',2)->first();
                if($query2){
                    $data_relationship['slug'] = $query2->slug; 
                    $query3 = MMenu::find($query->id);
                    $query3->mMenuTranslationsAll()->where('language_id', 2)->update($data_relationship);
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
