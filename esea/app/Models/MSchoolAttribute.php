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
 * Class MSchoolAttribute
 *
 * @property int $id
 * @property string $icon
 * @property int $school_category_id
 * @property int $type
 * @property int $search
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \App\Models\MSchoolCategory $mSchoolCategory
 * @property \App\Models\MSchoolType $mSchoolType
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolAttributeRatings
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolAttributeTranslations
 *
 * @package App\Models
 */
class MSchoolAttribute extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'm_school_attribute';
    public static $snakeAttributes = false;

    protected $casts = [
        'school_category_id' => 'int',
        'type' => 'int',
        'search' => 'int'
    ];

    protected $hidden = [
        'school_category_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'icon',
        'school_category_id',
        'type',
        'search'
    ];

    public function mSchoolCategory()
    {
        return $this->belongsTo(\App\Models\MSchoolCategory::class, 'school_category_id');
    }

    public function mSchoolAttributeRatings()
    {
        return $this->hasMany(\App\Models\MSchoolAttributeRating::class, 'school_attribute_id');
    }

    public function mSchoolAttributeTranslations()
    {
        return $this->hasMany(\App\Models\MSchoolAttributeTranslation::class, 'translation_id')->where('language_id', LaravelLocalization::getCurrentLocaleID());
    }
}
