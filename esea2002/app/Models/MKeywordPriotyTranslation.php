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
 * Class MKeywordPriotyTranslation
 *
 * @property int $id
 * @property int $type
 * @property int $status
 * @property int $district_id
 * @property int $school_level_id
 * @property int $school_type_id
 * @property int $language_id
 * @property int $translation_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \App\Models\ConfigDistrict $configDistrict
 * @property \App\Models\ConfigLanguage $configLanguage
 * @property \App\Models\MSchoolLevel $mSchoolLevel
 * @property \App\Models\MSchoolType $mSchoolType
 * @property \App\Models\MKeywordPrioty $mKeywordPrioty
 *
 * @package App\Models
 */
class MKeywordPriotyTranslation extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'm_keyword_prioty_translation';
    public static $snakeAttributes = false;

    protected $casts = [
        'type' => 'int',
        'status' => 'int',
        'district_id' => 'int',
        'school_level_id' => 'int',
        'school_type_id' => 'int',
        'language_id' => 'int',
        'translation_id' => 'int'
    ];

    protected $hidden = [
        //'district_id',
        //'school_level_id',
        //'school_type_id',
        //'language_id',
        //'translation_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'type',
        'status',
        'district_id',
        'school_level_id',
        'school_type_id',
        'language_id',
        'translation_id'
    ];

    public function configDistrict()
    {
        return $this->belongsTo(\App\Models\ConfigDistrict::class, 'district_id');
    }

    public function configLanguage()
    {
        return $this->belongsTo(\App\Models\ConfigLanguage::class, 'language_id');
    }

    public function mSchoolLevel()
    {
        return $this->belongsTo(\App\Models\MSchoolLevel::class, 'school_level_id');
    }

    public function mSchoolType()
    {
        return $this->belongsTo(\App\Models\MSchoolType::class, 'school_type_id');
    }

    public function mKeywordPrioty()
    {
        return $this->belongsTo(\App\Models\MKeywordPrioty::class, 'translation_id');
    }
}
