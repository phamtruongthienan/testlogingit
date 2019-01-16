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
 * Class MSchoolLanguageCourse
 *
 * @property int $id
 * @property int $school_language_id
 * @property int $school_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \App\Models\MSchool $mSchool
 * @property \App\Models\MSchoolLanguage $mSchoolLanguage
 *
 * @package App\Models
 */
class MSchoolLanguageCourse extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'm_school_language_course';
    public static $snakeAttributes = false;

    protected $casts = [
        'school_language_id' => 'int',
        'school_id' => 'int'
    ];

    protected $hidden = [
        'school_language_id',
        'school_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'school_language_id',
        'school_id'
    ];

    public function mSchool()
    {
        return $this->belongsTo(\App\Models\MSchool::class, 'school_id');
    }

    public function mSchoolLanguage()
    {
        return $this->belongsTo(\App\Models\MSchoolLanguage::class, 'school_language_id');
    }
}
