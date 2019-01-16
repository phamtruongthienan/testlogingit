<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Models\ConfigLanguage;
use App\Models\MSlug;
use App\Models\MExchangeRate;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    static public function ExchangeRate($id) 
    {
        try {
            $data = MExchangeRate::where('language_id',$id)->first();
            if($data) {
                if($id == 1){
                    return 1;
                }
                return $data->rate;
            } else {
                return 1;
            }
        } catch (\Exception $e) {
            return 1;
        }
    }

    static public function FetchLanguage($id) 
    {
        try {
            $data = ConfigLanguage::find($id);
            if($data) {
                return $data;
            } else {
                return null;
            }
        } catch (\Exception $e) {
            return null;
        }
    }

    static public function JsonExport($code, $msg, $data = null, $optinal = null)
    {
        try {
            $callback = [
                'code' => $code,
                'msg' => $msg
            ];
            if ($data != null) {
                $callback['data'] = $data;
            } else {
                $callback['data'] = (object)[];
            }
            if ($optinal != null && is_array($optinal)) {
                if (count($optinal) > 1) {
                    for ($i = 0; $i < count($optinal); $i++) {
                        $callback[$optinal[$i]['name']] = $optinal[$i]['data'];
                    }
                } else {
                    $callback[$optinal[0]['name']] = $optinal[0]['data'];
                }
            }
            return response()->json($callback, 200, [], JSON_NUMERIC_CHECK);
        } catch (\Exception $e) {
            return response()->json(['code' => 500, 'msg' => 'Error'], 200, [], JSON_NUMERIC_CHECK);
        }
    }

    static public function Pagination($result, $page, $record = 10)
    {
        try {
            if ($record != null && $page != null) {
                $count_all = $result->count();
                $custom = collect(['recordsTotal' => $count_all, 'recordsFiltered' => $count_all]);
                $pagination = $result->paginate($record, ['*'], 'page', $page)->appends(Input::except('page'));
                $data = $custom->merge($pagination);
                return $data;
            } else {
                return $result->get();
            }
        } catch (\Exception $e) {
            return null;
        }
    }
    
    public function DecodeImage($file) {
        try {
            $file_tmp = explode(';', $file);
            $file_tmp1 = explode(',', $file_tmp[1]);
            return base64_decode($file_tmp1[1]);
        } catch (\Exception $e) {
            return null;
        }
    }


    public function instance($class)
    {
        try {
            $instantiator = new \Doctrine\Instantiator\Instantiator();
            $instance = $instantiator->instantiate($class);
            return $instance;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function renderTrans($query, $data, $optional = null) {
        try {
            DB::beginTransaction();
            $config = new ConfigLanguage;
            $result = true;
            if($config->count() > 0) {
                foreach($config->get() as $k => $v) {
                    $data['language_id'] = $v->id;
                    if(!empty($optional)) {
                        $data['slug'] = $optional;
                    } else {
                        if(!empty($data['slug_name']) && !empty($data['slug_category']) && !empty($data['slug_prefix'])) {
                            $data['slug'] = self::slugify($data['slug_name'].'-'.$v->code, $data['slug_prefix']);
                        }
                    }
                    $trans = $query->create($data);
                    if(!$trans) {
                        $result = false;
                    }
                    if(empty($optional)) {
                        if(!empty($data['slug']) && !empty($data['slug_category'])) {
                            $new_slug = MSlug::create(['slug' => $data['slug'], 'category' => $data['slug_category']]);
                            if(!$new_slug) {
                                $result = false;
                            }
                        }
                    }
                }
            }
            if($result) {
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

    public function slugreload($old,$new,$model)
    {
        try {
            DB::beginTransaction();
            $result = true;
            $remove = MSlug::where('slug', $old)->delete();
            if(!$remove) {
                $result = false;
            }
            $insert = MSlug::create(['slug' => $new, 'category' => $model]);
            if(!$insert) {
                $result = false;
            }
            if($result) {
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

    public function slugable($slug) 
    {
        $check = MSlug::where('slug', $slug)->count();
        if($check > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function slugify($text, $prefix = null)
    {
        $text = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $text);
        $text = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $text);             
        $text = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $text);             
        $text = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $text);             
        $text = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $text);             
        $text = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $text);             
        $text = preg_replace("/(đ)/", 'd', $text);             
        $text = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $text);
        $text = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $text);
        $text = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $text);             
        $text = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $text);
        $text = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $text);
        $text = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $text);             
        $text = preg_replace("/(Đ)/", 'D', $text);
        $text = str_replace(" ", "-", str_replace("&*#39;","",$text));             
        $text = mb_strtolower($text);
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        //$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = mb_strtolower($text);
        if($prefix !== null) {
            $check = self::slugable($prefix.'/'.$text);
            if($check) {
                return $prefix.'/'.$text;
            } else {
                $text .= '-'.md5(time());
                return self::slugify($text, $prefix);
            }
        } else {
            $check = self::slugable($text);
            if($check) {
                return $text;
            } else {
                $text .= '-'.mb_strtolower(str_random(20));
                return self::slugify($text);
            }
        }
        
    }
}
