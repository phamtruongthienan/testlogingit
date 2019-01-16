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
 * Class ConfigLanguage
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property bool $default
 * @property string $currency_code
 * @property string $date_format
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \Illuminate\Database\Eloquent\Collection $configMainTranslations
 * @property \Illuminate\Database\Eloquent\Collection $mAdvertsTranslations
 * @property \Illuminate\Database\Eloquent\Collection $mClientTranslations
 * @property \Illuminate\Database\Eloquent\Collection $mKeywordPriotyTranslations
 * @property \Illuminate\Database\Eloquent\Collection $mKeywordSchoolTranslations
 * @property \Illuminate\Database\Eloquent\Collection $mKeywordSearchTranslations
 * @property \Illuminate\Database\Eloquent\Collection $mMenuTranslations
 * @property \Illuminate\Database\Eloquent\Collection $mNewsTranslations
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolAttributeAddonTranslations
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolAttributeTranslations
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolCategoryTranslations
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolClassAddonTranslations
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolClassTranslations
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolCourseTranslations
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolEventTranslations
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolLanguageTranslations
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolLevelTranslations
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolProgramTranslations
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolTeacherTranslations
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolTranslations
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolTypeTranslations
 * @property \Illuminate\Database\Eloquent\Collection $mSearches
 *
 * @package App\Models
 */
class ConfigLanguage extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'config_language';
    public static $snakeAttributes = false;

    protected $casts = [
        'default' => 'bool'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'name',
        'code',
        'default',
        'currency_code',
        'date_format'
    ];

    public function configMainTranslations()
    {
        return $this->hasMany(\App\Models\ConfigMainTranslation::class, 'language_id');
    }

    public function mAdvertsTranslations()
    {
        return $this->hasMany(\App\Models\MAdvertsTranslation::class, 'language_id');
    }

    public function mClientTranslations()
    {
        return $this->hasMany(\App\Models\MClientTranslation::class, 'language_id');
    }

    public function mKeywordPriotyTranslations()
    {
        return $this->hasMany(\App\Models\MKeywordPriotyTranslation::class, 'language_id');
    }

    public function mKeywordSchoolTranslations()
    {
        return $this->hasMany(\App\Models\MKeywordSchoolTranslation::class, 'language_id');
    }

    public function mKeywordSearchTranslations()
    {
        return $this->hasMany(\App\Models\MKeywordSearchTranslation::class, 'language_id');
    }

    public function mMenuTranslations()
    {
        return $this->hasMany(\App\Models\MMenuTranslation::class, 'language_id');
    }

    public function mNewsTranslations()
    {
        return $this->hasMany(\App\Models\MNewsTranslation::class, 'language_id');
    }

    public function mSchoolAttributeAddonTranslations()
    {
        return $this->hasMany(\App\Models\MSchoolAttributeAddonTranslation::class, 'language_id');
    }

    public function mSchoolAttributeTranslations()
    {
        return $this->hasMany(\App\Models\MSchoolAttributeTranslation::class, 'language_id');
    }

    public function mSchoolCategoryTranslations()
    {
        return $this->hasMany(\App\Models\MSchoolCategoryTranslation::class, 'language_id');
    }

    public function mSchoolClassAddonTranslations()
    {
        return $this->hasMany(\App\Models\MSchoolClassAddonTranslation::class, 'language_id');
    }

    public function mSchoolClassTranslations()
    {
        return $this->hasMany(\App\Models\MSchoolClassTranslation::class, 'language_id');
    }

    public function mSchoolCourseTranslations()
    {
        return $this->hasMany(\App\Models\MSchoolCourseTranslation::class, 'language_id');
    }

    public function mSchoolEventTranslations()
    {
        return $this->hasMany(\App\Models\MSchoolEventTranslation::class, 'language_id');
    }

    public function mSchoolLanguageTranslations()
    {
        return $this->hasMany(\App\Models\MSchoolLanguageTranslation::class, 'language_id');
    }

    public function mSchoolLevelTranslations()
    {
        return $this->hasMany(\App\Models\MSchoolLevelTranslation::class, 'language_id');
    }

    public function mSchoolProgramTranslations()
    {
        return $this->hasMany(\App\Models\MSchoolProgramTranslation::class, 'language_id');
    }

    public function mSchoolTeacherTranslations()
    {
        return $this->hasMany(\App\Models\MSchoolTeacherTranslation::class, 'language_id');
    }

    public function mSchoolTranslations()
    {
        return $this->hasMany(\App\Models\MSchoolTranslation::class, 'language_id');
    }

    public function mSchoolTypeTranslations()
    {
        return $this->hasMany(\App\Models\MSchoolTypeTranslation::class, 'language_id');
    }

    public function mSearches()
    {
        return $this->hasMany(\App\Models\MSearch::class, 'language_id');
    }
}
