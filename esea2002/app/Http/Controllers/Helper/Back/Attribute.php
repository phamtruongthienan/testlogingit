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
										switch ($v->mSchoolAttributeTranslations[0]->content) {
											case 0:
												return '';
											case 1:
												return '<i class="fas fa-check-circle text-green"></i>';
											default:
												return $v->mSchoolAttributeTranslations[0]->content;
										}
									} else {
											return '';
									}
							})
							->editColumn('unit', function ($v) {
									if(!empty($v->mSchoolAttributeTranslations[0]->unit)){
										switch ($v->mSchoolAttributeTranslations[0]->unit) {
											case 1:
												return 'Tiếng';
												break;
											case 2:
												return 'Buổi';
												break;
											case 3:
												return 'Ngày';
												break;
											case 4:
												return 'Tuần';
												break;
											case 5:
												return 'Tháng';
												break;
											default:
												return 'Năm';
										}
									} else {
											return '';
									}
							})
							->editColumn('active', function ($v) {
								if(!empty($v->search) && $v->search == 1) {
									return '<i class="fas fa-check-circle text-green"></i>';
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
							->rawColumns(['active','action', 'value'])
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
            if($request->has('name') && !empty($request->name)) {
							$data_relationship['name'] = $request->name;
            }
            
            if($request->has('school_category_id') && !empty($request->school_category_id)) {
							$data['school_category_id'] = $request->school_category_id;
            }
            
            if($request->has('type') && !empty($request->type)) {
							$data['type'] = $request->type;
							if($request->type == 1) {
								if($request->has('unit') && !empty($request->unit)) {
									$data_relationship['unit'] = $request->unit;
								}
								if($request->has('value') && !empty($request->value)) {
									$data_relationship['content'] = $request->value;
								}
							} else {
								if($request->ckbvalue == 'on') {
									$data_relationship['content'] = 1;
								} else {
									$data_relationship['content'] = 0;
								}
								$data_relationship['unit'] = null;
							}
            }
	
						if($request->has('icon') && !empty($request->icon)) {
							$data['icon'] = $request->icon;
						}
            
            if($request->search == 'on') {
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
		public function getDTAttributeGroup()
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
							' <a class="table-action text-red table-action-delete cursor-pointer" data-id="'.$v->id . '" data-lang="' . $this->lang_id .'"><i' .
							' class="fa fa-trash"></i></a>';
					})
					->rawColumns(['action'])
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
			 try {
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
					if($request->has('name') && !empty($request->name)) {
						$data_relationship['name'] = $request->name;
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
						$ref = MSchoolCategoryTranslation::where('translation_id', $request->id);
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
			 } catch (\Exception $e) {
					DB::rollback();
					return false;
			 }
		}
}
