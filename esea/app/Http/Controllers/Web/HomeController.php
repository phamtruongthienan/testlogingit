<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Validator;
use Hash;
use Socialite;
use Carbon\Carbon;
use Cocur\Slugify\Slugify;
use Jenssegers\Agent\Agent;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Services\DataTable;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class HomeController extends Controller
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

    public function homepage_index(Request $request)
    {
        try {
            $school = $this->instance->getSchool($this->config_main[0]->configMaintranslations[0]->num_school);
            $promotion = $this->instance->getPromotion(null, 5, $this->config_main[0]->configMaintranslations[0]->num_promo);
            $client = $this->instance->getClient($this->config_main[0]->configMaintranslations[0]->num_client);
            $promotion_top = $this->instance->getPromotion(null, 4, 3, null, 3);
            $school_service = $this->instance->getSchoolService();
            $school_level = $this->instance->getSchoolLevel();
            $school_type =  $this->instance->getSchoolType();
            $school_language =  $this->instance->getSchoolLanguage();

            $callback = [
                'client' => $client,
                'promotion' => $promotion,
                'promotion_top' => $promotion_top,
                'school' => $school,
                'school_service' => $school_service,
                'school_level' => $school_level,
                'school_type' => $school_type,
                'school_language' => $school_language,
            ];
            return view('theme.frontend.page.home')->with($callback);
       } catch (\Exception $e) {
           return abort(404);
       }
    }

    public function homepage_login(Request $request)
    {
        try {
            if(Auth::user()) {
                return redirect()->route('home.index');
            }
            return view('theme.frontend.page.login');
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function homepage_signup(Request $request)
    {
        try {
            if(Auth::user()) {
                return redirect()->route('home.index');
            }
            return view('theme.frontend.page.signup');
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function homepage_reset_password(Request $request)
    {
        try {
            if(Auth::user()) {
                return redirect()->route('home.index');
            }
            return view('theme.frontend.page.reset_password');
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function homepage_account(Request $request) {
        try {
            $customer = $this->instance->getAccount();
            $genitive = $this->instance->getGenitive();
            $callback = [
                'customer' => $customer,
                'genitive' => $genitive
            ];
            if (!empty($customer)) {
                return view('theme.frontend.page.account')->with($callback);
            } else {
                return abort(404);
            }
       } catch (\Exception $e) {
           return abort(404);
       }
    }

    public function homepage_map(Request $request)
    {
        try {
            return view('theme.frontend.page.map');
       } catch (\Exception $e) {
           return abort(404);
       }
    }

    public function homepage_school(Request $request)
    {
        try {
           $parse_url = parse_url($_SERVER['REQUEST_URI']);
            if(isset($parse_url['query'])) {
                $schools = $this->instance->getSearchSchool(null, config('constant.pagination'), $request);
            } else {
                $schools = $this->instance->getSchool(null, config('constant.pagination'));
            }
            $attribute = $this->instance->getAttribute();
            $sorts_query_low = $request->fullUrlWithQuery(['sorts' => 'low']);
            $sorts_query_high = $request->fullUrlWithQuery(['sorts' => 'high']);
            $school_service = $this->instance->getSchoolService();
            $school_level = $this->instance->getSchoolLevel();
            $school_type =  $this->instance->getSchoolType();
            $school_language =  $this->instance->getSchoolLanguage();
            $callback = [
                'sorts_query_low' => $sorts_query_low,
                'sorts_query_high' => $sorts_query_high,
                'schools' => $schools,
                'attribute' => $attribute,
                'school_service' => $school_service,
                'school_level' => $school_level,
                'school_type' => $school_type,
                'school_language' => $school_language,
            ];
            if (!empty($schools)) {
                return view('theme.frontend.page.schools')->with($callback);
            } else {
                return abort(404);
            }

      } catch (\Exception $e) {
          return abort(404);
      }
    }

    public function homepage_detail_school(Request $request)
    {
      //  try {
            $school_detail = $this->instance->getSchoolDetail($request->id);
            $reviewed = $this->instance->getReviewSchoolbyMe($request->id);
            $category = $this->instance->getCategory();
            $callback = [
                'school_detail' => $school_detail,
                'category' => $category,
                'reviewed' => $reviewed
            ];
            if (!empty($school_detail)) {
                $post = \App\Models\MSchool::find($request->id);
                $post->visit();
                return view('theme.frontend.page.school_detail')->with($callback);
            } else {
                return abort(404);
            }
      //  } catch (\Exception $e) {
      //      return abort(404);
      //  }
    }

    public function getConfigSocial($service)
    {
        try {
            $config = $this->instance->getConfigOther($service);
            if (empty($config[0]['value']) || empty($config[1]['value']) || empty($config[2]['value'])) {
                return abort(404);
            }
            if ($service == 'facebook') {
                $provider = \Laravel\Socialite\Two\FacebookProvider::class;
            } else {
                $provider = \Laravel\Socialite\Two\GoogleProvider::class;
            }
            $config = [
                'client_id' => $config[0]['value'],
                'client_secret' => $config[1]['value'],
                'redirect' => $config[2]['value']
            ];
            return Socialite::buildProvider($provider, $config);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function homepage_social_login(Request $request)
    {
        try {
            $provider = $this->getConfigSocial($request->provider);
            if ($request->provider == 'facebook') {
                return $provider->fields([
                    'name', 'first_name', 'last_name', 'name_format', 'email', 'gender', 'birthday', 'location'
                ])->scopes([
                    'email', 'user_birthday', 'user_gender', 'user_location'
                ])->redirect();
            } else {
                return $provider->redirect();
            }
        } catch (\Exception $e) {
            return redirect('login')->withErrors('Đăng nhập thất bại. Vui lòng thử lại sau.');
        }
    }

    public function homepage_social_callback(Request $request)
    {
        try {
            $provider = $this->getConfigSocial($request->provider);
            if ($request->provider == 'facebook') {
                $user = $provider->fields([
                    'name', 'first_name', 'last_name', 'name_format', 'email', 'gender', 'birthday', 'location'
                ])->user();
                if (!empty($user->user['gender'])) {
                    if ($user->user['gender'] == 'male') {
                        $gender = 1;
                    } else if ($user->user['gender'] == 'female') {
                        $gender = 0;
                    } else {
                        $gender = 2;
                    }
                } else {
                    $gender = 2;
                }
                $login_data = [
                    'email' => $user->email,
                    'password' => Hash::make(str_random(16)),
                    'name' => (!empty($user->name)) ? $user->name : null,
                    'address' => (!empty($user->user['location']['name'])) ? $user->user['location']['name'] : null,
                    'dob' => (!empty($user->user['birthday'])) ? Carbon::parse($user->user['birthday'])->format('Y-m-d') : null,
                    'phone' => null,
                    'logo' => (!empty($user->avatar)) ? $user->avatar : null,
                    'type' => 2,
                    'gender' => $gender,
                    'status' => 2,
                    'lat' => null,
                    'long' => null
                ];
            } else {
                $user = $provider->user();
                if (!empty($user->user['gender'])) {
                    if ($user->user['gender'] == 'male') {
                        $gender = 1;
                    } else if ($user->user['gender'] == 'female') {
                        $gender = 0;
                    } else {
                        $gender = 2;
                    }
                } else {
                    $gender = 2;
                }
                $login_data = [
                    'email' => $user->email,
                    'password' => Hash::make(str_random(16)),
                    'name' => (!empty($user->name)) ? $user->name : null,
                    'address' => (!empty($user->user['placesLived']['value'])) ? $user->user['placesLived']['value'] : null,
                    'dob' => null,
                    'phone' => null,
                    'logo' => (!empty($user->avatar)) ? $user->avatar : null,
                    'type' => 2,
                    'gender' => $gender,
                    'status' => 2,
                    'lat' => null,
                    'long' => null
                ];
            }

            $check = $this->instance->checkEmailCustomer($user->email);

            if ($check !== null) {
                if ($check === true) {
                    $register = $this->instance->registerCustomer($login_data);
                    if (!empty($register)) {
                        return redirect('/');
                    } else {
                        return redirect('login')->withErrors('Đăng nhập thất bại. Vui lòng thử lại sau.');
                    }
                } else {
                    if ($this->instance->loginCustomer($check)) {
                        return redirect('/');
                    } else {
                        return redirect('login')->withErrors('Đăng nhập thất bại. Vui lòng thử lại sau.');
                    }
                }
            } else {
                return redirect('login')->withErrors('Đăng nhập thất bại. Vui lòng thử lại sau.');
            }
        } catch (\Exception $e) {
            return redirect('login')->withErrors('Đăng nhập thất bại. Vui lòng thử lại sau.');
        }
    }

    public function homepage_logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function homepage_view_pdf(Request $request) 
    {
        $rules = array(
            'filename' => 'required|max:200',
        );
        $validator = Validator::make(['filename' => $request->filename], $rules);
        if ($validator->fails()) {
            return redirect('/');
        } else {
            try {
                $filename = base64_decode(basename($request->filename, '.pdf')).'.pdf';
                $file = public_path('img/uploads/pdf/'.$filename);
                if(file_exists($file)) {
                    return response()->file($file);
                } else {
                    return redirect('/');
                }
          } catch (\Exception $e) {
                return redirect('/');
            }
        }
    }

    public function homepage_reset_password_action(Request $request)
    {
        $rules = array(
            'email' => 'required|email|max:64',
            'g-recaptcha-response' => 'required|recaptcha'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return self::JsonExport(500, 'Vui lòng kiểm tra lại thông tin');
        } else {
           try {
                $new_password = str_random(10);
                $data = $this->instance->postResetCustomer($request, $new_password);
                if ($data === true) {
                    return self::JsonExport(200, 'Yêu cầu thành công');
                } else {
                    return self::JsonExport(500, 'Vui lòng kiểm tra lại thông tin');
                }
           } catch (\Exception $e) {
               return self::JsonExport(500, 'Vui lòng kiểm tra lại thông tin');
           }
        }
    }

    public function homepage_signup_action(Request $request)
    {
        $rules = array(
            'email' => 'required|email|max:64',
            'phone' => 'required|max:20',
            'password' => 'required|min:6|max:20',
            'repassword' => 'required|min:6|max:20|same:password',
            'name' => 'required|min:3|max:100',
            'checkagree' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return self::JsonExport(500, 'Vui lòng kiểm tra lại thông tin');
        } else {
            try {
                $user = $this->instance->postSignupCustomer($request);
                if (!empty($user)) {
                    return self::JsonExport(200, 'Đăng ký thành công');
                } else {
                    return self::JsonExport(500, 'Vui lòng kiểm tra lại thông tin');
                }
            } catch (\Exception $e) {
                return self::JsonExport(500, 'Vui lòng kiểm tra lại thông tin');
            }
        }
    }

    public function homepage_login_action(Request $request)
    {
        $rules = array(
            'email' => 'required',
            'password' => 'required|min:6'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return redirect('login')->withErrors('Vui lòng kiểm tra lại tài khoản');
        } else {
            try {
                $user = $this->instance->postLoginCustomer($request);
                if (!empty($user)) {
                    if(!empty($request->ref)) {
                        return redirect($request->ref);
                    } else {
                        return redirect('/');
                    }
                } else {
                    return redirect('login')->withErrors('Vui lòng kiểm tra lại tài khoản');
                }
            } catch (\Exception $e) {
                return redirect('login')->withErrors('Vui lòng kiểm tra lại tài khoản');
            }
        }
    }

    public function homepage_promotion(Request $request)
    {
        try {
            $promotion = $this->instance->getPromotion(null, null, null, true);
            $callback = [
                'promotion' => $promotion,
            ];
            if (!empty($promotion)) {
                return view('theme.frontend.page.promotion')->with($callback);
            } else {
                return abort(404);
            }

        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function homepage_promo_detail(Request $request) 
    {
       try {
            $promotion = $this->instance->getPromotion('promo/'.$request->slug);
            $callback = [
                'promotion' => $promotion,
            ];
            if (!empty($promotion)) {
                return view('theme.frontend.page.promotion_detail')->with($callback);
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function send_contact(Request $request) 
    {
        $rules = array(
            'emailContact' => 'required|max:256',
            'selectContact' => 'required|max:256',
            'subjectContact' => 'required|max:256',
            'messageContact' => 'required|max:500',
            'g-recaptcha-response' => 'required|recaptcha',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return self::JsonExport(403, 'Vui lòng kiểm tra lại thông tin');
        } else {
            try {
                $contact = $this->instance->sendContact($request);
                if($contact === true){
                    return self::JsonExport(200, 'Cảm ơn bạn đã gửi phản hồi. Chúng tôi sẽ liên lạc trong thời gian sớm nhất.');
                } else {
                    return self::JsonExport(403, 'Vui lòng kiểm tra lại thông tin');
                }
            } catch (\Exception $e) {
                return self::JsonExport(403, 'Vui lòng kiểm tra lại thông tin');
            }
        }
    }

    public function booking(Request $request) 
    {
        $rules = array(
            'bookingName' => 'required|max:50',
            'bookingPhone' => 'required|max:50',
            'bookingEmail' => 'required|max:100',
            'bookingMessage' => 'required|max:500',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return self::JsonExport('Vui lòng kiểm tra lại thông tin');
        } else {
            try {
                $contact = $this->instance->booking($request);
                if($contact === true){
                    return self::JsonExport(200, 'Bạn đã đặt lịch tham quan trường thành công.');
                } else {
                    return self::JsonExport(403, 'Vui lòng kiểm tra lại thông tin 1');
                }
            } catch (\Exception $e) {
                return self::JsonExport(403, 'Vui lòng kiểm tra lại thông tin2');
            }
        }
    }
}