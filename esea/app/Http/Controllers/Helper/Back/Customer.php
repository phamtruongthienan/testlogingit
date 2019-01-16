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
use GuzzleHttp\Client;
use Validator;
use Hash;
use Socialite;
use Auth;
use Carbon\Carbon;
use App\Models\MAdvert;
use App\Models\MUser;
use App\Models\MAdvertsTranslation;
use App\Models\MActivityLog;
use App\Models\MCustomer;
use App\Models\MChild;
use Activity;


class Customer extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $lang;
    protected $lang_id;

    public function __construct()
    {
        $this->lang = LaravelLocalization::getCurrentLocale();
        $this->lang_id = LaravelLocalization::getCurrentLocaleID();
    }

    public function getDTCustomer()
    {
        self::__construct();
        try {
                $data = MCustomer::get();
                return Datatables::of($data)
                ->editColumn('status', function ($v){
                    if($v->status == 1){
                        return '<i class="fas fa-check-circle text-green"></i>';
                    } else {
                        return ;
                    }
                })
                ->editColumn('type', function ($v){
                    if($v->type == 1){
                        return '<i class="table-action fab fa-google-plus text-red"></i>';
                    } else if($v->type == 2){
                        return '<i class="table-action fab fa-facebook-square text-blue"></i>';
                    } else {
                        return '';
                    }
                })
                ->rawColumns(['id','name','phone','email','type','status'])
                ->make(true);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getCustomer($id)
    {
        self::__construct();
        try {
            $data = MCustomer::with('mChildren.mSchool.mSchoolTranslations')->where('id', $id)->first();
            if (!empty($data)) {
                return self::JsonExport(200, 'success', $data);
            } else {
                return self::JsonExport(404, 'error', null);
            }
        } catch (\Exception $e) {
            return self::JsonExport(500, 'error', null);
        }
    }

    public function postCustomer($request)
    {
        self::__construct();
        try {
            DB::beginTransaction();
            if($request->action == 'update' || $request->action == 'delete') {
                $query = MCustomer::find($request->id);
                if(!$query) {
                    DB::rollback();
                    return false;
                }
            }
            $data = [];
            $data_relationship = [];
            $img_translation = [];
            if($request->has('inputEditPassWord') && !empty($request->inputEditPassWord)) {
                $data['password'] = Hash::make($request->inputEditPassWord);
            }

            if($request->has('inputEditEmail') && !empty($request->inputEditEmail)) {
                $data['email'] = $request->inputEditEmail;
            }

            if($request->has('inputEditName') && !empty($request->inputEditName)) {
                $data['name'] = $request->inputEditName;
            }

            if($request->has('inputEditPhone') && !empty($request->inputEditPhone)) {
                $data['phone'] = $request->inputEditPhone;
            }

            if($request->has('sex') && is_numeric($request->sex)) {
                $data['gender'] = $request->sex;
            }
            if($request->status == 'on') {
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }
            if($request->action == 'update') {
                if(count($data) > 0) {
                    $query->update($data);
                    if(!$query) {
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
            } else if($request->action == 'insert') {
                $data['type'] = 3;
                $query = MCustomer::create($data);
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

    public function getDTChild($parent)
    {
        self::__construct();
        try {
                $data = MChild::where('customer_id',$parent)->get();
                return Datatables::of($data)
                ->editColumn('gender', function ($v){
                    if($v->gender == 1){
                        return 'Nam';
                    } else if($v->gender == 0) {
                        return "Nữ";
                    } else {
                        return "Giới tính khác";
                    }
                })
                ->editColumn('school', function ($v){
                    return $v->mSchool->mSchoolTranslations[0]->name;
                })
                ->editColumn('action', function ($v){
                    return '<a' .
                    ' class="table-action table-action-edit-child text-green cursor-pointer" data-id="' . $v->id .'"><i' .
                    ' class="fa fa-edit"></i></a>' .
                    ' <a class="table-action text-red table-action-delete-child cursor-pointer" data-id="' .$v->id . '"><i' .
                    ' class="fa fa-trash"></i></a>';
                })
                ->rawColumns(['id','name','dob','genitive','gender','school', 'action'])
                ->make(true);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getChild($id)
    {
        self::__construct();
        try {
            $data =  MChild::where('id', $id)->first();
            if (!empty($data)) {
                return self::JsonExport(200, 'success', $data);
            } else {
                return self::JsonExport(404, 'error', null);
            }
        } catch (\Exception $e) {
            return self::JsonExport(500, 'error', null);
        }
    }

    public function postChild($request)
    {
        self::__construct();
        try {
            DB::beginTransaction();
            if($request->action == 'update' || $request->action == 'delete') {
                $query = Mchild::find($request->id);
                if(!$query) {
                    DB::rollback();
                    return false;
                }
            }
            if($request->has('inputChildName') && !empty($request->inputChildName)) {
                $data['name'] = $request->inputChildName;
            }

            if($request->has('inputEditChildBirthday') && !empty($request->inputEditChildBirthday)) {
                $data['dob'] = Carbon::parse($request->inputEditChildBirthday)->format('Y-m-d');
            }

            if($request->has('sex') && is_numeric($request->sex)) {
                $data['gender'] = $request->sex;
            }

            if($request->has('inputAddChildGentive') && !empty($request->inputAddChildGentive)) {
                $data['genitive'] = implode(",",$request->inputAddChildGentive);
            }

            if($request->action == 'update') {
                if(count($data) > 0) {
                    $query->update($data);
                    if(!$query) {
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