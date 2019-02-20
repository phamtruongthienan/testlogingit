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
 * Class MSchoolClass
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolClassAddons
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolClassTranslations
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolCourses
 *
 * @package App\Models
 */
class MSchoolClass extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'm_school_class';
    public static $snakeAttributes = false;

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function mSchoolClassAddons()
    {
        return $this->hasMany(\App\Models\MSchoolClassAddon::class, 'school_class_id');
    }

    public function mSchoolClassTranslations()
    {
        return $this->hasMany(\App\Models\MSchoolClassTranslation::class, 'translation_id')->where('language_id', LaravelLocalization::getCurrentLocaleID());
    }

    public function mSchoolClassTranslationsAll()
    {
        return $this->hasMany(\App\Models\MSchoolClassTranslation::class, 'translation_id');
    }

    public function mSchoolCourses()
    {
        return $this->hasMany(\App\Models\MSchoolCourse::class, 'school_class_id');
    }
}
