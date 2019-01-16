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
 * Class MSchoolCategory
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolAttributes
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolCategoryRatings
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolCategoryTranslations
 *
 * @package App\Models
 */
class MSchoolCategory extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'm_school_category';
    public static $snakeAttributes = false;

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function mSchoolAttributes()
    {
        return $this->hasMany(\App\Models\MSchoolAttribute::class, 'school_category_id');
    }

    public function mSchoolCategoryRatings()
    {
        return $this->hasMany(\App\Models\MSchoolCategoryRating::class, 'school_category_id');
    }

    public function mSchoolCategoryTranslations()
    {
        return $this->hasMany(\App\Models\MSchoolCategoryTranslation::class, 'translation_id')->where('language_id', LaravelLocalization::getCurrentLocaleID());
    }
}
