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
use Validator;
use Hash;
use Socialite;
use Auth;
use Carbon\Carbon;
use App\Models\MSchoolType;
use App\Models\MSchoolTypeTranslation;

class Type extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $lang;
    protected $lang_id;

    public function __construct()
    {
        $this->lang = LaravelLocalization::getCurrentLocale();
        $this->lang_id = LaravelLocalization::getCurrentLocaleID();
    }

    //DEMO
    public function postType($request)
    {
        self::__construct();
        try {
            DB::beginTransaction();
            if($request->action == 'update' || $request->action == 'delete') {
                $query = MSchoolType::find($request->id);
                if(!$query) {
                    DB::rollback();
                    return false;
                }
            }
            $data = [];
            $data_relationship = [];
            if($request->has('name') && !empty($request->name)) {
							$data_relationship['name'] = $request->name;
            }
            
            if($request->action == 'update') {
								if (count($data_relationship) > 0) {
									$query->mSchoolTypeTranslationsAll()->where('language_id', $request->lang)->update($data_relationship);
									if (!$query) {
										DB::rollback();
										return false;
									}
								}
            } else if($request->action == 'delete') {
                $ref = MSchoolTypeTranslation::where('translation_id', $request->id);
                $ref = $ref->delete();
                if(!$ref) {
                    DB::rollback();
                    return false;
                }
                $query->delete();
                if(!$query) {
                    DB::rollback();
                    return false;
                }
            } else {
                $query = MSchoolType::create($data);
                if(!$query) {
                    DB::rollback();
                    return false;
                }
                
                $data_relationship['translation_id'] = $query->id;
								$trans = self::renderTrans($query->mSchoolTypeTranslations(), $data_relationship);
                if(!$trans) {
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

    public function getType($id, $language = 1)
    {
        self::__construct();
        try {
            $data = MSchoolType::with('mSchoolTypeTranslationsAll')
                    ->where('id', $id)
                    ->whereHas('mSchoolTypeTranslationsAll', function ($query) use ($language) {
                        $query->where('language_id', $language);
                    })->first();
            if (!empty($data)) {
                return self::JsonExport(200, 'success', $data);
            } else {
                return self::JsonExport(404, 'error', null);
            }
        } catch (\Exception $e) {
            return self::JsonExport(500, 'error', null);
        }
    }

    public function getDTType()
    {
        self::__construct();
        try {
                $data = MSchoolType::with('mSchoolTypeTranslations');
                return Datatables::of($data)
								->editColumn('name', function ($v) {
									if(!empty($v->mSchoolTypeTranslations[0]->name)) {
										return $v->mSchoolTypeTranslations[0]->name;
									} else {
										return '';
									}
								})
                ->addColumn('action', function ($v) {
                    return '<a class="table-action table-action-edit text-green cursor-pointer" data-lang="'.$this->lang_id.'" data-id="'.$v->id.'"><i class="fa fa-edit"></i></a><a class="table-action text-red table-action-delete cursor-pointer" data-lang="'.$this->lang_id.'" data-id="'.$v->id.'"><i class="fa fa-trash"></i></a>';
                })
								->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        } catch (\Exception $e) {
            return null;
        }
    }
    //DEMO
}
