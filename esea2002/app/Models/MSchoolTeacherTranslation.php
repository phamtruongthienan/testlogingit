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
 * Class MSchoolTeacherTranslation
 *
 * @property int $id
 * @property string $teacher
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $language_id
 * @property int $translation_id
 * @property string $deleted_at
 *
 * @property \App\Models\ConfigLanguage $configLanguage
 * @property \App\Models\MSchoolTeacher $mSchoolTeacher
 *
 * @package App\Models
 */
class MSchoolTeacherTranslation extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'm_school_teacher_translation';
    public static $snakeAttributes = false;

    protected $casts = [
        'language_id' => 'int',
        'translation_id' => 'int'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        // 'language_id',
        // 'translation_id',
        'deleted_at'
    ];

    protected $fillable = [
        'teacher',
        'language_id',
        'translation_id'
    ];

    public function configLanguage()
    {
        return $this->belongsTo(\App\Models\ConfigLanguage::class, 'language_id');
    }

    public function mSchoolTeacher()
    {
        return $this->belongsTo(\App\Models\MSchoolTeacher::class, 'translation_id');
    }
}
