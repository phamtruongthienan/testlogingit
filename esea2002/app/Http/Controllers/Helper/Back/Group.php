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
use App\Models\MGroupEmail;
use App\Models\MGroupEmailUser;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\GroupMailImport;
use Activity;


class Group extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $lang;
    protected $lang_id;

    public function __construct()
    {
        $this->lang = LaravelLocalization::getCurrentLocale();
        $this->lang_id = LaravelLocalization::getCurrentLocaleID();
    }

    public function getGroup($id)
    {
        self::__construct();
        try {
            $group =MGroupEmail::with('mGroupEmailUsers')
                    ->where('id', $id)
                    ->first();
            if (!empty($group)) {
                return self::JsonExport(200, 'success', $group);
            } else {
                return self::JsonExport(404, 'error', null);
            }
        } catch (\Exception $e) {
            return self::JsonExport(500, 'error', null);
        }
    }

    public function getDTGroup()
    {
        self::__construct();
        try {
            $data = MGroupEmail::with('mGroupEmailUsers')->get();
            return Datatables::of($data)
            ->editColumn('id', function ($v){
                return $v->id;
            })
            ->editColumn('name', function ($v){
                return $v->name;
            })
            ->editColumn('num', function ($v){
                return count($v->mGroupEmailUsers);
            })
            ->editColumn('action', function ($v){
                return '<a'.
                ' class="table-action table-action-edit text-green cursor-pointer" data-id="' . $v->id . '"><i' .
                ' class="fa fa-edit"></i></a>' .
                ' <a class="table-action text-red table-action-delete cursor-pointer" data-id="' . $v->id . '"><i' .
                ' class="fa fa-trash"></i></a>' .
                ' <a class="table-action text-blue table-action-export cursor-pointer" data-id="' . $v->id . '"><i' .
                ' class="fa fa-download"></i></a>';
            })
            ->rawColumns(['id','name','num','action'])
            ->make(true);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function postGroup($request)
    {
        self::__construct();
        try {
            DB::beginTransaction();
            $email =[];
            $groupMail =[];
            if($request->action == 'update' || $request->action == 'delete') {
                $query = MGroupEmail::find($request->id);
                if(!$query) {
                    DB::rollback();
                    return false;
                }
            }
            if($request->has('inputAddName') && !empty($request->inputAddName)) {
                $data['name'] = $request->inputAddName;
            }

            if($request->has('inputEditPosition') && !empty($request->inputEditPosition)) {
                $data['group'] = $request->inputEditPosition;
            }

            if($request->has('add_email') && !empty($request->add_email)) {
                $email = $request->add_email;
            }

            if($request->action == 'update') {
                if(count($data) > 0) {
                    $count = MGroupEmail::where('name',$data['name'])->where('id','!=',$query->id)->count();
                
                    if($count >0){
                        DB::rollback();
                        return false;
                    }

                    $query->update($data);

                    if(!$query) {
                        DB::rollback();
                        return false;
                    }

                    $groupMailDel = MGroupEmailUser::where('group_id',$request->id)->delete();

                    if(!$groupMailDel) {
                        DB::rollback();
                        return false;
                    }

                    for($i=0; $i < count($email); $i++){
                        $groupMail[$i]['group_id'] = $query->id;
                        $groupMail[$i]['email'] = $email[$i];
                    }
                    
                    $groupMailAdd = MGroupEmailUser::insert($groupMail);

                    if(!$groupMailAdd) {
                        DB::rollback();
                        return false;
                    }
                }
            } else if($request->action == 'delete') {
                $ids = MGroupEmailUser::where('group_id',$request->id)->pluck('id');
                if(!empty($ids) && count($ids) > 0){
                    $groupMailDel = MGroupEmailUser::whereIn('id', $ids)->delete();
                    if(!$groupMailDel) {
                        DB::rollback();
                        return false;
                    } 
                }
                $query->delete();
                if(!$query) {
                    DB::rollback();
                    return false;
                } 
            } else if($request->action == 'insert') {
                $count = MGroupEmail::where('name',$data['name'])->count();

                if($count >0){
                    DB::rollback();
                    return false;
                }
                $query = MGroupEmail::create($data);

                if(!$query) {
                    DB::rollback();
                    return false;
                } 
                for($i=0; $i < count($email); $i++){
                    $groupMail[$i]['group_id'] = $query->id;
                    $groupMail[$i]['email'] = $email[$i];
                }
                if($request->has('attachment') && !empty($request->attachment)) {
                    $groupMailAdd = Excel::import(new GroupMailImport($query->id), $request->attachment);
                    if(!$groupMailAdd) {
                        DB::rollback();
                        return false;
                    }
                } else{
                    $groupMailAdd = MGroupEmailUser::insert($groupMail);
                    if(!$groupMailAdd) {
                        DB::rollback();
                        return false;
                    }
                }
            }
            if ($query) {
                if($request->action == 'insert' || $request->action == 'update'){
                    if($groupMailAdd){
                        DB::commit();
                        return true;
                    } else {
                        DB::rollback();
                        return false;
                    }
                } else {
                    DB::commit();
                    return true;
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
