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
use App\Models\MBooking;
use App\Models\ConfigEmail;
use App\Models\MBookingReply;


class Visiter extends Controller
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $lang;
    protected $lang_id;

    public function __construct()
    {
        $this->lang = LaravelLocalization::getCurrentLocale();
        $this->lang_id = LaravelLocalization::getCurrentLocaleID();
    }

    public function getDTVisiter()
    {
        self::__construct();
        try {
                $data = MBooking::with('mCustomer','mSchool.mSchoolTranslations')->get();
                return Datatables::of($data)
                ->editColumn('datebook', function ($v){
                    return Carbon::parse($v->created_at)->format('Y-m-d');
                })
                ->editColumn('school', function ($v){
                    return $v->mSchool->mSchoolTranslations[0]->name;
                })
                ->editColumn('customer', function ($v){
                    return $v->name;
                })
                ->editColumn('phone', function ($v){
                    return $v->phone;
                })
                ->editColumn('datevisit', function ($v){
                    return $v->booking_date;
                })
                ->editColumn('email', function ($v){
                    return $v->email;
                })
                ->editColumn('status', function ($v){
                    if($v->status == 1 ) {
                        return 'Mới';
                    } else if($v->status == 2){
                        return 'Đang xử lý';
                    } else {
                        return 'Đã xử lý';
                    }
                })
                ->editColumn('action', function ($v){
                    $visited = '';
                    if($v->login_customer == 1) {
						$visited = '<a class="table-action table-action-visiter-info text-blue cursor-pointer" data-id="' .$v->id . '"><i'.
						' class="fa fa-info-circle"></i></a>';
					}
                    return '<a class="table-action table-action-reply text-blue cursor-pointer" data-id="' .$v->id .'"><i' .
                            ' class="fa fa-reply"></i></a>' .
                            '<a class="table-action table-action-view text-blue cursor-pointer" data-id="' .$v->id . '"><i' .
                            ' class="fa fa-sticky-note"></i></a>' .
                            '<a class="table-action table-action-edit text-green cursor-pointer" data-id="' .$v->id . '"><i' .
                            ' class="fa fa-edit"></i></a>' .
                            ' <a class="table-action text-red table-action-delete cursor-pointer" data-id="' .$v->id . '"><i' .
                            ' class="fa fa-trash"></i></a>' . $visited;
                })
                ->rawColumns(['id','customer','phone','email','school','datebook','status','action','datevisit'])
                ->make(true);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getVisiter($id)
    {
        self::__construct();
        try {
            $data = MBooking::where('id', $id)
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

    public function postVisiter($request)
    {
        self::__construct();
        try {
            DB::beginTransaction();
            if($request->action == 'update' || $request->action == 'delete') {
                $query = MBooking::find($request->id);
                if(!$query) {
                    DB::rollback();
                    return false;
                }
            }

            if($request->has('inputEditSchool') && !empty($request->inputEditSchool)) {
                $data['school_id'] = $request->inputEditSchool;
            }

            if($request->has('inputBook') && !empty($request->inputBook)) {
                $data['booking_date'] = Carbon::parse($request->inputBook)->format('Y-m-d H:i:s');
            }

            if($request->has('inputEditName') && !empty($request->inputEditName)) {
                $data['name'] = $request->inputEditName;
            }

            if($request->has('inputEditPhone') && !empty($request->inputEditPhone)) {
                $data['phone'] = $request->inputEditPhone;
            }

            if($request->has('inputEditEmail') && !empty($request->inputEditEmail)) {
                $data['email'] = $request->inputEditEmail;
            }

            if($request->has('inputEditStatus') && !empty($request->inputEditStatus)) {
                $data['status'] = $request->inputEditStatus;
            }

            if($request->has('inputEditDesire') && !empty($request->inputEditDesire)) {
                $data['content'] = $request->inputEditDesire;
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
                $query = MBooking::create($data);
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

    public function sendFeedback($request){
        self::__construct();
        try {
            DB::beginTransaction();
            $check = MBooking::where('id', $request->id)->first();
            if ($check) {
                $data =[];
                $smtp = ConfigEmail::where('default',1)->first();
                $data=[
                    'booking_id' => $request->id,
                    'user_id' => Auth::user()->id,
                    'smtp_id' => $smtp->id,
                    'content' => $request->inputReplyContent,
                    'status' => 2
                ];
                if(!empty($data)){
                    $query = MBookingReply::create($data);
                    if($query){
                        dispatch(new \App\Jobs\EmailSendFeedback($check->email, $request->inputReplyContent));
                        DB::commit();
                        return true;
                    }else{
                        DB::rollback();
                        return false;
                    }
                } else {
                    DB::rollback();
                    return false;
                }
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