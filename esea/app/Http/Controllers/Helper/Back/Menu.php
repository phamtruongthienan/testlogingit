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
use App\Models\MMenuTranslation;
use App\Models\MActivityLog;
use App\Models\MCustomer;
use App\Models\MNews;
use Activity;
use App\Models\MMenu;

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
                $data = MMenu::with('mMenuTranslations','mNews');
                return Datatables::of($data)
                ->editColumn('name', function ($v){
                    return $v->mMenuTranslations[0]->name;
                })
                ->editColumn('position', function ($v){
                    if($v->position == 1) {
                        return 'Header Menu';
                    } else if($v->position == 2){
                        return 'Sidebar Menu';
                    } else {
                        return 'Footer Menu';
                    }
                })
                ->editColumn('url', function ($v){
                    return $v->mMenuTranslations[0]->slug;
                })
                ->editColumn('action', function ($v){
                    return '<a' .
							' class="table-action table-action-edit text-green cursor-pointer" data-lang="'.$this->lang_id.'" data-id="' .$v->id . '"><i' .
							' class="fa fa-edit"></i></a>' .
							' <a class="table-action text-red table-action-delete cursor-pointer" data-lang="'.$this->lang_id.'" data-id="' . $v->id . '"><i' .
							' class="fa fa-trash"></i></a>';
                })
                ->rawColumns(['id','name','position','url','action'])
                ->make(true);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getMenu($id)
    {
        self::__construct();
        try {
            $data = MMenu::with('mMenuTranslationsAll','mNews.mNewsTranslations')->where('id',$id)->get();
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
                $query = MMenuTranslation::where('id',$request->id);
                $old_query = $query->first();
                if(!$query) {
                    DB::rollback();
                    return false;
                }
            }
            $data=[];
            $menu_info=[];
            if($request->has('inputEditName') && !empty($request->inputEditName)) {
                $data['name'] = $request->inputEditName;
            }

            if($request->has('inputEditPosition') && !empty($request->inputEditPosition)) {
                $menu_info['position'] = $request->inputEditPosition;
            }

            if($request->has('inputEditLink') && !empty($request->inputEditLink)) {
                if($request->action == 'update'){
                    if($request->inputEditLink != $old_query->slug) {
                        $data['slug'] = self::slugify($request->inputEditLink, '');
                    }
                } else {
                    $data['slug_name'] = $request->inputEditLink;
                    $data['slug_category'] = 'm_menu';
                    $data['slug_prefix'] = '';
                }
            }

            if($request->has('inputEditSelect') && !empty($request->inputEditSelect) && $request->inputEditSelect != 0 ) {
                $menu_info['news_id'] = $request->inputEditSelect;
                $new = MNews::with('mNewsTranslations')->where('id',$request->inputEditSelect)->get();
                if($request->action == 'update'){
                    if($new[0]->mNewsTranslations[0]->slug != $old_query->slug) {
                        $data['slug'] = self::slugify($new[0]->mNewsTranslations[0]->slug, '');
                    }
                } else {
                    $data['slug_name'] = $new[0]->mNewsTranslations[0]->slug;
                    $data['slug_category'] = 'm_menu';
                    $data['slug_prefix'] = '';
                }
            }

            if($request->action == 'update') {
                if(count($data) > 0) {
                    $translation_id = $old_query->translation_id;
                    $query->update($data);         
                    if($query) {
                        $menu = MMenu::where('id',$translation_id)->first();
                        if($menu->news_id != $request->inputEditSelect){
                            $menu->update($menu_info);
                        }
                        if(!$menu){
                            DB::rollback();
                            return false;
                        }
                    } else{
                        DB::rollback();
                        return false;
                    }
                }
            } else if($request->action == 'delete') {
                $newTrans = MMenuTranslation::where('translation_id',$request->id)->delete();
                if(!$newTrans) {
                    DB::rollback();
                    return false;
                } else {
                    $menu = MMenu::where('id',$request->id)->delete();
                    if(!$menu){
                        DB::rollback();
                        return false;
                    } 
                }
            } else if($request->action == 'insert') {
                $menu = MMenu::create($menu_info);
                if(!$menu){
                    DB::rollback();
                    return false;
                } else {
                    if($request->has('inputEditLink') && !empty($request->inputEditLink)) {
                        $trans = self::renderTrans($menu->mMenuTranslations(), $data, $data['slug_name']);
                    } 
                    if($request->has('inputEditSelect') && !empty($request->inputEditSelect) && $request->inputEditSelect != 0 ) {
                        $trans = self::renderTrans($menu->mMenuTranslations(), $data, $data['slug_name']);
                    } 
                }
                if($trans){
                    DB::commit();
                    return true;
                }
            }
            if ($menu) {
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