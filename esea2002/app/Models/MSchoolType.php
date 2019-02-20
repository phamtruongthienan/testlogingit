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
 * Class MSchoolType
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \Illuminate\Database\Eloquent\Collection $mKeywordPriotyTranslations
 * @property \Illuminate\Database\Eloquent\Collection $mSchools
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolAttributes
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolTypeTranslations
 *
 * @package App\Models
 */
class MSchoolType extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'm_school_type';
    public static $snakeAttributes = false;

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function mKeywordPriotyTranslations()
    {
        return $this->hasMany(\App\Models\MKeywordPriotyTranslation::class, 'school_type_id');
    }

    public function mSchools()
    {
        return $this->hasMany(\App\Models\MSchool::class, 'school_type_id');
    }

    public function mSchoolTypeTranslations()
    {
        return $this->hasMany(\App\Models\MSchoolTypeTranslation::class, 'translation_id')->where('language_id', LaravelLocalization::getCurrentLocaleID());
    }
	
		public function mSchoolTypeTranslationsAll()
		{
			return $this->hasMany(\App\Models\MSchoolTypeTranslation::class, 'translation_id');
		}
}
