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
use App\Models\MSchoolClass;
use App\Models\MSchoolClassAddon;
use App\Models\MSchoolClassTranslation;
use App\Models\MSchoolCourse;
use App\Models\MSchoolClassAddonTranslation;

class Room extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $lang;
    protected $lang_id;

    public function __construct()
    {
        $this->lang = LaravelLocalization::getCurrentLocale();
        $this->lang_id = LaravelLocalization::getCurrentLocaleID();
    }
    public function getDTRoom()
    {
        self::__construct();
        try { 
                $data = MSchoolClass::with("mSchoolClassTranslations");
                return Datatables::of($data)
                ->editColumn('name', function ($v) { 
                    if(!empty($v->mSchoolClassTranslations[0]->name)) {
                        return $v->mSchoolClassTranslations[0]->name;
                    } else {
                        return '';
                    }
                })
                ->editColumn('position', function ($v) { 
                    if(!empty($v->mSchoolClassTranslations[0]->position)) {
                        return $v->mSchoolClassTranslations[0]->position;
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
                ->rawColumns(['action'])
                ->make(true);
        } catch (\Exception $e) {
            return null;
        }
    }
    public function getRoom($id,$language = 1)
    {
        self::__construct();
        try {
            $data = MSchoolClass::with('mSchoolClassTranslationsAll', 'mSchoolClassAddons.mSchoolClassAddonTranslationsAll')
                    ->where('id', $id)
                    ->whereHas('mSchoolClassTranslationsAll', function ($query) use ($language) {
                        $query->where('language_id', $language);
                    })
                    ->first();
            if (!empty($data)) {
                return self::JsonExport(200, 'success', $data);
            } else {
                return self::JsonExport(404, 'error', null);
            }
        } catch (\Exception $e) {
            return self::JsonExport(500, 'error', null);
        }
    }

    public function postRoom($request)
    {
        self::__construct();
        try {
            DB::beginTransaction();
            if($request->action == 'update' || $request->action == 'delete') {
                $query = MSchoolClass::find($request->id);
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
				$data_relationship['position'] = $request->inputAddPosition;
            }
            if($request->has('inputAddNameOption') && !empty($request->inputAddNameOption)) {
                $AddNameOption = array() ;
			    $input = $request->all();
                foreach($input as $key => $val)
                {
                    if($key=="inputAddNameOption"){
                        foreach($request->inputAddNameOption as $k => $inp){
                            $AddNameOption[$k] = $inp;
                        }
                    }
                }
            }
            if($request->has('inputAddValueOption') && !empty($request->inputAddValueOption)) {
                $AddValueOption = array() ;
                foreach($input as $key => $val)
                {
                    if($key=="inputAddValueOption"){
                        foreach($request->inputAddValueOption as $k => $inp){
                            $AddValueOption[$k] = $inp;
                        }
                    }
                }
            }
            
            if($request->has('idaddon') && !empty($request->idaddon)) {
                $idaddon = array() ;
                foreach($input as $key => $val)
                {
                    if($key=="idaddon"){
                        foreach($request->idaddon as $k => $inp){
                            $idaddon[$k] = $inp;
                        }
                    }
                }
            }

            if($request->action == 'update') {
                // $query->update($data);
                // if (!$query) {
                //     DB::rollback();
                //     return false;
                // }
                if (count($data_relationship) > 0) {
                    $query->mSchoolClassTranslationsAll()->where('language_id', $request->lang)->update($data_relationship);
                    if (!$query) {
                        DB::rollback();
                        return false;
                    }
                    
                    if($idaddon[0] !=null){
                        $maddon = MSchoolClassAddon::where('school_class_id',$query->id)->get();
                        foreach ($maddon as $key => $value) {
                            $temp = 0 ;
                            foreach($idaddon as $k => $val){
                                if(($val!=null) && ($val==$value->id)){ //tìm thấy giống id
                                    //update ở đây
                                    $update_addon_trans =[
                                        'name' => $AddNameOption[$k],
                                        'content' => $AddValueOption[$k]
                                    ];
                                    $upd = MSchoolClassAddonTranslation::where('translation_id',$val)->where('language_id',$request->lang)->update($update_addon_trans);
                                    if (!$upd) {
                                        DB::rollback();
                                        return false;
                                    }
                                    $temp = 1;
                                    break;
                                }
                            }
                            if($temp ==0){ // id không được tìm thấy
                                //xóa $value->id
                                $refdel = MSchoolClassAddonTranslation::where('translation_id', $value->id);
                                $refdel = $refdel->delete();
                                if(!$refdel) {
                                    DB::rollback();
                                    return false;
                                }
                                $refadondel = MSchoolClassAddon::find($value->id)->delete();
                                if(!$refadondel) {
                                    DB::rollback();
                                    return false;
                                }
                            }
                        } 

                        $data_addon ['school_class_id'] = $query->id;
                        $data_relationship_addon =[];
                    }
                    if($AddValueOption[0] != null){
                        $data_addon ['school_class_id'] = $query->id;
                        $data_relationship_addon =[];
                        foreach($AddValueOption as $key => $val)
                        {
                            if($idaddon[$key] == null && $val!=null && $AddNameOption[$key]!=null){
                                $query_addon = MSchoolClassAddon::create($data_addon);
                                $data_relationship_addon['content'] = $val;
                                $data_relationship_addon['name'] = $AddNameOption[$key];
                                $trans_addon = self::renderTrans($query_addon->mSchoolClassAddonTranslations(), $data_relationship_addon);
                                if(!$trans_addon) {
                                    DB::rollback();
                                    return false;
                                }
                            }     
                        }
                    }
                }         
            } else if($request->action == 'delete') {
                $ref = MSchoolClassTranslation::where('translation_id', $request->id);
                $ref = $ref->delete();
                if(!$ref) {
                    DB::rollback();
                    return false;
                }
                //MSchoolClassAddonTranslation
                $refadon = MSchoolClassAddon::where('school_class_id', $request->id)->get();
                foreach($refadon as $key => $val){
                    $refdel = MSchoolClassAddonTranslation::where('translation_id', $val->id);
                    $refdel = $refdel->delete();
                    if(!$refdel) {
                        DB::rollback();
                        return false;
                    }
                    $refadondel = MSchoolClassAddon::find($val->id)->delete();
                    if(!$refadondel) {
                        DB::rollback();
                        return false;
                    }
                }
                
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
                $query = MSchoolClass::create($data);
                if(!$query) {
                    DB::rollback();
                    return false;
                }
                $data_relationship['translation_id'] = $query->id;
				$trans = self::renderTrans($query->mSchoolClassTranslations(), $data_relationship);
                if(!$trans) {
                    DB::rollback();
                    return false;
                }
                if($AddValueOption[0] != null){
                    $data_addon ['school_class_id'] = $query->id;
                    $data_relationship_addon =[];
                    foreach($AddValueOption as $key => $val)
                    {
                        if($val!=null && $AddNameOption[$key]!=null){
                            $query_addon = MSchoolClassAddon::create($data_addon);
                            $data_relationship_addon['content'] = $val;
                            $data_relationship_addon['name'] = $AddNameOption[$key];
                            $trans_addon = self::renderTrans($query_addon->mSchoolClassAddonTranslations(), $data_relationship_addon);
                            if(!$trans_addon) {
                                DB::rollback();
                                return false;
                            }
                        }
                    }
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
