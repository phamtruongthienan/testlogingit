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
use App\Models\MSchoolCategory;
use App\Models\MSchoolCategoryTranslation;
use App\Models\MSchoolAttribute;
use App\Models\MSchoolAttributeTranslation;

class Attribute extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $lang;
    protected $lang_id;

    public function __construct()
    {
        $this->lang = LaravelLocalization::getCurrentLocale();
        $this->lang_id = LaravelLocalization::getCurrentLocaleID();
    }
    public function getDTAttribute()
    {
        self::__construct();
        try { 
                $data = MSchoolAttribute::with('mSchoolAttributeTranslations','mSchoolCategory.mSchoolCategoryTranslations');
                return Datatables::of($data)
                ->editColumn('name', function ($v) { 
                    if(!empty($v->mSchoolAttributeTranslations[0]->name)) {
                        return $v->mSchoolAttributeTranslations[0]->name;
                    } else {
                        return '';
                    }
                })
                ->editColumn('group', function ($v) { 
                    if(!empty($v->mSchoolCategory->mSchoolCategoryTranslations[0]->name)) {
                        return $v->mSchoolCategory->mSchoolCategoryTranslations[0]->name;
                    } else {
                        return '';
                    }
                })
                ->editColumn('value', function ($v) { 
                    if(!empty($v->mSchoolAttributeTranslations[0]->content)) {
                        return $v->mSchoolAttributeTranslations[0]->content;
                    } else {
                        return '';
                    }
                })
                ->editColumn('unit', function ($v) { 
                    if(!empty($v->mSchoolAttributeTranslations[0]->unit)){
                        return $v->mSchoolAttributeTranslations[0]->unit;
                    } else {
                        return '';
                    }
                })
                ->editColumn('active', function ($v) { 
                    if($v->search == 1){
                        return $v->search;
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
                ->rawColumns(['group','action'])
                ->make(true);
        } catch (\Exception $e) {
            return null;
        }
    }
    public function getAttribute($id,$language = 1)
    {
        self::__construct();
        try {
            $data = MSchoolAttribute::with('mSchoolAttributeTranslationsAll','mSchoolCategory')
                    ->where('id', $id)
                    ->whereHas('mSchoolAttributeTranslationsAll', function ($query) use ($language) {
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

    public function postAttribute($request)
    {
        self::__construct();
        try {
            DB::beginTransaction();
            if($request->action == 'update' || $request->action == 'delete') {
                $query = MSchoolAttribute::find($request->id);
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

            // if($request->has('type') && !empty($request->type)) { // loại trường ???????
			// 	$data_relationship[''] = $request->type;
            // }

            if($request->has('group_attribute') && !empty($request->group_attribute)) { 
				$data['school_category_id'] = $request->group_attribute;
            }
            
            if($request->has('type_attribute') && !empty($request->type_attribute)) { 
				$data['type'] = $request->type_attribute;
            }

            if($request->has('inputAddValue') && !empty($request->inputAddValue)) {
				$data_relationship['content'] = $request->inputAddValue;
            }

            if($request->has('inputAddUnit') && !empty($request->inputAddUnit)) {
				$data_relationship['unit'] = $request->inputAddUnit;
            }

            if($request->addActive == 'on') {
                $data['search'] = 1;
            } else {
                $data['search'] = 0;
            }

            if($request->action == 'update') {
                $ref = $query->update($data);
                if(!$ref) {
                    DB::rollback();
                    return false;
                }
                if (count($data_relationship) > 0) {
                    $query->mSchoolAttributeTranslationsAll()->where('language_id', $request->lang)->update($data_relationship);
                    if (!$query) {
                        DB::rollback();
                        return false;
                    }
                }         
            } else if($request->action == 'delete') {
                $ref = MSchoolAttributeTranslation::where('translation_id', $request->id);
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
                $query = MSchoolAttribute::create($data);
                if(!$query) {
                    DB::rollback();
                    return false;
                }
                $data_relationship['translation_id'] = $query->id;
				$trans = self::renderTrans($query->mSchoolAttributeTranslations(), $data_relationship);
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
