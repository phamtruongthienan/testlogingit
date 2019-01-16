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


class Employee extends Controller
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $lang;
    protected $lang_id;

    public function __construct()
    {
        $this->lang = LaravelLocalization::getCurrentLocale();
        $this->lang_id = LaravelLocalization::getCurrentLocaleID();
    }

    public function getEmployee($id)
    {
        self::__construct();
        try {
            $user = MUser::with('role_users.role')
                    ->where('id', $id)
                    ->first();
            if (!empty($user)) {
                $activity = MActivityLog::where('causer_id',$user->id)->get();
                if(empty($activity)){
                    $activity = [];
                }
                $data = ['user' => $user, 'activity' => $activity];
                    return self::JsonExport(200, 'success', $data);
            } else {
                return self::JsonExport(404, 'error', null);
            }
        } catch (\Exception $e) {
            return self::JsonExport(500, 'error', null);
        }
    }

    public function getDTEmployee()
    {
        self::__construct();
        try {
                $data = MUser::with('role_users.role')->where('id','!=',Auth::user()->id);
                return Datatables::of($data)
                ->editColumn('role', function ($v){
                    $position = [];
                    foreach ($v->role_users as $key => $val) {
                        array_push($position,$val->role->display_name);
                    }
                    return $position;
                })
                ->editColumn('locked', function ($v){
                    switch($v->locked) {
                        case 0:
                        return '<i class="fas fa-check-circle text-green"></i>';
                        break;
                        case 1:
                        return;
                        break;
                    }
                })
                ->rawColumns(['id','email','name','dob','phone','locked'])
                ->make(true);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function postEmployee($request)
    {
        self::__construct();
        try {
            DB::beginTransaction();
            if($request->action == 'update' || $request->action == 'delete') {
                $query = MUser::with('role_users.role')->find($request->id);
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

            if($request->has('inputEditUserName') && !empty($request->inputEditUserName)) {
                $data['email'] = $request->inputEditUserName;
            }

            if($request->has('inputEditName') && !empty($request->inputEditName)) {
                $data['name'] = $request->inputEditName;
            }

            if($request->has('inputEditBirthday') && !empty($request->inputEditBirthday)) {
                $data['dob'] = Carbon::parse($request->inputEditBirthday)->format('Y-m-d');
            }

            if($request->has('inputEditPhone') && !empty($request->inputEditPhone)) {
                $data['phone'] = $request->inputEditPhone;
            }
            if($request->status == 'on') {
                $data['locked'] = 1;
            } else {
                $data['locked'] = 0;
            }
            if($request->action == 'update') {
                if(!empty($request->inputEditPosition)){
                    $query->roles()->sync($request->inputEditPosition);
                }
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
                $query = MUser::create($data);
                if(!$query) {
                    DB::rollback();
                    return false;
                } else {
                    $query->attachRole($request->inputEditPosition);
                    if(!$query){
                        DB::rollback();
                        return false;
                    } 
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