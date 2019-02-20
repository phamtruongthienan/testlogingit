<?php

namespace App\Http\Controllers\Helper\Back;

use App\Models\MExchangeRate;
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
use App\Models\ConfigMain;
use App\Models\ConfigMainTranslation;
use App\Models\ConfigOther;
use App\Models\ConfigLanguage;

class Setting extends Controller
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
    public function postConfigMain($request)
    {
        self::__construct();
        try {
            DB::beginTransaction();
            if($request->action == 'update' || $request->action == 'delete') {
                $query = ConfigMain::find($request->id);
                if(!$query) {
                    DB::rollback();
                    return false;
                }
            }
            $data = [];
            $data_relationship = [];
						$img_translation = '';
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
            if($request->has('name') && !empty($request->name)) {
							$data_relationship['name'] = $request->name;
            }
						if($request->has('company_name') && !empty($request->company_name)) {
							$data_relationship['company_name'] = $request->company_name;
						}
						if($request->has('slogan') && !empty($request->slogan)) {
							$data_relationship['slogan'] = $request->slogan;
						}
						if($request->has('quote') && !empty($request->quote)) {
							$data_relationship['quote'] = $request->quote;
						}
						if($request->has('address') && !empty($request->address)) {
							$data_relationship['address'] = $request->address;
						}
						if($request->has('phone') && !empty($request->phone)) {
							$data_relationship['phone'] = $request->phone;
						}
						if($request->has('email') && !empty($request->email)) {
							$data_relationship['email'] = $request->email;
						}
						if($request->has('represent') && !empty($request->represent)) {
							$data_relationship['represent'] = $request->represent;
						}
						if($request->has('num_client') && !empty($request->num_client)) {
							$data_relationship['num_client'] = $request->num_client;
						}
						if($request->has('num_school') && !empty($request->num_school)) {
							$data_relationship['num_school'] = $request->num_school;
						}
						if($request->has('num_promo') && !empty($request->num_promo)) {
							$data_relationship['num_promo'] = $request->num_promo;
						}
						if($request->has('distance_google') && !empty($request->distance_google)) {
							$data_relationship['distance_google'] = $request->distance_google;
						}
						if($request->has('background_search') && !empty($request->background_search)) {
							$data_relationship['background_search'] = implode(',',$request->background_search);
						}
						if($request->has('background_promotion') && !empty($request->background_promotion)) {
							$data_relationship['background_promotion'] = implode(',',$request->background_promotion);
						}
						if($request->has('background_client') && !empty($request->background_client)) {
							$data_relationship['background_client'] = implode(',',$request->background_client);
						}
						if($request->enable_ssl == 'on') {
							$data_relationship['enable_ssl'] = 1;
						} else {
							$data_relationship['enable_ssl'] = 0;
						}
						if($request->has('meta_title') && !empty($request->meta_title)) {
							$data_relationship['meta_title'] = $request->meta_title;
						}
						if($request->has('meta_keyword') && !empty($request->meta_keyword)) {
							$data_relationship['meta_keyword'] = $request->meta_keyword;
						}
						if($request->has('meta_description') && !empty($request->meta_description)) {
							$data_relationship['meta_description'] = $request->meta_description;
						}
						if($request->has('analytics_id') && !empty($request->analytics_id)) {
							$data_relationship['analytics_id'] = $request->analytics_id;
						}
						if($request->has('facebook_page') && !empty($request->facebook_page)) {
							$data_relationship['facebook_page'] = $request->facebook_page;
						}
						if($request->has('googleplus_page') && !empty($request->googleplus_page)) {
							$data_relationship['googleplus_page'] = $request->googleplus_page;
						}
						
            if($request->action == 'update') {
								if (count($data_relationship) > 0) {
									if(isset($data_relationship['logo'])) {
										$ref = $query->configMainTranslations()->get();
										$img_translation = $ref[0]->logo;
									}
									$query->configMainTranslations()->update($data_relationship);
									if (!$query) {
										DB::rollback();
										return false;
									}
								}
            } else if($request->action == 'delete') {
                $ref = ConfigMainTranslation::where('translation_id', $request->id);
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
                $query = ConfigMain::create($data);
                if(!$query) {
                    DB::rollback();
                    return false;
                }
                
                $data_relationship['translation_id'] = $query->id;
								$trans = self::renderTrans($query->configMainTranslationsAll(), $data_relationship);
                if(!$trans) {
                    DB::rollback();
                    return false;
                }
            }
            if ($query) {
								if($img_translation) {
									@unlink(public_path('img/'.$img_translation));
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
    
		public function postConfigOther($request)
		{
			self::__construct();
			try {
				DB::beginTransaction();
				$data = [];
				if($request->action == 'update' || $request->action == 'delete') {
					if($request->has('FB_APP_ID') && !empty($request->FB_APP_ID)) {
						$count = count($data);
						$data[$count]['value_name'] = $request->FB_APP_ID;
						$data[$count]['key_name'] = 'FB_APP_ID';
						$query = ConfigOther::where('key', 'FB_APP_ID')->first();
					}
					if($request->has('FB_APP_KEY') && !empty($request->FB_APP_KEY)) {
						$count = count($data);
						$data[$count]['value_name'] = $request->FB_APP_KEY;
						$data[$count]['key_name'] = 'FB_APP_KEY';
						$query = ConfigOther::where('key', 'FB_APP_KEY')->first();
					}
					if($request->has('FB_APP_CALLBACK') && !empty($request->FB_APP_CALLBACK)) {
						$count = count($data);
						$data[$count]['value_name'] = $request->FB_APP_CALLBACK;
						$data[$count]['key_name'] = 'FB_APP_CALLBACK';
						$query = ConfigOther::where('key', 'FB_APP_CALLBACK')->first();
					}
					if($request->has('GG_APP_ID') && !empty($request->GG_APP_ID)) {
						$count = count($data);
						$data[$count]['value_name'] = $request->GG_APP_ID;
						$data[$count]['key_name'] = 'GG_APP_ID';
						$query = ConfigOther::where('key', 'GG_APP_ID')->first();
					}
					if($request->has('GG_APP_KEY') && !empty($request->GG_APP_KEY)) {
						$count = count($data);
						$data[$count]['value_name'] = $request->GG_APP_KEY;
						$data[$count]['key_name'] = 'GG_APP_KEY';
						$query = ConfigOther::where('key', 'GG_APP_KEY')->first();
					}
					if($request->has('GG_APP_CALLBACK') && !empty($request->GG_APP_CALLBACK)) {
						$count = count($data);
						$data[$count]['value_name'] = $request->GG_APP_CALLBACK;
						$data[$count]['key_name'] = 'GG_APP_CALLBACK';
						$query = ConfigOther::where('key', 'GG_APP_CALLBACK')->first();
					}
					if($request->has('GG_KEY_MAP') && !empty($request->GG_KEY_MAP)) {
						$count = count($data);
						$data[$count]['value_name'] = $request->GG_KEY_MAP;
						$data[$count]['key_name'] = 'GG_KEY_MAP';
						$query = ConfigOther::where('key', 'GG_KEY_MAP')->first();
					}
					if(!$query) {
						DB::rollback();
						return false;
					}
				}

				if($request->action == 'update') {
					if (count($data) > 0) {
						foreach($data as $k => $v) {
							//return $v;
							$query = ConfigOther::where('key', $v['key_name'])->update(['value' => $v['value_name']]);
							if(!$query) {
								DB::rollback();
								return false;
							}
						}
					}
				} else if($request->action == 'delete') {
					$query->delete();
					if(!$query) {
						DB::rollback();
						return false;
					}
				} else {
					$query = ConfigOther::create($data);
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
		
		public function postConfigLanguage($request)
		{
			self::__construct();
			try {
				DB::beginTransaction();
				$data = [];
				$data_exchange = [];
				if($request->action == 'update' || $request->action == 'delete') {
					$query = ConfigLanguage::find($request->id);
					if(!$query) {
						DB::rollback();
						return false;
					}
				}
				if($request->has('name') && !empty($request->name)) {
					$data['name'] = $request->name;
				}
				if($request->has('currency_code') && !empty($request->currency_code)) {
					$data['currency_code'] = $request->currency_code;
				}
				if($request->has('date_format') && !empty($request->date_format)) {
					$data['date_format'] = $request->date_format;
				}
				if($request->has('rate') && !empty($request->rate)) {
					$data_exchange['rate'] = $request->rate;
				}
				if($request->type == 2) {
					$data['default'] = 1;
				}
				
				if($request->action == 'update') {
					if (count($data) > 0) {
						if($request->type == 1) {
							$query->update($data);
							$query_exchange = MExchangeRate::where('language_id', $request->id);
							$query_exchange->update($data_exchange);
							$query_reset = true;
						} else {
							$query_reset = ConfigLanguage::where('default', '!=', 0);
							if($query_reset->count() > 0) {
								$query_reset = $query_reset->update(['default' => 0]);
							} else {
								$query_reset = true;
							}
							$query->update($data);
						}
						if (!$query || !$query_reset) {
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
					$query = ConfigLanguage::create($data);
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
	
    public function getConfigMain()
    {
        self::__construct();
        try {
            $data = ConfigMain::with('configMainTranslations')->first();
            if (!empty($data)) {
                return self::JsonExport(200, 'success', $data);
            } else {
                return self::JsonExport(404, 'error', null);
            }
        } catch (\Exception $e) {
            return self::JsonExport(500, 'error', null);
        }
    }
    
		public function getConfigOther()
		{
			self::__construct();
			try {
				$data = ConfigOther::all();
				if (!empty($data)) {
					return self::JsonExport(200, 'success', $data);
				} else {
					return self::JsonExport(404, 'error', null);
				}
			} catch (\Exception $e) {
				return self::JsonExport(500, 'error', null);
			}
		}
		
    public function getDTConfigLanguage()
    {
        self::__construct();
        try {
                $data = ConfigLanguage::all();
                return Datatables::of($data)
								->addColumn('default', function ($v) {
									if($v->default) {
										return '<input data-id="' . $v->id . '" id="rdEnable" type="radio" class="minimal" checked name="default">';
									} else {
										return '<input data-id="' . $v->id . '" id="rdEnable" type="radio" class="minimal" name="default">';
									}
								})
                ->addColumn('action', function ($v) {
                    return '<a class="table-action table-action-edit text-green cursor-pointer" data-id="'.$v->id.'"><i class="fa fa-edit"></i></a>';
                })
								->addIndexColumn()
                ->rawColumns(['action', 'default'])
                ->make(true);
        } catch (\Exception $e) {
            return null;
        }
    }
    
		public function getLanguage($id)
		{
			self::__construct();
			try {
				$data = ConfigLanguage::with('mExchangeRate')->where('id', $id)->first();
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
