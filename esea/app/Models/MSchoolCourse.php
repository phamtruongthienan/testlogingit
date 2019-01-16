<?php

/**
 * Created by ARIS
 * Date: Fri, 09 Nov 2018 06:47:39 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Laravel\Scout\Searchable;

/**
 * Class MSchoolCourse
 *
 * @property int $id
 * @property int $school_id
 * @property int $school_class_id
 * @property int $num_student
 * @property int $num_teacher
 * @property \Carbon\Carbon $start_date
 * @property \Carbon\Carbon $end_date
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \App\Models\MSchoolClass $mSchoolClass
 * @property \App\Models\MSchool $mSchool
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolCourseTranslations
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolPrograms
 *
 * @package App\Models
 */
class MSchoolCourse extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'm_school_course';
    public static $snakeAttributes = false;

    protected $casts = [
        'school_id' => 'int',
        'school_class_id' => 'int',
        'num_student' => 'int',
        'num_teacher' => 'int',
        'age' => 'int',
        'age_to' => 'int',
        'age_month' => 'int',
        'status' => 'int'
    ];

    protected $dates = [
        'start_date',
        'end_date'
    ];

    protected $hidden = [
        // 'school_id',
        // 'school_class_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'school_id',
        'school_class_id',
        'num_student',
        'num_teacher',
        'start_date',
        'end_date',
        'age',
        'age_to',
        'age_month',
        'status'
    ];

    public function mSchoolClass()
    {
        return $this->belongsTo(\App\Models\MSchoolClass::class, 'school_class_id');
    }

    public function mSchool()
    {
        return $this->belongsTo(\App\Models\MSchool::class, 'school_id');
    }

    public function mSchoolCourseTranslations()
    {
        return $this->hasMany(\App\Models\MSchoolCourseTranslation::class, 'translation_id')->where('language_id', LaravelLocalization::getCurrentLocaleID());
    }

    public function mSchoolCourseTranslationsAll()
    {
        return $this->hasMany(\App\Models\MSchoolCourseTranslation::class, 'translation_id');
    }

    public function mSchoolPrograms()
    {
        return $this->hasMany(\App\Models\MSchoolProgram::class, 'school_course_id');
    }
}
