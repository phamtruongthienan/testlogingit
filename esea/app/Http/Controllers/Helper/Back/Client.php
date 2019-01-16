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
use App\Models\MClient;
use App\Models\MClientTranslation;
use App\Models\MSchool;
use App\Models\MSchoolTranslation;


class Client extends Controller
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
    public function postClient($request)
    {
        self::__construct();
        try {
            DB::beginTransaction();
            if($request->action == 'update' || $request->action == 'delete') {
                $query = MClient::find($request->id);
                if(!$query) {
                    DB::rollback();
                    return false;
                }
            }
            $data = [];
            $data_relationship = [];
            $img_translation = [];
            if($request->has('name') && !empty($request->name)) {
							$data_relationship['name'] = $request->name;
            }

            if($request->has('address') && !empty($request->address)) {
							$data_relationship['address'] = $request->address;
            }

            if($request->has('email') && !empty($request->email)) {
							$data_relationship['email'] = $request->email;
            }

            if($request->has('phone') && !empty($request->phone)) {
							$data_relationship['phone'] = $request->phone;
            }
	
						if($request->has('fax') && !empty($request->fax)) {
							$data_relationship['fax'] = $request->fax;
						}
	
						if($request->has('website') && !empty($request->website)) {
							$data_relationship['website'] = $request->website;
						}
	
						if($request->has('job') && !empty($request->job)) {
							$data_relationship['job'] = $request->job;
						}
		
						if($request->has('investment') && !empty($request->investment)) {
							$data_relationship['investment'] = $request->investment;
						}
		
						if($request->has('staff') && !empty($request->staff)) {
							$data_relationship['staff'] = $request->staff;
						}
		
						if($request->has('school_id') && !empty($request->school_id)) {
							$data_relationship['school_id'] = $request->school_id;
						}
            
            if($request->status == 'on') {
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }
            
						if ($request->has('up') && $request->up == 1) {
							$rules['tid'] = 'required|min:1|max:100';
						}
						if ($request->has('down') && $request->down == 1) {
							$rules['tid'] = 'required|min:1|max:100';
						}
					
            if($request->has('content') && !empty($request->content)) {
                $data_relationship['content'] = $request->content;
            } else {
                $data_relationship['content'] = null;
            }

            if($request->has('image_hash') && !empty($request->image_hash)) {
                $dir = public_path('img/uploads/admin');
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, 0777, true, true);
                }
                $type = explode('/', substr($request->image_hash, 5, strpos($request->image_hash, ';')-5));
                $filename = mb_substr(md5(time().rand(1,100)),0,10).'.'.$type[1];
                $path = '/uploads/admin/' .$filename;
                $save_image = Image::make(self::DecodeImage($request->image_hash))->save(public_path('img'.$path), 100);
                $data_relationship['logo'] = $path;
            }
            
            if($request->action == 'update') {
							if( ($request->has('up') && $request->up == 1) || ($request->has('down') && $request->down == 1) ) {
								if($request->has('up')) {
									$to = MClient::where('sort', '>', $query->sort)->orderBy('sort','asc')->first();
								} else {
									$to = MClient::where('sort', '<', $query->sort)->orderBy('sort','desc')->first();
								}
								if(!$to) {
									DB::rollBack();
									return false;
								}
								
								$fid = $query->sort;
								$query->sort = $to->sort;
								$to->sort = $fid;
								$query->save();
								$to->save();
								if ($query && $to) {
									DB::commit();
									return true;
								} else {
									DB::rollBack();
									return false;
								}
							} else {
								if (count($data_relationship) > 0) {
									$query->mClientTranslations()->where('language_id', $this->lang_id)->update($data_relationship);
									if (!$query) {
										DB::rollback();
										return false;
									}
								}
								if (count($data) > 0) {
									$query->update($data);
									if (!$query) {
										DB::rollback();
										return false;
									}
								}
							}
            } else if($request->action == 'delete') {
                $ref = MClientTranslation::where('translation_id', $request->id);
                foreach($ref->get() as $k => $v) {
                    if(!empty($v->logo)) {
                        array_push($img_translation, $v->logo);
                    }
                }
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
								$data['sort'] = MClient::max('sort') + 1;
                $query = MClient::create($data);
                if(!$query) {
                    DB::rollback();
                    return false;
                }
                
                $data_relationship['translation_id'] = $query->id;
								$trans = self::renderTrans($query->mClientTranslations(), $data_relationship);
                if(!$trans) {
                    DB::rollback();
                    return false;
                }
            }
            if ($query) {
                if(count($img_translation) > 0) {
                    foreach($img_translation as $v) {
                        @unlink(public_path('img/'.$v));
                    }
                }
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

    public function getClient($id)
    {
        self::__construct();
        try {
            $data = MClient::with('mClientTranslations','mClientTranslations.mSchool.mSchoolTranslations')
                    ->where('id', $id)
                    ->whereHas('mClientTranslations', function ($query) {
                        $query->where('language_id', $this->lang_id);
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

    public function getDTClient()
    {
        self::__construct();
        try {
                $data = MClient::with('mClientTranslations');
                return Datatables::of($data)
								->editColumn('name', function ($v) {
									if(!empty($v->mClientTranslations[0]->name)) {
										return $v->mClientTranslations[0]->name;
									} else {
										return '';
									}
								})
								->editColumn('address', function ($v) {
									if(!empty($v->mClientTranslations[0]->address)) {
										return $v->mClientTranslations[0]->address;
									} else {
										return '';
									}
								})
								->editColumn('email', function ($v) {
									if(!empty($v->mClientTranslations[0]->email)) {
										return $v->mClientTranslations[0]->email;
									} else {
										return '';
									}
								})
								->editColumn('phone', function ($v) {
									if(!empty($v->mClientTranslations[0]->phone)) {
										return $v->mClientTranslations[0]->phone;
									} else {
										return '';
									}
								})
                ->editColumn('status', function ($v) {
                    if($v->status == 1) {
                        return '<i class="fas fa-check-circle text-green"></i>';
                    } else {
                        return '';
                    }
                })
								->editColumn('sort', function ($v) {
										if(!empty($v->sort)) {
												$spanUp = '<span><a data-id="' . $v->id . '" class="upBtn table-action text-primary cursor-pointer"><i class="fas fa-caret-square-up"></i></a></span>';
												$spanDown = '<span><a data-id="'. $v->id . '" class="downBtn table-action text-primary cursor-pointer"><i class="fas fa-caret-square-down"></i></a></span>';
												return $spanUp . $spanDown;
										} else {
												return '';
										}
								})
                ->addColumn('action', function ($v) {
                    return '<a class="table-action table-action-edit text-green cursor-pointer" data-id="'.$v->id.'"><i class="fa fa-edit"></i></a><a class="table-action text-red table-action-delete cursor-pointer" data-id="'.$v->id.'"><i class="fa fa-trash"></i></a>';
                })
								->addIndexColumn()
                ->rawColumns(['status', 'action', 'sort'])
                ->make(true);
        } catch (\Exception $e) {
            return null;
        }
    }
    
		public function getClientSchool($keyword)
		{
			self::__construct();
			try {
				if (!empty($keyword)) {
					$school = MSchoolTranslation::with('mSchool')
						  ->where('name', 'like', '%'.$keyword.'%')
							->where('language_id', $this->lang_id)
							->get();
				} else {
					$school = MSchoolTranslation::with('mSchool')
						->where('language_id', $this->lang_id)
						->get();
				}
				if (!empty($school)) {
					return $school;
				} else {
					return null;
				}
			} catch (\Exception $e) {
				return null;
			}
		}
    //DEMO
}
