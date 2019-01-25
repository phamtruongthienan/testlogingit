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

class AttributeGroup extends Controller
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
                $data = MSchoolCategory::with('mSchoolCategoryTranslations');
                return Datatables::of($data)
                ->editColumn('group', function ($v) { 
                    if(!empty($v->mSchoolCategoryTranslations[0]->name)) {
                        return $v->mSchoolCategoryTranslations[0]->name;
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
    public function getAttributeGroup($id,$language = 1)
    {
        self::__construct();
        try {
            $data = MSchoolCategory::with('mSchoolCategoryTranslationsAll')
                    ->where('id', $id)
                    ->whereHas('mSchoolCategoryTranslationsAll', function ($query) use ($language) {
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

    public function postAttributeGroup($request)
    {
        self::__construct();
        // try {
            DB::beginTransaction();
            if($request->action == 'update' || $request->action == 'delete') {
                $query = MSchoolCategory::find($request->id);
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
            
            if($request->action == 'update') {
                if (count($data_relationship) > 0) {
                    $query->mSchoolCategoryTranslationsAll()->where('language_id', $request->lang)->update($data_relationship);
                    if (!$query) {
                        DB::rollback();
                        return false;
                    }
                }         
            } else if($request->action == 'delete') {
                $query->delete();
                if(!$query) {
                    DB::rollback();
                    return false;
                }
            } else {
                $query = MSchoolCategory::create($data);
                if(!$query) {
                    DB::rollback();
                    return false;
                }
                $data_relationship['translation_id'] = $query->id;
				$trans = self::renderTrans($query->mSchoolCategoryTranslations(), $data_relationship);
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
    //    } catch (\Exception $e) {
    //        DB::rollback();
    //        return false;
    //    }
    }
}
