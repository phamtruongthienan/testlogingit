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
use App\Models\ConfigCity;
use App\Models\ConfigDistrict;
use App\Models\ConfigWard;

class Place extends Controller
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
    public function postPlace($request)
    {
        self::__construct();
        try {
            DB::beginTransaction();
            if($request->action == 'update' || $request->action == 'delete') {
                $query = ConfigCity::find($request->id);
                if(!$query) {
                    DB::rollback();
                    return false;
                }
            }
            $data = [];
            if($request->has('name') && !empty($request->name)) {
							$data['name'] = $request->name;
            }
            
            if($request->action == 'update') {
								if (count($data) > 0) {
									$query->update($data);
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
                $query = ConfigCity::create($data);
                if(!$query) {
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
    
		public function postDistrict($request)
		{
			self::__construct();
			try {
				DB::beginTransaction();
				if($request->action == 'update' || $request->action == 'delete') {
					$query = ConfigDistrict::find($request->id);
					if(!$query) {
						DB::rollback();
						return false;
					}
				}
				$data = [];
				if($request->has('name') && !empty($request->name)) {
					$data['name'] = $request->name;
				}
				
				if($request->has('city_id') && !empty($request->city_id)) {
					$data['city_id'] = $request->city_id;
				}
				
				if($request->action == 'update') {
					if (count($data) > 0) {
						$query->update($data);
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
					$query = ConfigDistrict::create($data);
					if(!$query) {
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
	
		public function postWard($request)
		{
			self::__construct();
			try {
				DB::beginTransaction();
				if($request->action == 'update' || $request->action == 'delete') {
					$query = ConfigWard::find($request->id);
					if(!$query) {
						DB::rollback();
						return false;
					}
				}
				$data = [];
				if($request->has('name') && !empty($request->name)) {
					$data['name'] = $request->name;
				}
				
				if($request->has('district_id') && !empty($request->district_id)) {
					$data['district_id'] = $request->district_id;
				}
				
				if($request->action == 'update') {
					if (count($data) > 0) {
						$query->update($data);
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
					$query = ConfigWard::create($data);
					if(!$query) {
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
		
    public function getPlace($id, $type)
    {
        self::__construct();
        try {
						$data = ConfigCity::with('configDistricts','configDistricts.configWards')
								->where('id', $id)
								->first();
						if (!empty($data)) {
								switch ($type) {
									case 'district':
										$district = $data->configDistricts;
										return Datatables::of($district)
											->editColumn('id', function ($v) {
												if (!empty($v->id)) {
													return $v->id;
												} else {
													return '';
												}
											})
											->editColumn('name', function ($v) {
												if (!empty($v->name)) {
													return $v->name;
												} else {
													return '';
												}
											})
											->addColumn('action', function ($v) {
												return '<a class="table-action table-action-edit text-green cursor-pointer" data-id="' . $v->id . '"><i class="fa fa-edit"></i></a><a class="table-action text-red table-action-delete cursor-pointer" data-id="' . $v->id . '"><i class="fa fa-trash"></i></a>';
											})
											->rawColumns(['action'])
											->make(true);
									case 'ward':
										$ward = ConfigWard::with('configDistrict')->whereHas('configDistrict', function ($query) use ($id){
														$query->where('city_id', $id);
													})->get();
										return Datatables::of($ward)
											->editColumn('id', function ($v) {
												if (!empty($v->id)) {
													return $v->id;
												} else {
													return '';
												}
											})
											->editColumn('district', function ($v) {
												if (!empty($v->configDistrict->name)) {
													return $v->configDistrict->name;
												} else {
													return '';
												}
											})
											->editColumn('name', function ($v) {
												if (!empty($v->name)) {
													return $v->name;
												} else {
													return '';
												}
											})
											->addColumn('action', function ($v) {
												return '<a class="table-action table-action-edit text-green cursor-pointer" data-id="' . $v->id . '"><i class="fa fa-edit"></i></a><a class="table-action text-red table-action-delete cursor-pointer" data-id="' . $v->id . '"><i class="fa fa-trash"></i></a>';
											})
											->rawColumns(['action'])
											->make(true);
									default:
										return self::JsonExport(200, 'success', $data);
								}
						} else {
							return self::JsonExport(404, 'error', null);
						}
        } catch (\Exception $e) {
            return self::JsonExport(500, 'error', null);
        }
    }
    
    public function getDTPlace()
    {
        self::__construct();
        try {
						$data = ConfigCity::all();
						return Datatables::of($data)
						->addColumn('action', function ($v) {
								return '<a class="table-action table-action-edit text-green cursor-pointer" data-id="'.$v->id.'"><i class="fa fa-edit"></i></a><a class="table-action text-red table-action-delete cursor-pointer" data-id="'.$v->id.'"><i class="fa fa-trash"></i></a>';
						})
						->rawColumns(['action'])
						->make(true);
        } catch (\Exception $e) {
            return null;
        }
    }
    
		public function getDistrict($id)
		{
			self::__construct();
			try {
				$data = ConfigDistrict::where('id', $id)
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
		
		public function getWard($id)
		{
			self::__construct();
			try {
				$data = ConfigWard::with('configDistrict')
								->where('id', $id)
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
		
    //DEMO
}
