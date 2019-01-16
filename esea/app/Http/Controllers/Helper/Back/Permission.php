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
use App\Models\Role;
use App\Models\Config;
use App\Models\PermissionRole;


class Permission extends Controller
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $lang;
    protected $lang_id;

    public function __construct()
    {
        $this->lang = LaravelLocalization::getCurrentLocale();
        $this->lang_id = LaravelLocalization::getCurrentLocaleID();
    }

    public function getDTPermission()
    {
        self::__construct();
        try {
                $data = Role::with('permissions');
                return Datatables::of($data)
                ->editColumn('action', function ($v){
                    return '<a' .
                    ' class="table-action table-action-edit text-green cursor-pointer" data-id="' . $v->id . '"><i' .
                    ' class="fa fa-edit"></i></a>' .
                    ' <a class="table-action text-red table-action-delete cursor-pointer" data-id="' . $v->id . '"><i' .
                    ' class="fa fa-trash"></i></a>';
                })
                ->rawColumns(['id','name','display_name','description','action'])
                ->make(true);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getPermission($id)
    {
        self::__construct();
        try {
            $data =  Role::with('permissions')->where('id', $id)->first();
            if (!empty($data)) {
                return self::JsonExport(200, 'success', $data);
            } else {
                return self::JsonExport(404, 'error', null);
            }
        } catch (\Exception $e) {
            return self::JsonExport(500, 'error', null);
        }
    }

    public function postPermission($request)
    {
        self::__construct();
        try {
            DB::beginTransaction();
            if($request->action == 'update' || $request->action == 'delete') {
                $query = Role::find($request->id);
                if(!$query) {
                    DB::rollback();
                    return false;
                }
            }
            $permission = [];
            if($request->has('edit_permission') && !empty($request->edit_permission)) {
                $permission = $request->edit_permission;
            }

            if($request->has('inputEditNameDisplay') && !empty($request->inputEditNameDisplay)) {
                $data['display_name'] = $request->inputEditNameDisplay;
            }

            if($request->has('edit_description') && !empty($request->edit_description)) {
                $data['description'] = $request->edit_description;
            }

            if($request->action == 'update') {
                if(count($data) > 0) {
                    $query->update($data);
                    PermissionRole::where('role_id', $query->id)->delete();
                    foreach ($permission as $key => $value) {
                        $query->attachPermission($value);
                    }
                    if(!$query) {
                        DB::rollback();
                        return false;
                    }
                }
            } else if($request->action == 'delete') {
                if($query->name == 'admin'){
                    DB::rollback();
                    return false;
                }
                PermissionRole::where('role_id', $query->id)->delete();
                $query->delete();
                if(!$query) {
                    DB::rollback();
                    return false;
                } 
            } else if($request->action == 'insert') {
                $query = Role::create($data);
                if($query) {
                    foreach ($permission as $key => $value) {
                        $query->attachPermission($value);
                    }
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