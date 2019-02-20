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
 * Class MSchoolLanguage
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolLanguageCourses
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolLanguageTranslations
 *
 * @package App\Models
 */
class MSchoolLanguage extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'm_school_language';
    public static $snakeAttributes = false;

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function mSchoolLanguageCourses()
    {
        return $this->hasMany(\App\Models\MSchoolLanguageCourse::class, 'school_language_id');
    }

    public function mSchoolLanguageTranslations()
    {
        return $this->hasMany(\App\Models\MSchoolLanguageTranslation::class, 'translation_id')->where('language_id', LaravelLocalization::getCurrentLocaleID());
    }
	
		public function mSchoolLanguageTranslationsAll()
		{
			return $this->hasMany(\App\Models\MSchoolLanguageTranslation::class, 'translation_id');
		}
}
