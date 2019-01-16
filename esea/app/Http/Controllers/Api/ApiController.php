<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Validator;
use Hash;
use Carbon\Carbon;
use Cocur\Slugify\Slugify;
use Jenssegers\Agent\Agent;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Services\DataTable;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Models\ConfigCity;
use App\Models\ConfigMainTranslation;

class ApiController extends Controller
{
    protected $instance;

    protected $config_main;

    protected $config_language;

    public function __construct()
    {
        $this->instance = $this->instance(\App\Http\Controllers\Helper\Front\Helper::class);
        $this->config_main = $this->instance->getConfig();
        $this->config_language = $this->instance->getConfigLanguage();
    }

    public function api_get_child_id(Request $request) {
        $rules = array(
            'id' => 'required|digits_between:1,10',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return self::JsonExport(403, 'Vui lòng kiểm tra lại thông tin');
        } else {
            try {
                $child = $this->instance->getChild($request->id);
                if(!empty($child)) {
                    return self::JsonExport(200, 'Success', $child);
                } else {
                    return self::JsonExport(500, 'Vui lòng kiểm tra lại thông tin');
                }
               
            } catch (\Exception $e) {
                return self::JsonExport(500, 'Vui lòng kiểm tra lại thông tin');
            }
        }
    }

    public function api_get_city(Request $request)
    {
        $rules = array(
            'term' => 'max:50',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return self::JsonExport(200, 'Success');
        } else {
            try {
                return self::JsonExport(200, 'Success', $this->instance->getCity($request->term));
            } catch (\Exception $e) {
                return self::JsonExport(200, 'Success');
            }
        }
    }

    public function api_post_subscribe(Request $request) {
        $rules = array(
            'email' => 'required|email'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return self::JsonExport(403, 'Sai định dạng email');
        } else {
            try {
                $subscribe = $this->instance->getSubscribes($request->email);
                if($subscribe === true) {
                    return self::JsonExport(200, 'Bạn đã đăng ký nhận tin thành công.');
                } else {
                    return self::JsonExport(500, $subscribe);
                }
            } catch (\Exception $e) {
                return self::JsonExport(500, 'Có lỗi trong quá trình xử lý.');
            }
        }
    }

    public function api_post_map(Request $request) 
    {
        $rules = array(
            'lat' => 'required',
            'lng' => 'required',
            'language' => 'required|digits_between:1,10'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return self::JsonExport(403, 'Sai tọa độ');
        } else {
            try {
                if($this->instance->validateLatLong($request->lat, $request->lng)) {
                    $listID = [];
                    $language = $this->instance->getConfigLanguage($request->language)[0]->id;
                    $distance = ConfigMainTranslation::where('language_id', $language)->pluck('distance_google')->first();
                    $query_near = DB::select(DB::raw("SELECT m_school.id, m_school.lat, m_school.lng, m_school_translation.slug, m_school_translation.name, m_school_translation.address, m_school_translation.phone, m_school_translation.email, (6373 * acos(cos(radians(".$request->lat.")) * cos(radians( lat )) * cos(radians(lng) - radians(".$request->lng.")) + sin(radians(".$request->lat.")) * sin(radians(lat)))) AS distance FROM m_school JOIN m_school_translation ON m_school.id = m_school_translation.translation_id WHERE m_school_translation.language_id = ".$language." HAVING distance < ".$distance." ORDER BY distance;"));
                    foreach($query_near as $k => $v) {
                        array_push($listID, $v->id);
                    }
                    $schools = $this->instance->getSchool(null, null, null, $listID);
                    return $schools;
                } else {
                    return self::JsonExport(403, 'Sai tọa độ');
                }
            } catch (\Exception $e) {
                return self::JsonExport(403, 'Sai tọa độ');
            }
        }
    }

    public function api_post_child_delete(Request $request) 
    {
        $rules = array(
            'idChild' => 'required|digits_between:1,10',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return self::JsonExport(403, 'Vui lòng kiểm tra lại thông tin');
        } else {
            try {
                $update = $this->instance->updateChild($request, true);
                if($update === true) {
                    return self::JsonExport(200, 'Xóa thành công');
                } else {
                    return self::JsonExport(403, 'Vui lòng kiểm tra lại thông tin');
                }
           } catch (\Exception $e) {
               return self::JsonExport(500, 'Vui lòng kiểm tra lại thông tin');
           }
        }
    }

    public function api_post_child_update(Request $request) 
    {
        $rules = array(
            'idChild' => 'required|digits_between:1,10',
            'nameChild' => 'required|min:1|max:50',
            'genderChild' => 'required|boolean',
            'birthChild' => 'required|date_format:Y-m-d|before:today'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return self::JsonExport(403, 'Vui lòng kiểm tra lại thông tin');
        } else {
            try {
                // if($request->has('genitive') && $request->genitive != "") {
                //     if(strpos($request->genitive, ',') === false) {
                //         return self::JsonExport(403, 'Vui lòng kiểm tra lại thông tin');
                //     }
                // }
                $update = $this->instance->updateChild($request, false);
                if($update === true) {
                    return self::JsonExport(200, 'Cập nhật thành công');
                } else {
                    return self::JsonExport(403, 'Vui lòng kiểm tra lại thông tin');
                }
           } catch (\Exception $e) {
               return self::JsonExport(500, 'Vui lòng kiểm tra lại thông tin');
           }
        }
    }

    public function api_post_child_add(Request $request) 
    {
        $rules = array(
            'nameAddChild' => 'required|min:1|max:50',
            'genderAddChild' => 'required|boolean',
            'birthAddChild' => 'required|date_format:Y-m-d|before:today'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return self::JsonExport(403, 'Vui lòng kiểm tra lại thông tin');
        } else {
            try {
                // if($request->has('genitiveAddChild') && $request->genitiveAddChild != "") {
                //     if(strpos($request->genitiveAddChild, ',') === false) {
                //         return self::JsonExport(403, 'abcc');
                //     }
                // }
                $update = $this->instance->addChild($request);
                if($update === true) {
                    return self::JsonExport(200, 'Cập nhật thành công');
                } else {
                    return self::JsonExport(403, 'Vui lòng kiểm tra lại thông tin');
                }
           } catch (\Exception $e) {
               return self::JsonExport(500, 'Vui lòng kiểm tra lại thông tin');
           }
        }
    }

    public function api_post_change_password(Request $request) 
    {
        $rules = array(
            'oldPassword' => 'required|min:1|max:50',
            'newPassword' => 'required|min:1|max:50',
            'renewPassword' => 'required|min:1|max:50',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return self::JsonExport(403, 'Vui lòng kiểm tra lại thông tin');
        } else {
            try {
                $update = $this->instance->changePassword($request);
                if($update === true) {
                    return self::JsonExport(200, 'Đổi mật khẩu thành công');
                } else {
                    return self::JsonExport(403, 'Vui lòng kiểm tra lại thông tin');
                }
           } catch (\Exception $e) {
               return self::JsonExport(500, 'Vui lòng kiểm tra lại thông tin');
           }
        }
    }

    public function api_post_account_update(Request $request)
    {
        $rules = array(
            'logo' => 'base64image',
            'name' => 'required|min:1|max:50',
            'gender' => 'required|boolean',
            'dob' => 'required|date_format:Y-m-d|before:today',
            'phone' => 'required|digits_between:1,10'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return self::JsonExport(403, 'Vui lòng kiểm tra lại thông tin');
        } else {
            try {
                $update = $this->instance->updateAccount($request);
                if($update === true) {
                    return self::JsonExport(200, 'Cập nhật thành công');
                } else {
                    return self::JsonExport(403, 'Vui lòng kiểm tra lại thông tin');
                }
            } catch (\Exception $e) {
                return self::JsonExport(500, 'Vui lòng kiểm tra lại thông tin');
            }
        }
    }

    public function api_post_map_get(Request $request) 
    {
        $rules = array(
            'id' => 'required|digits_between:1,10',
            'language' => 'required|digits_between:1,10'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return self::JsonExport(403, 'Sai tọa độ 1');
        } else {
            try {
                $listID = [];
                $distance = 100;
                $language = $this->instance->getConfigLanguage($request->language)[0]->id;
                $query_near = DB::select(DB::raw("SELECT m_school.id, m_school.lat, m_school.lng, m_school_translation.slug, m_school_translation.name, m_school_translation.address, m_school_translation.phone, m_school_translation.email, (6373 * acos(cos(radians(".$request->lat.")) * cos(radians( lat )) * cos(radians(lng) - radians(".$request->lng.")) + sin(radians(".$request->lat.")) * sin(radians(lat)))) AS distance FROM m_school JOIN m_school_translation ON m_school.id = m_school_translation.translation_id WHERE m_school.id = ".$request->id." AND m_school_translation.language_id = ".$language." HAVING distance < ".$distance." ORDER BY distance;"));
                foreach($query_near as $k => $v) {
                    array_push($listID, $v->id);
                }
                $schools = $this->instance->getSchool(null, null, null, $listID);
                return $schools;
            } catch (\Exception $e) {
                return self::JsonExport(403, 'Sai tọa độ 2');
            }
        }
    }

    public function api_post_wishlist(Request $request) 
    {
        $rules = array(
            'id' => 'required|digits_between:1,10',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return self::JsonExport(403, 'Vui lòng kiểm tra thông tin');
        } else {
            try {
                if($this->instance->getWishlist($request->id, $request->action) === true) {
                    if($request->action == 1) {
                        return self::JsonExport(200, 'Đã thêm vào danh sách yêu thích thành công.');
                    } else {
                        return self::JsonExport(200, 'Đã xóa khỏi danh sách yêu thích thành công.');
                    }
                } else {
                    return self::JsonExport(403, 'Vui lòng kiểm tra thông tin');
                }
            } catch (\Exception $e) {
                return self::JsonExport(403, 'Vui lòng kiểm tra thông tin');
            }
        }
    }

    public function api_post_map_other(Request $request) 
    {
        $rules = array(
            'lat' => 'required',
            'lng' => 'required',
            'language' => 'required|digits_between:1,10'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return self::JsonExport(403, 'Sai tọa độ');
        } else {
            try {
                $listID = [];
                $distance = 100;
                $language = $this->instance->getConfigLanguage($request->language)[0]->id;
                $query_near = DB::select(DB::raw("SELECT m_school.id, m_school.lat, m_school.lng, m_school_translation.slug, m_school_translation.name, m_school_translation.address, m_school_translation.phone, m_school_translation.email, (6373 * acos(cos(radians(".$request->lat.")) * cos(radians( lat )) * cos(radians(lng) - radians(".$request->lng.")) + sin(radians(".$request->lat.")) * sin(radians(lat)))) AS distance FROM m_school JOIN m_school_translation ON m_school.id = m_school_translation.translation_id WHERE m_school_translation.language_id = ".$language." HAVING distance < ".$distance." ORDER BY distance;"));
                foreach($query_near as $k => $v) {
                    array_push($listID, $v->id);
                }
                $schools = $this->instance->getSchool(null, null, null, $listID);
                return $schools;
            } catch (\Exception $e) {
                return self::JsonExport(403, 'Sai tọa độ');
            }
        }
    }

    public function api_post_review(Request $request) 
    {
        $rules = array(
            'rating' => 'required|digits_between:1,5',
            'school_id' => 'required|digits_between:1,10',
            'comment' => 'required|max:200',
            'g-recaptcha-response' => 'required|recaptcha',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return self::JsonExport(500, 'Vui lòng kiểm tra lại thông tin');
        } else {
            try {
                $reviewSchool = $this->instance->postReviewSchool($request);
               
                if($reviewSchool === true) {
                    return self::JsonExport(200, 'Cảm ơn bạn đã đánh giá. Chúng tôi sẽ xem xét và cho phép bình luận của bạn được hiển thị.');
                } else {
                    return self::JsonExport(500, 'Vui lòng kiểm tra lại thông tin');
                }
           } catch (\Exception $e) {
               return self::JsonExport(500, 'Vui lòng kiểm tra lại thông tin');
           }
        }

    }

    public function api_post_rating(Request $request) 
    {
        $rules = array(
            'rating' => 'required|digits_between:1,10|min:1|max:10',
            'school_id' => 'required|digits_between:1,10',
            'category_id' => 'required|digits_between:1,10'
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return self::JsonExport(500, 'Vui lòng kiểm tra lại thông tin');
        } else {
            try {
                $ratingSchool = $this->instance->postRatingSchool($request);
               
                if($ratingSchool === true) {
                    return self::JsonExport(200, 'Cảm ơn bạn đã đánh giá.');
                } else {
                    return self::JsonExport(500, 'Vui lòng kiểm tra lại thông tin');
                }
           } catch (\Exception $e) {
               return self::JsonExport(500, 'Vui lòng kiểm tra lại thông tin');
           }
        }

    }
}