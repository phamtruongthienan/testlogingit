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
use App\Models\MSchool;
use App\Models\MSchoolsTranslation;
use App\Models\MSchoolComment;
use App\Models\MSchoolCourse;
use App\Models\MSchoolCourseTranslation;
use App\Models\MSchoolClass;
use App\Models\MSchoolCommentReply;
use App\Models\MSchoolProgram;
use App\Models\MSchoolProgramTranslation;
use App\Models\ConfigLanguage;
use App\Models\MAdvert;

class School extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $lang;
    protected $lang_id;

    public function __construct()
    {
        $this->lang = LaravelLocalization::getCurrentLocale();
        $this->lang_id = LaravelLocalization::getCurrentLocaleID();
    }

    //SCHOOL
    public function postSchool($request)
    {
        return true;
    }

    public function getSchool($id)
    {
        self::__construct();
        try {
            $data = MAdvert::with('mAdvertsTranslations')
                    ->where('id', $id)
                    ->whereHas('mAdvertsTranslations', function ($query) {
                        $query->where('language_id', $this->lang_id);
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

    public function getDTSchool()
    {
        self::__construct();
        try {
                $data = MSchool::with('mSchoolTranslations','configCity','mSchoolLevel.mSchoolLevelTranslations','mSchoolType.mSchoolTypeTranslations');
                return Datatables::of($data)
                ->editColumn('name', function ($v) {
                   return $v->mSchoolTranslations[0]->name;
                })
                ->editColumn('level', function ($v) {
                    return $v->mSchoolLevel->mSchoolLevelTranslations[0]->name;
                })
                ->editColumn('type', function ($v) {
                    return $v->mSchoolType->mSchoolTypeTranslations[0]->name;
                })
                ->editColumn('district', function ($v) {
                    return $v->configCity->name;
                })
                ->addColumn('action', function ($v) {
                    return '<a class="table-action table-action-view-comment text-blue cursor-pointer" data-lang="'.$this->lang_id.'" data-id="'.$v->id.'"><i class="fa fa-comments"></i></a><a class="table-action table-action-view-course text-aqua cursor-pointer" data-lang="'.$this->lang_id.'" data-id="'.$v->id.'"><i class="fa fa-plus-circle"></i></a><a class="table-action table-action-edit text-green cursor-pointer" data-lang="'.$this->lang_id.'" data-id="'.$v->id.'"><i class="fa fa-edit"></i></a><a class="table-action text-red table-action-delete cursor-pointer" data-lang="'.$this->lang_id.'" data-id="'.$v->id.'"><i class="fa fa-trash"></i></a>';
                })
                ->rawColumns(['name','level','type','district', 'action'])
                ->make(true);
        } catch (\Exception $e) {
            return null;
        }
    }
    //SCHOOL

    //COMMENT
    public function getDTSchoolComment($id)
    {
        self::__construct();
        try {
                $data = MSchoolComment::with('mCustomer','mSchoolCommentReplies')->where('school_id', $id);
                return Datatables::of($data)
                ->editColumn('name', function ($v) {
                    return $v->mCustomer->name;
                 })
                ->editColumn('address', function ($v) {
                   return $v->mCustomer->address;
                })
                ->editColumn('created_at', function ($v) {
                    return Carbon::parse($v->created_at)->format('Y-m-d');
                })
                ->editColumn('content', function ($v) {
                    $content = '<div class="article">';
                    $content .= $v->content;
                    if(count($v->mSchoolCommentReplies) > 0) {
                        $content .= '<div class="callout callout-info"><h4>Phản hồi</h4><p>'.$v->mSchoolCommentReplies[0]->content.'</p></div>';
                    }
                    $content .= '</div>';
                    return $content;
                })
                ->editColumn('rating', function ($v) {
                    if($v->rating > 0) {
                        $vote = '';
                        for($i=1;$i<=$v->rating;$i++){
                            $vote .= '<i class="fa fa-star text-yellow"></i>';
                        }
                        return $vote;
                    } else {
                        return '';
                    }
                })
                ->editColumn('reply', function ($v) {
                    if(count($v->mSchoolCommentReplies) > 0) {
                        return '<i class="fas fa-check-circle"></i>';
                    } else {
                        return '';
                    }
                })
                ->addColumn('action', function ($v) {
                    $agree = "";
                    if($v->status == 0) {
                        $agree .= '<a data-toggle="tooltip" title="Hiển thị" class="table-action table-action-agree text-blue cursor-pointer" data-id="'.$v->id.'"><i class="far fa-square"></i></a>';
                    } else {
                        $agree .= '<a data-toggle="tooltip" title="Ẩn" class="table-action table-action-agree text-blue cursor-pointer" data-id="'.$v->id.'"><i class="far fa-check-square"></i></a>';
                    }
                    if(count($v->mSchoolCommentReplies) > 0) {
                        $agree .= '<a data-toggle="tooltip" title="Chỉnh sửa phản hồi" class="table-action text-blue table-action-reply cursor-pointer" data-id="'.$v->id.'"><i class="fas fa-edit"></i></a>';
                    } else {
                        $agree .= '<a data-toggle="tooltip" title="Phản hồi" class="table-action text-blue table-action-reply cursor-pointer" data-id="'.$v->id.'"><i class="fa fa-comments"></i></a>';    
                    }
                    $agree .= '<a data-toggle="tooltip" title="Xóa" class="table-action text-red table-action-delete cursor-pointer" data-id="'.$v->id.'"><i class="fa fa-trash"></i></a>';
					return $agree;
                })
                ->rawColumns(['name','address','created_at','content', 'rating', 'reply','action'])
                ->make(true);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getSchoolComment($id)
    {
        self::__construct();
        try {
            $data = MSchoolComment::with('mCustomer','mSchoolCommentReplies')->where('id', $id)->first();
            if(!$data) {
                return null;
            } else {
                return $data;
            }
        } catch (\Exception $e) {
            return null;
        }
    }
    
    public function postSchoolComment($request)
    {
        self::__construct();
        try {
            DB::beginTransaction();
            $query = MSchoolComment::find($request->id);
            if(!$query) {
                DB::rollback();
                return false;
            }
            if($request->action == 'status') {
                if($query->status == 1) {
                    $query->status = 0;
                } else {
                    $query->status = 1;
                }
                $query->save();
                if(!$query) {
                    DB::rollback();
                    return false;
                }
            }

            if($request->action == 'delete') {
                $query->delete();
                if(!$query) {
                    DB::rollback();
                    return false;
                }
            }

            if($request->action == 'reply') {
                $comment_id = $query->id;
                $check = MSchoolCommentReply::where('comment_id', $comment_id);
                if($check->count() > 0) {
                    $query = $check->first();
                    if(empty($request->content)) {
                        $query->delete();
                    } else {
                        $query->content = $request->content;
                        $query->save();
                    }
                } else {
                    if(!empty($request->content)) {
                        $query = new MSchoolCommentReply;
                        $query->comment_id = $comment_id;
                        $query->content = $request->content;
                        $query->status = 1;
                        $query->save();
                    } else {
                        $query = true;
                    }
                }
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
    //COMMENT

    //COURSE
    public function getSchoolCourse($id, $lang = 1)
    {
        self::__construct();
        try {
            if($id == null) {
                $data = null;
            } else {
                $data = MSchoolCourse::with('mSchoolCourseTranslationsAll','mSchoolClass.mSchoolClassTranslationsAll')->where('id', $id)->first();
            }

            $school_class = MSchoolClass::with('mSchoolClassTranslationsAll')->get();
            if($id == null) {
                if (!empty($data)) {
                    return self::JsonExport(200, 'success', $data, [
                        ['name' => 'school_class', 'data' => $school_class]
                    ]);
                } else {
                    return self::JsonExport(404, 'error', null);
                }
            } else {
                return self::JsonExport(200, 'success', $data, [
                    ['name' => 'school_class', 'data' => $school_class]
                ]);
            }
       } catch (\Exception $e) {
           return self::JsonExport(500, 'error', null);
       }
    }

    public function getDTSchoolCourse($id)
    {
        self::__construct();
        try {
                $data = MSchoolCourse::with('mSchoolCourseTranslations','mSchoolPrograms')->where('school_id', $id);
                return Datatables::of($data)
                ->editColumn('name', function ($v) {
                    return $v->mSchoolCourseTranslations[0]->name;
                 })
                ->editColumn('name_class', function ($v) {
                   return $v->mSchoolCourseTranslations[0]->name_class;
                })
                ->editColumn('start_date', function ($v) {
                    return Carbon::parse($v->start_date)->format('Y-m-d');
                })
                ->editColumn('end_date', function ($v) {
                    return Carbon::parse($v->end_date)->format('Y-m-d');
                })
                ->editColumn('num_student', function ($v) {
                    return $v->num_student;
                })
                ->editColumn('program', function ($v) {
                    if(!empty($v->mSchoolPrograms()->get())) {
                        return count($v->mSchoolPrograms()->get());
                    } else {
                        return 0;
                    }
                })
                ->addColumn('action', function ($v) {
                    return '<a class="table-action table-action-view-program text-aqua cursor-pointer"  data-school-id="'.$v->school_id.'" data-lang="'.$this->lang_id.'" data-id="'.$v->id.'"><i class="fa fa-plus-circle"></i></a><a class="table-action table-action-edit text-green cursor-pointer"  data-school-id="'.$v->school_id.'" data-lang="'.$this->lang_id.'" data-id="'.$v->id.'"><i class="fa fa-edit"></i></a><a class="table-action text-red table-action-delete cursor-pointer"  data-lang="'.$this->lang_id.'" data-id="'.$v->id.'"><i class="fa fa-trash"></i></a>';
                })
                ->rawColumns(['name','name_class','start_date','end_date', 'num_student', 'program','action'])
                ->make(true);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function postSchoolCourse($request)
    {
        self::__construct();
        try {
            DB::beginTransaction();
            $data = [];
            $data_relationship = [];
            if($request->action == 'update' || $request->action == 'delete') {
                $query = MSchoolCourse::find($request->id);
                if(!$query) {
                    DB::rollback();
                    return false;
                }
                if($request->action == 'update') {
                    $query_old = $query->mSchoolCourseTranslationsAll()->where('language_id', $request->lang)->first();
                    if($request->name != $query_old->name) {
                        $data_relationship['slug'] = self::slugify($request->name, 'course');
                    }
                }
            }
            
            if($request->has('name') && !empty($request->name)) {
                $data_relationship['name'] = $request->name;

            }

            if($request->has('name_class') && !empty($request->name_class)) {
                $data_relationship['name_class'] = $request->name_class;
            }

            if($request->has('content') && !empty($request->content)) {
                $data_relationship['content'] = $request->content;
            }
            if($request->has('meta_title') && !empty($request->meta_title)) {
                $data_relationship['meta_title'] = $request->meta_title;
            }
            if($request->has('meta_keyword') && !empty($request->meta_keyword)) {
                $data_relationship['meta_keyword'] = $request->meta_keyword;
            }
            if($request->has('meta_description') && !empty($request->meta_description)) {
                $data_relationship['meta_description'] = $request->meta_description;
            }

            if($request->age == '1,1' && $request->age_month == '0,0') {
                DB::rollback();
                return false;
            }

            if($request->has('age_month') || $request->has('age')) {
                $age_month = explode(',', $request->age_month);
                $age = explode(',', $request->age);
                if($request->age_month != '0,0') {
                    $data['age'] = $age_month[0];
                    $data['age_to'] = $age_month[1];
                    $data['age_month'] = 1;
                } else {
                    $data['age'] = $age[0];
                    $data['age_to'] = $age[1];
                    $data['age_month'] = 0;
                }
            }

            if($request->has('num_student') && !empty($request->num_student)) {
                $data['num_student'] = $request->num_student;
            }

            if($request->has('num_teacher') && !empty($request->num_teacher)) {
                $data['num_teacher'] = $request->num_teacher;
            }
            
            if($request->has('start_date') && !empty($request->start_date)) {
                $data['start_date'] = $request->start_date;
            }

            if($request->has('end_date') && !empty($request->end_date)) {
                $data['end_date'] = $request->end_date;
            } else {
                $data['end_date'] = null;
            }
            if($request->status == 'on') {
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }
            if($request->has('school_class') && !empty($request->school_class)) {
                $data['school_class_id'] = $request->school_class;
            }
            

            if($request->action == 'update') {
                if(count($data_relationship) > 0) {
                    $query->mSchoolCourseTranslationsAll()->where('language_id', $request->lang)->update($data_relationship);
                    if(!$query) {
                        DB::rollback();
                        return false;
                    }
                    if(!empty($data_relationship['slug'])) {
                        $slug = self::slugreload($query_old->slug, $data_relationship['slug'], 'm_school_course');
                        if(!$slug) {
                            DB::rollback();
                            return false;
                        }
                    }
                }
                if(count($data) > 0) {
                    $query->update($data);
                    if(!$query) {
                        DB::rollback();
                        return false;
                    }
                }
            }  else if($request->action == 'delete') {
                $ref = MSchoolCourseTranslation::where('translation_id', $request->id)->delete();
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
                $data['school_id'] = $request->school_id;
                $query = MSchoolCourse::create($data);
                if(!$query) {
                    DB::rollback();
                    return false;
                }
               
                $data_relationship['translation_id'] = $query->id;
                $data_relationship['slug_name'] = $request->name;
                $data_relationship['slug_category'] = 'm_school_course';
                $data_relationship['slug_prefix'] = 'course';
                $trans = self::renderTrans($query->mSchoolCourseTranslations(), $data_relationship);
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
    //COURSE

    //PROGRAM
    public function getDTSchoolProgram($id)
    {
        self::__construct();
        try {
                $data = MSchoolProgram::with('mSchoolProgramTranslations')->where('school_course_id', $id);
                $config_language = self::FetchLanguage($this->lang_id);
                return Datatables::of($data)
                ->editColumn('name', function ($v) {
                    return $v->mSchoolProgramTranslations[0]->name;
                 })
                ->editColumn('time', function ($v) {
                    return $v->time.' '.trans('front.school.detail.unit'.$v->unit_1).'/'.trans('front.school.detail.unit'.$v->unit_2);
                })
                ->editColumn('fee', function ($v) use ($config_language) {
                    if($this->lang_id == 1) {
                        return number_format($v->fee).' '.$config_language->currency_code.'/'.$v->unit_4.' '.trans('front.school.detail.unit'.$v->unit_3);
                    } else {
                        $rate = self::ExchangeRate($this->lang_id);
                        return number_format($v->fee/$rate).' '.$config_language->currency_code.'/'.$v->unit_4.' '.trans('front.school.detail.unit'.$v->unit_3);
                    }
                    
                })
                ->addColumn('action', function ($v) {
                    return '<a class="table-action table-action-edit text-green cursor-pointer" data-school-id="'.$v->school_id.'" data-course-id="'.$v->school_course_id.'" data-lang="'.$this->lang_id.'" data-id="'.$v->id.'"><i class="fa fa-edit"></i></a><a class="table-action text-red table-action-delete cursor-pointer" data-school-id="'.$v->school_id.'" data-course-id="'.$v->school_course_id.'" data-lang="'.$this->lang_id.'" data-id="'.$v->id.'"><i class="fa fa-trash"></i></a>';
                })
                ->rawColumns(['name','time','fee', 'action'])
                ->make(true);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getSchoolProgram($id, $lang = 1)
    {
        self::__construct();
        try {
            if($id == null) {
                $data = null;
            } else {
                $data = MSchoolProgram::with('mSchoolProgramTranslationsAll')->where('id', $id)->first();
            }
            if($id == null) {
                if (!empty($data)) {
                    return self::JsonExport(200, 'success', $data);
                } else {
                    return self::JsonExport(404, 'error', null);
                }
            } else {
                return self::JsonExport(200, 'success', $data);
            }
       } catch (\Exception $e) {
           return self::JsonExport(500, 'error', null);
       }
    }

    public function postSchoolProgram($request)
    {
        self::__construct();
        try {
            DB::beginTransaction();
            $data = [];
            $data_relationship = [];
            if($request->action == 'update' || $request->action == 'delete') {
                $query = MSchoolProgram::find($request->id);
                if(!$query) {
                    DB::rollback();
                    return false;
                }
            }
            
            if($request->has('name') && !empty($request->name)) {
                $data_relationship['name'] = $request->name;

            }
            if($request->has('content') && !empty($request->content)) {
                $data_relationship['content'] = $request->content;
            }

            if($request->has('time') && !empty($request->time)) {
                $data['time'] = $request->time;
            }

            if($request->has('fee') && !empty($request->fee)) {
                $data['fee'] = $request->fee;
            }

            if($request->has('unit1') && !empty($request->unit1)) {
                $data['unit_1'] = $request->unit1;
            }

            if($request->has('unit2') && !empty($request->unit2)) {
                $data['unit_2'] = $request->unit2;
            }

            if($request->has('unit3') && !empty($request->unit3)) {
                $data['unit_3'] = $request->unit3;
            }

            if($request->has('unit4') && !empty($request->unit4)) {
                $data['unit_4'] = $request->unit4;
            }
            
            if($request->action == 'update') {
                if(count($data_relationship) > 0) {
                    $query->mSchoolProgramTranslationsAll()->where('language_id', $request->lang)->update($data_relationship);
                    if(!$query) {
                        DB::rollback();
                        return false;
                    }
                }
                if(count($data) > 0) {
                    $query->update($data);
                    if(!$query) {
                        DB::rollback();
                        return false;
                    }
                }
            }  else if($request->action == 'delete') {
                $ref = MSchoolProgramTranslation::where('translation_id', $request->id)->delete();
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
                $data['school_id'] = $request->school_id;
                $data['school_course_id'] = $request->school_course_id;
                $query = MSchoolProgram::create($data);
                if(!$query) {
                    DB::rollback();
                    return 1;
                }
                $trans = self::renderTrans($query->mSchoolProgramTranslations(), $data_relationship);
                if(!$trans) {
                    DB::rollback();
                    return 2;
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
    //PROGRAM
}
