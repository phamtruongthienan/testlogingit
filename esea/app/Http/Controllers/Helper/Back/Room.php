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
use App\Models\MSchoolClass;
use App\Models\MSchoolClassTranslation;
use App\Models\MSchoolClassAddon;
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

    //DEMO
    public function postRoom($request)
    {
        self::__construct();
        try {
            DB::beginTransaction();
            if($request->action == 'update' || $request->action == 'delete') {
                $query = MSchoolClass::find($request->id);
								$query_addon = MSchoolClassAddon::where('school_class_id', $query->id)->get();
                if(!$query) {
                    DB::rollback();
                    return false;
                }
            }
            $data = [];
            $data_relationship = [];
						$data_addon = [];
						$data_addon_relationship = [];
            if($request->has('name') && !empty($request->name)) {
							$data_relationship['name'] = $request->name;
            }
						if($request->has('position') && !empty($request->position)) {
							$data_relationship['position'] = $request->position;
						}
						
            if($request->action == 'update') {
								if (count($data_relationship) > 0) {
									$query->mSchoolClassTranslationsAll()->where('language_id', $request->lang)->update($data_relationship);
									if (!$query) {
										DB::rollback();
										return false;
									} else {
										foreach ($request->idaddon as $key => $val){
											if($request->has('nameaddon') && !empty($request->nameaddon[$key])) {
												$data_addon_relationship['name'] = $request->nameaddon[$key];
											}
											if($request->has('content') && !empty($request->content[$key])) {
												$data_addon_relationship['content'] = $request->content[$key];
											}
											if($request->idaddon[$key] == null && $request->nameaddon[$key] != null) {
												$data_addon['school_class_id'] = $query->id;
												$query_addon = MSchoolClassAddon::create($data_addon);
												
												$data_addon_relationship['translation_id'] = $query_addon->id;
												$trans_addon = self::renderTrans($query_addon->mSchoolClassAddonTranslations(), $data_addon_relationship);
												if(!$trans_addon) {
													DB::rollback();
													return false;
												}
											} else if ($request->idaddon[$key] != null) {
												if(in_array($query_addon[$key]->id, $request->idaddon)) {
													$query_addon[$key]->mSchoolClassAddonTranslationsAll()
														->where('language_id', $request->lang)
														->where('translation_id',$request->idaddon[$key])
														->update($data_addon_relationship);
													if(!$query_addon[$key]) {
														DB::rollback();
														return false;
													}
												} else {
													$query_addon[$key]->mSchoolClassAddonTranslationsAll()
														->where('translation_id', $request->idaddon[$key])
														->delete();
													$query_addon[$key]->delete();
													if(!$query_addon[$key]) {
														DB::rollback();
														return false;
													}
												}
											}
										}
									}
								}
            } else if($request->action == 'delete') {
                $ref = MSchoolClassTranslation::where('translation_id', $request->id);
								foreach ($query_addon as $key => $val){
									$ref_addon = MSchoolClassAddonTranslation::where('translation_id', $query_addon[$key]->id)->delete();
									if(!$ref_addon) {
										DB::rollback();
										return false;
									}
									$query_addon[$key]->delete();
									if(!$query_addon[$key]) {
										DB::rollback();
										return false;
									}
								}
								
								$ref->delete();
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
							
								foreach ($request->nameaddon as $key => $val){
									if($request->has('nameaddon') && !empty($request->nameaddon[$key])) {
										$data_addon_relationship['name'] = $request->nameaddon[$key];
									}
									if($request->has('content') && !empty($request->content[$key])) {
										$data_addon_relationship['content'] = $request->content[$key];
									}
									
									if(count($data_addon_relationship) > 0) {
										$data_addon['school_class_id'] = $query->id;
										$query_addon = MSchoolClassAddon::create($data_addon);
										
										$data_addon_relationship['translation_id'] = $query_addon->id;
										$trans_addon = self::renderTrans($query_addon->mSchoolClassAddonTranslations(), $data_addon_relationship);
										if(!$trans_addon) {
											DB::rollback();
											return false;
										}
									}
								}
                if(!$trans) {
                    DB::rollback();
                    return false;
                }
            }
	
            if ($query || $query_addon) {
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

    public function getRoom($id, $language = 1)
    {
        self::__construct();
        try {
            $data = MSchoolClass::with('mSchoolClassTranslationsAll', 'mSchoolClassAddons.mSchoolClassAddonTranslationsAll')
                    ->where('id', $id)
                    ->whereHas('mSchoolClassTranslationsAll', function ($query) use ($language) {
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

    public function getDTRoom()
    {
        self::__construct();
        try {
                $data = MSchoolClass::with('mSchoolClassTranslations');
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
                    return '<a class="table-action table-action-edit text-green cursor-pointer" data-lang="'.$this->lang_id.'" data-id="'.$v->id.'"><i class="fa fa-edit"></i></a><a class="table-action text-red table-action-delete cursor-pointer" data-lang="'.$this->lang_id.'" data-id="'.$v->id.'"><i class="fa fa-trash"></i></a>';
                })
								->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        } catch (\Exception $e) {
            return null;
        }
    }
    //DEMO
}
