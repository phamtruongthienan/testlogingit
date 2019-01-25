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
use App\Models\Role;
use App\Models\MGenitive;
use App\Models\MSchool;
use App\Models\Permission;
use App\Models\MLayout;
use App\Models\MNewsTranslation;
use App\Models\MNews;

class AdminController extends Controller
{
	protected $instance;
	
	protected $config_main;
	
	protected $config_language;
	
	public function __construct()
	{
		$this->instance = $this->instance(\App\Http\Controllers\Helper\Back\Helper::class);
		$this->config_main = $this->instance->getConfig();
		$this->config_language = $this->instance->getConfigLanguage();
	}
	
	public function admin_logout_index(Request $request)
	{
        Auth::guard('admin')->logout();
        return redirect()->route('admin.index');;
	}

	public function admin_login_action(Request $request)
	{
		$rules = array(
            'email' => 'required',
            'password' => 'required|min:6'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('admin.login')->withErrors('Vui lòng kiểm tra lại tài khoản');
        } else {
            try {
                $user = $this->instance->postLoginAdmin($request);
                if (!empty($user)) {
                    return redirect()->route('admin.index');
                } else {
                    return redirect()->route('admin.login')->withErrors('Vui lòng kiểm tra lại tài khoản');
                }
           } catch (\Exception $e) {
               return redirect()->route('admin.login')->withErrors('Vui lòng kiểm tra lại tài khoản');
           }
        }
	}

	public function admin_login_index(Request $request)
	{
		try {
            if(Auth::guard('admin')->user()) {
                return redirect()->route('admin.index');
            }
			return view('theme.backend.page.login');
        } catch (\Exception $e) {
            return abort(404);
		}
	}

	public function admin_home_index(Request $request)
	{
		try {
			return view('theme.backend.page.home');
		} catch (\Exception $e) {
			return abort(404);
		}
	}
	public function admin_post_advertise_ajax(Request $request)
	{
		$rules = array(
			'type' => 'required|digits_between:1,10',
			'content' => 'min:1|max:5000',
			'position' => 'digits_between:1,10',
			'target' => 'digits_between:1,10',
			'link' => 'nullable|url|max:200',
			'start_date' => 'required|date_format:Y-m-d',
			'end_date' => 'nullable|date_format:Y-m-d|after:today',
			'status' => 'nullable|in:on,off',
			'image_hash' => 'nullable|base64image',
			'action' => 'required|in:insert,update,delete',
		);
		if($request->action == 'update') {
			$rules['id'] = 'required|digits_between:1,10';
		} else if($request->action == 'delete') {
			$rules = array('id' => 'required|digits_between:1,10');
		}
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
			return self::JsonExport(403, $validator->errors());
        } else {
            try {
				$instance = self::instance(\App\Http\Controllers\Helper\Back\Advertise::class);
                $data = $instance->postAdvertise($request);
                if ($data === true) {
                    return self::JsonExport(200, 'Cập nhật thông tin thành công');
                } else {
                    return self::JsonExport(403, 'Vui lòng kiểm tra lại thông tin');
                }
			} catch (\Exception $e) {
				return self::JsonExport(500, 'Vui lòng kiểm tra lại thông tin');
			}
        }
	}
	
	public function admin_advertise_ajax(Request $request)
	{
		$instance = self::instance(\App\Http\Controllers\Helper\Back\Advertise::class);
		if($request->has('id') && !empty($request->id)) {
			return $data = $instance->getAdvertise($request->id);
		}
		return $data = $instance->getDTAdvertise();
	}

	public function admin_advertise_index(Request $request)
	{
		try {
			return view('theme.backend.page.advertise');
		} catch (\Exception $e) {
			return abort(404);
		}
	}

	public function admin_employee_ajax(Request $request)
	{
		$instance = self::instance(\App\Http\Controllers\Helper\Back\Employee::class);
		if($request->has('id') && !empty($request->id)) {
			return $data = $instance->getEmployee($request->id);
		}
		return $data = $instance->getDTEmployee();
	}

	public function admin_language_ajax(Request $request)
	{
		$instance = self::instance(\App\Http\Controllers\Helper\Back\Language::class);
		if($request->has('id') && !empty($request->id)) {
			return $data = $instance->getLanguage($request->id,$request->lang);
		}
		return $data = $instance->getDTLanguage();
	}

	public function admin_post_language_ajax(Request $request)
	{
		$rules = array(
			'inputAddName' => 'min:1|max:255',
			'action' => 'required|in:insert,update,delete',
		);
		if($request->action == 'update') {
			$rules['id'] = 'required|digits_between:1,10';
		} else if($request->action == 'delete') {
			$rules = array('id' => 'required');
		}
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
			return self::JsonExport(403, $validator->errors());
		} else {
			try {
				$instance = self::instance(\App\Http\Controllers\Helper\Back\Language::class);
				$data = $instance->postLanguage($request);
				if ($data === true) {
					switch ($request->action) {
						case 'update':
							return self::JsonExport(200, 'Cập nhật thông tin thành công');
						case 'insert':
							return self::JsonExport(200, 'Thêm thông tin thành công');
						default:
							return self::JsonExport(200, 'Xóa thông tin thành công');
					}
				} else {
					return self::JsonExport(403, 'Vui lòng kiểm tra lại thông tin 2');
				}
			} catch (\Exception $e) {
				return self::JsonExport(500, 'Vui lòng kiểm tra lại thông tin 3');
			}
		}
	}

	public function admin_news_ajax(Request $request)
	{
		$instance = self::instance(\App\Http\Controllers\Helper\Back\News::class);
		if($request->has('id') && !empty($request->id)) {
			return $data = $instance->getNews($request->id,$request->lang);
		}
		return $data = $instance->getDTNews();
	}

	public function admin_post_news_ajax(Request $request)
	{
		$rules = array(
			'inputAddName' => 'required|min:1|max:255',
			'inputAddSEO' => 'required|min:3|max:255',
			'inputKeyWord' => 'required|min:6|max:255',
			'inputDescription' => 'required|min:|max:255',
			'inputAddContent' => 'required|min:1|max:255',
			'inputAddLayout' => 'required|min:1|max:10',
			'action' => 'required|in:insert,update,delete',
		);
		if($request->action == 'update') {
			$rules['id'] = 'required|digits_between:1,10';
		} else if($request->action == 'delete') {
			$rules = array('id' => 'required|digits_between:1,10');
		}
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
			return self::JsonExport(403, $validator->errors());
		} else {
			try {
				$instance = self::instance(\App\Http\Controllers\Helper\Back\News::class);
				$data = $instance->postNews($request);
				if ($data === true) {
					switch ($request->action) {
						case 'update':
							return self::JsonExport(200, 'Cập nhật thông tin thành công');
						case 'insert':
							return self::JsonExport(200, 'Thêm thông tin thành công');
						default:
							return self::JsonExport(200, 'Xóa thông tin thành công');
					}
				} else {
					return self::JsonExport(403, 'Vui lòng kiểm tra lại thông tin 2');
				}
			} catch (\Exception $e) {
				return self::JsonExport(500, 'Vui lòng kiểm tra lại thông tin 3');
			}
		}
	}

	public function admin_menu_ajax(Request $request)
	{
		$instance = self::instance(\App\Http\Controllers\Helper\Back\Menu::class);
		if($request->has('id') && !empty($request->id)) {
			return $data = $instance->getMenu($request->id,$request->lang);
		}
		return $data = $instance->getDTMenu();
	}

	public function admin_post_menu_ajax(Request $request)
	{
		$rules = array(
			'inputAddName' => 'required|min:1|max:255',
			'inputAddPosition' => 'required',
			// 'inputAddLink' => 'required|min:3|max:255',
			// 'inputAddSelect' => 'required',
			'action' => 'required|in:insert,update,delete',
		);
		if($request->has('inputAddLink') && !empty($request->inputAddLink)) {
			$rules['inputAddLink'] = 'required';
		}
		if($request->has('inputAddSelect') && !empty($request->inputAddSelect)) {
			$rules['inputAddSelect'] = 'required';
		}
		
		if($request->action == 'update') {
			$rules['id'] = 'required|digits_between:1,100';
		} 
		else if($request->action == 'delete') {
			$rules = array('id' => 'required|digits_between:1,10');
		}
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
			return self::JsonExport(403, $validator->errors());
		} else {
			try {
				$instance = self::instance(\App\Http\Controllers\Helper\Back\Menu::class);
				$data = $instance->postMenu($request);
				if ($data === true) {
					switch ($request->action) {
						case 'update':
							return self::JsonExport(200, 'Cập nhật thông tin thành công');
						case 'insert':
							return self::JsonExport(200, 'Thêm thông tin thành công');
						default:
							return self::JsonExport(200, 'Xóa thông tin thành công');
					}
				} else {
					return self::JsonExport(403, 'Vui lòng kiểm tra lại thông tin 2');
				}
			} catch (\Exception $e) {
				return self::JsonExport(500, 'Vui lòng kiểm tra lại thông tin 3');
			}
		}
	}

	public function admin_type_ajax(Request $request)
	{
		$instance = self::instance(\App\Http\Controllers\Helper\Back\Type::class);
		if($request->has('id') && !empty($request->id)) {
			return $data = $instance->getType($request->id,$request->lang);
		}
		return $data = $instance->getDTType();
	}

	public function admin_post_type_ajax(Request $request)
	{
		$rules = array(
			'inputAddName' => 'min:1|max:255',
			'action' => 'required|in:insert,update,delete',
		);
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
			return self::JsonExport(403, $validator->errors());
		} else {
			try {
				$instance = self::instance(\App\Http\Controllers\Helper\Back\Type::class);
				$data = $instance->postType($request);
				if ($data === true) {
					switch ($request->action) {
						case 'update':
							return self::JsonExport(200, 'Cập nhật thông tin thành công');
						case 'insert':
							return self::JsonExport(200, 'Thêm thông tin thành công');
						default:
							return self::JsonExport(200, 'Xóa thông tin thành công');
					}
				} else {
					return self::JsonExport(403, 'Vui lòng kiểm tra lại thông tin 2');
				}
			} catch (\Exception $e) {
				return self::JsonExport(500, 'Vui lòng kiểm tra lại thông tin 3');
			}
		}
	}

	public function admin_post_employee_ajax(Request $request)
	{
		$rules = array(
			'inputEditUserName' => 'required|min:6|max:50',
			'inputEditName' => 'required|min:6|max:50',
			'inputEditBirthday' => 'required|date_format:Y-m-d|before:today',
			'status' => 'nullable|in:on,off',
			'action' => 'required|in:insert,update,delete',
		);
		if (!empty($request->inputEditPassWord)) {
			$rules['inputEditPassWord'] = 'min:6|max:50';
			$rules['inputEditRePassWord'] = 'required|min:6|max:50';
        }
		if($request->action == 'update') {
			$rules['id'] = 'required|digits_between:1,10';
		} else if($request->action == 'delete') {
			$rules = array('id' => 'required|digits_between:1,10');
		}else if($request->action =='insert'){
			$rules['inputEditPassWord'] = 'min:6|max:50';
			$rules['inputEditRePassWord'] = 'required|min:6|max:50';
		}
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
			return self::JsonExport(403, $validator->errors());
        } else {
            try {
				$instance = self::instance(\App\Http\Controllers\Helper\Back\Employee::class);
            	$data = $instance->postEmployee($request);
                if ($data === true) {
                    return self::JsonExport(200, 'Cập nhật thông tin thành công');
                } else {
                    return self::JsonExport(403, 'Vui lòng kiểm tra lại thông tin 2');
                }
			} catch (\Exception $e) {
				return self::JsonExport(500, 'Vui lòng kiểm tra lại thông tin 3');
			}
        }
	}
	
	public function admin_setting_index(Request $request)
	{
		try {
			return view('theme.backend.page.setting');
		} catch (\Exception $e) {
			return abort(404);
		}
	}
	
	public function admin_email_index(Request $request)
	{
		try {
			return view('theme.backend.page.email');
		} catch (\Exception $e) {
			return abort(404);
		}
	}
	
	public function admin_group_email_index(Request $request)
	{
		try {
			return view('theme.backend.page.group_email');
		} catch (\Exception $e) {
			return abort(404);
		}
	}
	
	public function admin_client_index(Request $request)
	{
		try {
			return view('theme.backend.page.client');
		} catch (\Exception $e) {
			return abort(404);
		}
	}
	
	public function admin_client_ajax(Request $request)
	{
		$instance = self::instance(\App\Http\Controllers\Helper\Back\Client::class);
		if($request->has('id') && !empty($request->id)) {
			return $data = $instance->getClient($request->id);
		}
		return $data = $instance->getDTClient();
	}
	
	public function admin_get_client_school_ajax(Request $request)
	{
		$rules = array(
			'term' => 'max:50',
		);
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
			return self::JsonExport(200, 'Success');
		} else {
			try {
				$instance = self::instance(\App\Http\Controllers\Helper\Back\Client::class);
				$data = $instance->getClientSchool($request->term);
				return self::JsonExport(200, 'Success', $data);
			} catch (\Exception $e) {
				return self::JsonExport(200, 'Success');
			}
		}
	}
	
	public function admin_post_client_ajax(Request $request)
	{
		$rules = array(
			'name' => 'min:1|max:64',
			'address' => 'min:1|max:128',
			'email' => 'min:1|max:64',
			'phone' => 'min:1|max:20',
			'fax' => 'min:1|max:20',
			'website' => 'nullable|url|max:255',
			'job' => 'min:1|max:255',
			'content' => 'min:1|max:5000',
			'investment' => 'digits_between:1,20',
			'staff' => 'digits_between:1,6',
			'school_id' => 'digits_between:1,10',
			'status' => 'in:on,off',
			'image_hash' => 'nullable|base64image',
			'action' => 'required|in:insert,update,delete',
		);
		if($request->action == 'update') {
			$rules['id'] = 'required|digits_between:1,10';
		} else if($request->action == 'delete') {
			$rules = array('id' => 'required|digits_between:1,10');
		}
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
			return self::JsonExport(403, $validator->errors());
		} else {
			try {
				$instance = self::instance(\App\Http\Controllers\Helper\Back\Client::class);
				$data = $instance->postClient($request);
				if ($data === true) {
					switch ($request->action) {
						case 'update':
							return self::JsonExport(200, 'Cập nhật thông tin thành công');
						case 'insert':
							return self::JsonExport(200, 'Thêm thông tin thành công');
						default:
							return self::JsonExport(200, 'Xóa thông tin thành công');
					}
				} else {
					return self::JsonExport(403, 'Vui lòng kiểm tra lại thông tin 2');
				}
			} catch (\Exception $e) {
				return self::JsonExport(500, 'Vui lòng kiểm tra lại thông tin 3');
			}
		}
	}
	
	public function admin_employee_index(Request $request)
	{
		try {
			$role = Role::all();
			return view('theme.backend.page.employee')->with(['role' => $role]);
		} catch (\Exception $e) {
			return redirect()->guest(route('admin.error'));
		}
	}
	
	public function admin_home_error(Request $request)
	{
		return view ('errors.backend.500');
	}

	public function admin_customer_index(Request $request)
	{
		try {
			$genitive = MGenitive::all();
			return view('theme.backend.page.customer')->with(['genitive' => $genitive]);
		} catch (\Exception $e) {
			return redirect()->guest(route('admin.error'));
		}
	}

	public function admin_customer_ajax(Request $request)
	{
		$instance = self::instance(\App\Http\Controllers\Helper\Back\Customer::class);
		if($request->has('id') && !empty($request->id)) {
			return $data = $instance->getCustomer($request->id);
		}
		return $data = $instance->getDTCustomer();
	}

	public function admin_post_customer_ajax(Request $request)
	{
		$rules = array(
			'inputEditEmail' => 'required|min:6|max:50',
			'inputEditName' => 'required|min:6|max:50',
			'sex'=> 'required|in:1,0,2' ,
			'action' => 'required|in:insert,update,delete',
		);
		if (!empty($request->inputEditPassWord)) {
			$rules['inputEditPassWord'] = 'min:6|max:50';
			$rules['inputEditRePassWord'] = 'required|min:6|max:50';
        }
		if($request->action == 'update') {
			$rules['id'] = 'required|digits_between:1,10';
		} else if($request->action == 'delete') {
			$rules = array('id' => 'required|digits_between:1,10');
		} else if($request->action =='insert'){
			$rules['inputEditPassWord'] = 'min:6|max:50';
			$rules['inputEditRePassWord'] = 'required|min:6|max:50';
		}
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
			return self::JsonExport(403, $validator->errors());
        } else {
            try {
				$instance = self::instance(\App\Http\Controllers\Helper\Back\Customer::class);
            	$data = $instance->postCustomer($request);
                if ($data === true) {
                    return self::JsonExport(200, 'Cập nhật thông tin thành công');
                } else {
                    return self::JsonExport(403, 'Vui lòng kiểm tra lại thông tin 2');
                }
			} catch (\Exception $e) {
				return self::JsonExport(500, 'Vui lòng kiểm tra lại thông tin 3');
			}
        }
	}

	public function admin_child_ajax(Request $request)
	{
		$instance = self::instance(\App\Http\Controllers\Helper\Back\Customer::class);
		if($request->has('id') && !empty($request->id)) {
			return $data = $instance->getChild($request->id);
		}
		return $data = $instance->getDTChild($request->parent);
	}

	public function admin_post_child_ajax(Request $request)
	{
		$rules = array(
			'inputChildName' => 'required|min:6|max:50',
			'inputEditChildBirthday' => 'required|date_format:Y-m-d|before:today',
			'sex'=> 'required|in:1,0,2' ,
			'action' => 'required|in:insert,update,delete',
		);
		if($request->action == 'update') {
			$rules['id'] = 'required|digits_between:1,10';
		} else if($request->action == 'delete') {
			$rules = array('id' => 'required|digits_between:1,10');
		}
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
			return self::JsonExport(403, $validator->errors());
        } else {
            try {
				$instance = self::instance(\App\Http\Controllers\Helper\Back\Customer::class);
            	$data = $instance->postChild($request);
                if ($data === true) {
                    return self::JsonExport(200, 'Cập nhật thông tin thành công');
                } else {
                    return self::JsonExport(403, 'Vui lòng kiểm tra lại thông tin 2');
                }
			} catch (\Exception $e) {
				return self::JsonExport(500, 'Vui lòng kiểm tra lại thông tin 3');
			}
        }
	}
	
	public function admin_visiter_index(Request $request)
	{
		try {
			$school = MSchool::with('mSchoolTranslations')->get();
			return view('theme.backend.page.visiter')->with(['school' => $school]);
		} catch (\Exception $e) {
			return redirect()->guest(route('admin.error'));
		}
	}

	public function admin_visiter_ajax(Request $request)
	{
		$instance = self::instance(\App\Http\Controllers\Helper\Back\Visiter::class);
		if($request->has('id') && !empty($request->id)) {
			return $data = $instance->getVisiter($request->id);
		}
		return $data = $instance->getDTVisiter($request->parent);
	}

	public function admin_post_visiter_ajax(Request $request)
	{
		$rules = array(
			'inputEditSchool' => 'required',
			'inputBook' => 'required|date_format:Y-m-d H:i:s',
			'inputEditName' => 'required|min:6|max:50',
			'inputEditPhone' => 'required|digits_between:1,20',
			'inputEditEmail' => 'required|min:1|max:64',
			'inputEditStatus' => 'required|in:1,0,2',
			'inputEditDesire' => 'max:255'
		);
		if($request->action == 'update') {
			$rules['id'] = 'required|digits_between:1,10';
		} else if($request->action == 'delete') {
			$rules = array('id' => 'required|digits_between:1,10');
		}
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
			return self::JsonExport(403, $validator->errors());
        } else {
            try {
				$instance = self::instance(\App\Http\Controllers\Helper\Back\Visiter::class);
            	$data = $instance->postVisiter($request);
                if ($data === true) {
                    return self::JsonExport(200, 'Cập nhật thông tin thành công');
                } else {
                    return self::JsonExport(403, 'Vui lòng kiểm tra lại thông tin 2');
                }
			} catch (\Exception $e) {
				return self::JsonExport(500, 'Vui lòng kiểm tra lại thông tin 3');
			}
        }
	}

	public function admin_send_feed_back(Request $request)
	{
		try {
			$instance = self::instance(\App\Http\Controllers\Helper\Back\Visiter::class);
			$data = $instance->sendFeedback($request);
			if ($data === true) {
				return self::JsonExport(200, 'Gửi phản hồi thành công');
			} else {
				return self::JsonExport(403, 'Vui lòng kiểm tra lại thông tin');
			}
		} catch (\Exception $e) {
			return abort(404);
		}
	}


	public function admin_search_index(Request $request)
	{
		try {
			return view('theme.backend.page.search');
		} catch (\Exception $e) {
			return redirect()->guest(route('admin.error'));
		}
	}
	
	public function admin_place_index(Request $request)
	{
		try {
			return view('theme.backend.page.place');
		} catch (\Exception $e) {
			return redirect()->guest(route('admin.error'));
		}
	}
	
	public function admin_place_ajax(Request $request)
	{
		$instance = self::instance(\App\Http\Controllers\Helper\Back\Place::class);
		if($request->has('id') && !empty($request->id)) {
			switch ($request->table) {
				case 'district':
					return $data = $instance->getDistrict($request->id);
				case 'ward':
					return $data = $instance->getWard($request->id);
				default:
					return $data = $instance->getPlace($request->id, $request->type);
			}
		}
		return $data = $instance->getDTPlace();
	}
	
	public function admin_post_place_ajax(Request $request)
	{
		$rules = array(
			'name' => 'min:1|max:255',
			'action' => 'required|in:insert,update,delete',
		);
		if($request->has('city_id') && !empty($request->city_id)) {
			$rules['city_id'] = 'required|digits_between:1,10';
		}
		if($request->has('district_id') && !empty($request->district_id)) {
			$rules['district_id'] = 'required|digits_between:1,10';
		}
		if($request->action == 'update') {
			$rules['id'] = 'required|digits_between:1,10';
		} else if($request->action == 'delete') {
			$rules = array('id' => 'required|digits_between:1,10');
		}
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
			return self::JsonExport(403, $validator->errors());
		} else {
			try {
				$instance = self::instance(\App\Http\Controllers\Helper\Back\Place::class);
				switch ($request->table) {
					case 'city':
						$data = $instance->postPlace($request);
						break;
					case 'district':
						$data = $instance->postDistrict($request);
						break;
					default:
						$data = $instance->postWard($request);
				}
				if ($data === true) {
					switch ($request->action) {
						case 'update':
							return self::JsonExport(200, 'Cập nhật thông tin thành công');
						case 'insert':
							return self::JsonExport(200, 'Thêm thông tin thành công');
						default:
							return self::JsonExport(200, 'Xóa thông tin thành công');
					}
				} else {
					return self::JsonExport(403, 'Vui lòng kiểm tra lại thông tin 2');
				}
			} catch (\Exception $e) {
				return self::JsonExport(500, 'Vui lòng kiểm tra lại thông tin 3');
			}
		}
	}
	
	public function admin_role_index(Request $request)
	{
		try {
			$permission = Permission::all();
			if($permission){
				return view('theme.backend.page.role')->with(['permission' => $permission]);
			}else {
				return redirect()->guest(route('admin.error'));
			}
		} catch (\Exception $e) {
			return redirect()->guest(route('admin.error'));
		}
	}

	public function admin_role_ajax(Request $request)
	{	
		$instance = self::instance(\App\Http\Controllers\Helper\Back\Permission::class);
		if($request->has('id') && !empty($request->id)) {
			return $data = $instance->getPermission($request->id);
		}
		return $data = $instance->getDTPermission();
	}

	public function admin_post_role_ajax(Request $request)
	{
		$rules = array(
			'inputEditNameDisplay' => 'required|min:1|max:50',
			'edit_description' => 'required|min:1|max:500',
			'edit_permission' => 'required',
		);
		if($request->action == 'update') {
			$rules['id'] = 'required|digits_between:1,10';
		} else if($request->action == 'delete') {
			$rules = array('id' => 'required|digits_between:1,10');
		}
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
			return self::JsonExport(403, $validator->errors());
        } else {
            try {
				$instance = self::instance(\App\Http\Controllers\Helper\Back\Permission::class);
            	$data = $instance->postPermission($request);
                if ($data === true) {
                    return self::JsonExport(200, 'Cập nhật thông tin thành công');
                } else {
                    return self::JsonExport(403, 'Vui lòng kiểm tra lại thông tin 2');
                }
			} catch (\Exception $e) {
				return self::JsonExport(500, 'Vui lòng kiểm tra lại thông tin 3');
			}
        }
	}
	
	public function admin_news_index(Request $request)
	{
		try {
			$layout = MLayout::all();
			return view('theme.backend.page.news')->with(['layout' => $layout]);
		} catch (\Exception $e) {
			return redirect()->guest(route('admin.error'));
		}
	}
	
	public function admin_localization_index(Request $request)
	{
		try {
			return view('theme.backend.page.localization');
		} catch (\Exception $e) {
			return redirect()->guest(route('admin.error'));
		}
	}
	
	public function admin_chart_index(Request $request)
	{
		try {
			return view('theme.backend.page.chart');
		} catch (\Exception $e) {
			return redirect()->guest(route('admin.error'));
		}
	}
	
	public function admin_menu_index(Request $request)
	{
		try {
			$news = MNews::with('mNewsTranslations')->get();
			return view('theme.backend.page.menu')->with(['news' => $news]);
		} catch (\Exception $e) {
			return redirect()->guest(route('admin.error'));
		}
	}
	
	public function admin_attribute_index(Request $request)
	{
		try {
			return view('theme.backend.page.attribute');
		} catch (\Exception $e) {
			return redirect()->guest(route('admin.error'));
		}
	}
	
	public function admin_event_index(Request $request)
	{
		try {
			return view('theme.backend.page.event');
		} catch (\Exception $e) {
			return redirect()->guest(route('admin.error'));
		}
	}
	
	public function admin_language_index(Request $request)
	{
		try {
			return view('theme.backend.page.language');
		} catch (\Exception $e) {
			return redirect()->guest(route('admin.error'));
		}
	}
	
	public function admin_room_index(Request $request)
	{
		try {
			return view('theme.backend.page.room');
		} catch (\Exception $e) {
			return redirect()->guest(route('admin.error'));
		}
	}
	
	public function admin_type_school_index(Request $request)
	{
		try {
			return view('theme.backend.page.type_school');
		} catch (\Exception $e) {
			return redirect()->guest(route('admin.error'));
		}
	}
	
	public function admin_level_school_index(Request $request)
	{
		try {
			return view('theme.backend.page.level_school');
		} catch (\Exception $e) {
			return redirect()->guest(route('admin.error'));
		}
	}
	
	public function admin_level_ajax(Request $request)
	{
		$instance = self::instance(\App\Http\Controllers\Helper\Back\Level::class);
		if($request->has('id') && !empty($request->id)) {
			return $data = $instance->getLevel($request->id, $request->lang);
		}
		return $data = $instance->getDTLevel();
	}
	
	public function admin_post_level_ajax(Request $request)
	{
		$rules = array(
			'name' => 'min:1|max:255',
			'action' => 'required|in:insert,update,delete',
		);
		if($request->action == 'update') {
			$rules['id'] = 'required|digits_between:1,10';
		} else if($request->action == 'delete') {
			$rules = array('id' => 'required|digits_between:1,10');
		}
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
			return self::JsonExport(403, $validator->errors());
		} else {
			try {
				$instance = self::instance(\App\Http\Controllers\Helper\Back\Level::class);
				$data = $instance->postLevel($request);
				if ($data === true) {
					switch ($request->action) {
						case 'update':
							return self::JsonExport(200, 'Cập nhật thông tin thành công');
						case 'insert':
							return self::JsonExport(200, 'Thêm thông tin thành công');
						default:
							return self::JsonExport(200, 'Xóa thông tin thành công');
					}
				} else {
					return self::JsonExport(403, 'Vui lòng kiểm tra lại thông tin 2');
				}
			} catch (\Exception $e) {
				return self::JsonExport(500, 'Vui lòng kiểm tra lại thông tin 3');
			}
		}
	}
	
	public function admin_school_index(Request $request)
	{
		try {
			return view('theme.backend.page.school');
		} catch (\Exception $e) {
			return redirect()->guest(route('admin.error'));
		}
	}

	public function admin_school_ajax(Request $request)
	{
		$instance = self::instance(\App\Http\Controllers\Helper\Back\School::class);
		if($request->has('action') && $request->action != 'view') {
			$result =  $instance->postSchool($request);
			if($result) {
				return self::JsonExport(200, 'Cập nhật trạng thái thành công');
			} else {
				return self::JsonExport(500, 'Cập nhật trạng thái thất bại');
			}
		}
		if($request->has('action') && $request->action == 'view') {
			return $instance->getSchool($request->id, $request->lang);
		}
		return $data = $instance->getDTSchool();
	}


	public function admin_school_comment_ajax(Request $request)
	{
		$instance = self::instance(\App\Http\Controllers\Helper\Back\School::class);
		if($request->has('action')) {
			$result =  $instance->postSchoolComment($request);
			if($result) {
				return self::JsonExport(200, 'Cập nhật trạng thái thành công');
			} else {
				return self::JsonExport(500, 'Cập nhật trạng thái thất bại');
			}
		}
		if($request->has('comment_id')) {
			$data = $instance->getSchoolComment($request->comment_id);
			if($data !== null) {
				return self::JsonExport(200, 'Thành công',$data);
			} else {
				return self::JsonExport(500, 'Không tìm thấy kết quả', $data);
			}
		}
		return $data = $instance->getDTSchoolComment($request->id);
	}

	public function admin_school_course_ajax(Request $request)
	{
		$instance = self::instance(\App\Http\Controllers\Helper\Back\School::class);
		if($request->has('action') && $request->action != 'view') {
			$result =  $instance->postSchoolCourse($request);
			if($result) {
				return self::JsonExport(200, 'Cập nhật trạng thái thành công');
			} else {
				return self::JsonExport(500, 'Cập nhật trạng thái thất bại');
			}
		}
		if($request->has('action') && $request->action == 'view') {
			return $instance->getSchoolCourse($request->id, $request->lang);
		}
		return $data = $instance->getDTSchoolCourse($request->id);
	}

	public function admin_school_program_ajax(Request $request)
	{
		$instance = self::instance(\App\Http\Controllers\Helper\Back\School::class);
		if($request->has('action') && $request->action != 'view') {
			$result =  $instance->postSchoolProgram($request);
			if($result) {
				return self::JsonExport(200, 'Cập nhật trạng thái thành công');
			} else {
				return self::JsonExport(500, 'Cập nhật trạng thái thất bại');
			}
		}
		if($request->has('action') && $request->action == 'view') {
			return $instance->getSchoolProgram($request->id, $request->lang);
		}
		return $data = $instance->getDTSchoolProgram($request->id);
	}
}