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
use App\Models\MKeyword;
use App\Models\MKeywordTranslation;
use App\Models\MKeywordPrioty;
use App\Models\MKeywordPriotyTranslation;
use App\Models\MKeywordSchool;
use App\Models\MKeywordSchoolTranslation;

class Search extends Controller
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
    public function postKeyWord($request)
    {
        self::__construct();
        try {
            DB::beginTransaction();
            if($request->action == 'update' || $request->action == 'delete') {
                $query = MKeyword::find($request->id);
                if(!$query) {
                    DB::rollback();
                    return false;
                }
            }
            $data = [];
            $data_relationship = [];
            if($request->has('name') && !empty($request->name)) {
							$data_relationship['name'] = implode(',', $request->name);
            }
            
            if($request->action == 'update') {
								if (count($data_relationship) > 0) {
									$query->mKeywordTranslationsAll()->where('language_id', $request->lang)->update($data_relationship);
									if (!$query) {
										DB::rollback();
										return false;
									}
								}
            } else if($request->action == 'delete') {
            		$prioty = MKeywordPrioty::where('keyword_id', $request->id);
            		if(count($prioty->get())) {
            			$dataPrioty = $prioty->get();
            			foreach ($dataPrioty as $k => $v) {
            				$refPrioty = MKeywordPriotyTranslation::where('translation_id', $v->id);
										$refPrioty = $refPrioty->delete();
										if(!$refPrioty) {
											DB::rollback();
											return false;
										}
									}
									$prioty = $prioty->delete();
									if(!$prioty) {
										DB::rollback();
										return false;
									}
								}
								
								$school = MKeywordSchool::where('keyword_id', $request->id);
								if(count($school->get())) {
									$dataSchool = $school->get();
									foreach ($dataSchool as $k => $v) {
										$refSchool = MKeywordSchoolTranslation::where('translation_id', $v->id);
										$refSchool = $refSchool->delete();
										if(!$refSchool) {
											DB::rollback();
											return false;
										}
									}
									$school = $school->delete();
									if(!$school) {
										DB::rollback();
										return false;
									}
								}
							
                $ref = MKeywordTranslation::where('translation_id', $request->id);
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
                $query = MKeyword::create($data);
                if(!$query) {
                    DB::rollback();
                    return false;
                }
                
                $data_relationship['translation_id'] = $query->id;
								$trans = self::renderTrans($query->mKeywordTranslations(), $data_relationship);
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

    public function getKeyWord($id, $language = 1)
    {
        self::__construct();
        try {
            $data = MKeyword::with('mKeywordTranslationsAll')
                    ->where('id', $id)
                    ->whereHas('mKeywordTranslationsAll', function ($query) use ($language) {
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

    public function getDTKeyWord()
    {
        self::__construct();
        try {
                $data = MKeyword::with('mKeywordTranslations');
                return Datatables::of($data)
								->editColumn('name', function ($v) {
									if(!empty($v->mKeywordTranslations[0]->name)) {
										return $v->mKeywordTranslations[0]->name;
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
	
		public function postKeyWordPrioty($request)
		{
			self::__construct();
			try {
				DB::beginTransaction();
				if($request->action == 'update' || $request->action == 'delete') {
					$query = MKeywordPrioty::find($request->id);
					if(!$query) {
						DB::rollback();
						return false;
					}
				}
				$data = [];
				$data_relationship = [];
				if($request->has('keyword_id') && !empty($request->keyword_id)) {
					$data['keyword_id'] = $request->keyword_id;
				}
				if($request->has('type') && !empty($request->type)) {
					$data_relationship['type'] = $request->type;
				}
				if($request->status == 'on') {
					$data_relationship['status'] = 1;
				} else {
					$data_relationship['status'] = 0;
				}
				
				switch ($request->type) {
					case 1:
						$data_relationship['district_id'] = $request->typename;
						break;
					case 2:
						$data_relationship['school_type_id'] = $request->typename;
						break;
					default:
						$data_relationship['school_level_id'] = $request->typename;
				}
				
				if($request->action == 'update') {
					if (count($data_relationship) > 0) {
						$query->mKeywordPriotyTranslationsAll()->update($data_relationship);
						if (!$query) {
							DB::rollback();
							return false;
						}
					}
				} else if($request->action == 'delete') {
					$ref = MKeywordPriotyTranslation::where('translation_id', $request->id);
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
					$query = MKeywordPrioty::create($data);
					if(!$query) {
						DB::rollback();
						return false;
					}
					
					$data_relationship['translation_id'] = $query->id;
					$trans = self::renderTrans($query->mKeywordPriotyTranslationsAll(), $data_relationship);
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
	
		public function getKeyWordPrioty($id, $language = 1)
		{
			self::__construct();
			try {
				$data = MKeywordPrioty::with('mKeywordPriotyTranslationsAll', 'mKeywordPriotyTranslations.mSchoolType.mSchoolTypeTranslationsAll', 'mKeywordPriotyTranslations.configDistrict', 'mKeywordPriotyTranslations.mSchoolLevel.mSchoolLevelTranslationsAll')
					->where('id', $id)
					->whereHas('mKeywordPriotyTranslationsAll', function ($query) use ($language) {
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
		
		public function getDTKeyWordPrioty($keyWordId, $language = 1)
		{
			self::__construct();
			try {
				 $data = MKeywordPrioty::with('mKeywordPriotyTranslationsAll', 'mKeywordPriotyTranslationsAll.mSchoolType.mSchoolTypeTranslationsAll', 'mKeywordPriotyTranslationsAll.configDistrict', 'mKeywordPriotyTranslationsAll.mSchoolLevel.mSchoolLevelTranslationsAll')
					->whereHas('mKeywordPriotyTranslationsAll', function ($query) use ($language) {
						$query->where('language_id', $language);
					})
					->where('keyword_id', $keyWordId)
					->get();
				return Datatables::of($data)
					->editColumn('type', function ($v) {
						if(!empty($v->mKeywordPriotyTranslationsAll[0]->type)) {
							switch($v->mKeywordPriotyTranslationsAll[0]->type) {
								case 1:
									return 'Khu vực';
								case 2:
									return 'Loại trường';
								default:
									return 'Cấp trường';
							}
						} else {
							return '';
						}
					})
					->editColumn('name', function ($v)  use ($language){
						if(!empty($v->mKeywordPriotyTranslationsAll[0]->district_id)) {
							return $v->mKeywordPriotyTranslationsAll[0]->configDistrict->name;
						} else {
							if(!empty($v->mKeywordPriotyTranslationsAll[0]->school_level_id)) {
								foreach ($v->mKeywordPriotyTranslationsAll[0]->mSchoolLevel->mSchoolLevelTranslationsAll as $k => $v) {
									if($v->language_id == $language) {
										return $v->name;
									}
								}
							} else {
								if(!empty($v->mKeywordPriotyTranslationsAll[0]->school_type_id)) {
									foreach ($v->mKeywordPriotyTranslationsAll[0]->mSchoolType->mSchoolTypeTranslationsAll as $k => $v) {
										if($v->language_id == $language) {
											return $v->name;
										}
									}
								} else {
									return '';
								}
							}
						}
					})
					->editColumn('status', function ($v) {
						if(!empty($v->mKeywordPriotyTranslationsAll[0]->status) && $v->mKeywordPriotyTranslationsAll[0]->status == 1) {
							return '<i class="fas fa-check-circle text-green"></i>';
						} else {
							return '';
						}
					})
					->addColumn('action', function ($v) {
						return '<a class="table-action table-action-edit text-green cursor-pointer" data-lang="'.$this->lang_id.'" data-id="'.$v->id.'"><i class="fa fa-edit"></i></a><a class="table-action text-red table-action-delete cursor-pointer" data-lang="'.$this->lang_id.'" data-id="'.$v->id.'"><i class="fa fa-trash"></i></a>';
					})
					->addIndexColumn()
					->rawColumns(['action', 'status'])
					->make(true);
			} catch (\Exception $e) {
				return null;
			}
		}
		
		public function postKeyWordSchool($request)
		{
			self::__construct();
			try {
				DB::beginTransaction();
				if($request->action == 'update' || $request->action == 'delete') {
					$query = MKeywordSchool::find($request->id);
					if(!$query) {
						DB::rollback();
						return false;
					}
				}
				$data = [];
				$data_relationship = [];
				if($request->has('keyword_id') && !empty($request->keyword_id)) {
					$data['keyword_id'] = $request->keyword_id;
				}
				if($request->has('sort') && !empty($request->sort)) {
					$data_relationship['sort'] = $request->sort;
				}
				if($request->has('school_id') && !empty($request->school_id)) {
					$data_relationship['school_id'] = $request->school_id;
				}
				if($request->status == 'on') {
					$data_relationship['status'] = 1;
				} else {
					$data_relationship['status'] = 0;
				}
				
				if($request->action == 'update') {
					if (count($data_relationship) > 0) {
						$query->mKeywordSchoolTranslationsAll()->update($data_relationship);
						if (!$query) {
							DB::rollback();
							return false;
						}
					}
				} else if($request->action == 'delete') {
					$ref = MKeywordSchoolTranslation::where('translation_id', $request->id);
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
					$query = MKeywordSchool::create($data);
					if(!$query) {
						DB::rollback();
						return false;
					}
					
					$data_relationship['translation_id'] = $query->id;
					$trans = self::renderTrans($query->mKeywordSchoolTranslationsAll(), $data_relationship);
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
		
		public function getKeyWordSchool($id, $language = 1)
		{
			self::__construct();
			try {
				$data = MKeywordSchool::with('mKeywordSchoolTranslationsAll', 'mKeywordSchoolTranslationsAll.mSchool.mSchoolTranslationsAll')
					->where('id', $id)
					->whereHas('mKeywordSchoolTranslationsAll', function ($query) use ($language) {
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
		
		public function getDTKeyWordSchool($keyWordId, $language = 1)
		{
			self::__construct();
			try {
				$data = MKeywordSchool::with('mKeywordSchoolTranslationsAll', 'mKeywordSchoolTranslationsAll.mSchool.mSchoolTranslationsAll')
					->whereHas('mKeywordSchoolTranslationsAll', function ($query) use ($language) {
						$query->where('language_id', $language);
					})
					->where('keyword_id', $keyWordId)
					->get();
				return Datatables::of($data)
					->editColumn('school', function ($v) use ($language) {
						if(!empty($v->mKeywordSchoolTranslationsAll[0]->school_id)) {
							foreach ($v->mKeywordSchoolTranslationsAll[0]->mSchool->mSchoolTranslationsAll as $k => $v) {
								if($v->language_id == $language) {
									return $v->name;
								}
							}
						} else {
							return '';
						}
					})
					->editColumn('sort', function ($v) {
						if(!empty($v->mKeywordSchoolTranslationsAll[0]->sort)) {
							return $v->mKeywordSchoolTranslationsAll[0]->sort;
						} else {
							return '';
						}
					})
					->editColumn('status', function ($v) {
						if(!empty($v->mKeywordSchoolTranslationsAll[0]->status) && $v->mKeywordSchoolTranslationsAll[0]->status == 1) {
							return '<i class="fas fa-check-circle text-green"></i>';
						} else {
							return '';
						}
					})
					->addColumn('action', function ($v) {
						return '<a class="table-action table-action-edit text-green cursor-pointer" data-lang="'.$this->lang_id.'" data-id="'.$v->id.'"><i class="fa fa-edit"></i></a><a class="table-action text-red table-action-delete cursor-pointer" data-lang="'.$this->lang_id.'" data-id="'.$v->id.'"><i class="fa fa-trash"></i></a>';
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
