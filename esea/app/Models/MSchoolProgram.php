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
 * Class MSchoolProgram
 *
 * @property int $id
 * @property int $school_id
 * @property int $school_course_id
 * @property float $time
 * @property int $unit_1
 * @property int $unit_2
 * @property int $unit_3
 * @property int $unit_4
 * @property string $fee
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \App\Models\MSchoolCourse $mSchoolCourse
 * @property \App\Models\MSchool $mSchool
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolProgramTranslations
 *
 * @package App\Models
 */
class MSchoolProgram extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'm_school_program';
    public static $snakeAttributes = false;

    protected $casts = [
        'school_id' => 'int',
        'school_course_id' => 'int',
        'time' => 'float',
        'unit_1' => 'int',
        'unit_2' => 'int',
        'unit_3' => 'int',
        'unit_4' => 'int'
    ];

    protected $hidden = [
        'school_id',
        'school_course_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'school_id',
        'school_course_id',
        'time',
        'unit_1',
        'unit_2',
        'unit_3',
        'unit_4',
        'fee'
    ];

    public function mSchoolCourse()
    {
        return $this->belongsTo(\App\Models\MSchoolCourse::class, 'school_course_id');
    }

    public function mSchool()
    {
        return $this->belongsTo(\App\Models\MSchool::class, 'school_id');
    }

    public function mSchoolProgramTranslations()
    {
        return $this->hasMany(\App\Models\MSchoolProgramTranslation::class, 'translation_id')->where('language_id', LaravelLocalization::getCurrentLocaleID());
    }

    public function mSchoolProgramTranslationsAll()
    {
        return $this->hasMany(\App\Models\MSchoolProgramTranslation::class, 'translation_id');
    }
}
