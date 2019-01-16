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
use App\Models\MEmail;
use App\Models\MActivityLog;
use App\Models\MCustomer;
use App\Models\ConfigEmail;
use Activity;
use App\Models\MMenu;

class Email extends Controller
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $lang;
    protected $lang_id;

    public function __construct()
    {
        $this->lang = LaravelLocalization::getCurrentLocale();
        $this->lang_id = LaravelLocalization::getCurrentLocaleID();
    }

    public function getDTEmail()
    {
        self::__construct();
        try {
            $data = ConfigEmail::all();
            return Datatables::of($data)
            ->editColumn('action', function ($v){
                return '<a' .
							' class="table-action table-action-edit text-green cursor-pointer" data-id="' . $v->id . '"><i' .
							' class="fa fa-edit"></i></a>' .
							' <a class="table-action text-red table-action-delete cursor-pointer" data-id="' . $v->id . '"><i' .
							' class="fa fa-trash"></i></a>';
            })
            ->editColumn('default', function ($v){
                if($v->default == 1){
                    return '<i class="fas fa-check-circle text-green"></i>';
                } else {
                    return '';
                }
            })
            
            ->rawColumns(['id','smtp_server','smtp_port','smtp_username','smtp_protocol','smtp_name','default','action'])
            ->make(true);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getEmail($id)
    {
        self::__construct();
        try {
            $data = ConfigEmail::where('id',$id)->get();
            if (!empty($data)) {
                return self::JsonExport(200, 'success', $data);
            } else {
                return self::JsonExport(404, 'error', null);
            }
        } catch (\Exception $e) {
            return self::JsonExport(500, 'error', null);
        }
    }

    public function postEmail($request)
    {
        self::__construct();
        try {
            DB::beginTransaction();
            if($request->action == 'update' || $request->action == 'delete') {
                $query = ConfigEmail::find($request->id);
                if(!$query) {
                    DB::rollback();
                    return false;
                }
            }
            if($request->has('inputEditSMTP') && !empty($request->inputEditSMTP)) {
                $data['smtp_server'] = $request->inputEditSMTP;
            }

            if($request->has('inputEditPassWord') && !empty($request->inputEditPassWord)) {
                $data['smtp_username'] = Hash::make($request->inputEditPassWord);
            }

            if($request->has('inputEditPort') && !empty($request->inputEditPort)) {
                $data['smtp_port'] = $request->inputEditPort;
            }

            if($request->has('inputEditUserName') && !empty($request->inputEditUserName)) {
                $data['smtp_username'] = $request->inputEditUserName;
            }

            if($request->has('inputEditProtocal') && !empty($request->inputEditProtocal)) {
                $data['smtp_protocol'] = $request->inputEditProtocal;
            }

            if($request->has('inputEditSender') && !empty($request->inputEditSender)) {
                $data['smtp_name'] = $request->inputEditSender;
            }

            if($request->default == "on" || $request->default === true) {
                $data['default'] = 1;
            } else {
                $data['default'] = 0;
            }

            if($request->action == 'update') {
                if(count($data) > 0) {
                    if($query->default != $data['default']){
                        if($data['default'] == 1) {
                            $emailConfig = ConfigEmail::where('default', 1)->update(['default' => 0]);
                        } else {
                            DB::rollback();
                            return false;
                        }
                    }

                    if(!$emailConfig) {
                        DB::rollback();
                        return false;
                    }

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
                $query = ConfigEmail::create($data);
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

    public function getDTEmailStatus()
    {
        self::__construct();
        try {
            $data = MEmail::with('mGroupEmail');
            return Datatables::of($data)
            ->editColumn('action', function ($v){
                return ' <a class="table-action text-red table-action-delete cursor-pointer" data-id="' . $v->id . '"><i' .
                ' class="fa fa-trash"></i></a>';
            })
            ->editColumn('group', function ($v){
                return $v->mGroupEmail->name;
            })
            ->editColumn('status', function ($v){
                if($v->status == 1){
                    return '<i class="fas fa-check-circle text-green"></i>';
                } else {
                    return '';
                }
            })
            ->rawColumns(['id','title','content','group','created_at','status','action'])
            ->make(true);
        } catch (\Exception $e) {
            return null;
        }
    }

    

}