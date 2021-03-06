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
 * Class MKeywordSchoolTranslation
 *
 * @property int $id
 * @property int $status
 * @property int $school_id
 * @property int $sort
 * @property int $language_id
 * @property int $translation_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \App\Models\ConfigLanguage $configLanguage
 * @property \App\Models\MSchool $mSchool
 * @property \App\Models\MKeywordSchool $mKeywordSchool
 *
 * @package App\Models
 */
class MKeywordSchoolTranslation extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'm_keyword_school_translation';
    public static $snakeAttributes = false;

    protected $casts = [
        'status' => 'int',
        'school_id' => 'int',
        'sort' => 'int',
        'language_id' => 'int',
        'translation_id' => 'int'
    ];

    protected $hidden = [
        //'school_id',
        //'language_id',
        //'translation_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'status',
        'school_id',
        'sort',
        'language_id',
        'translation_id'
    ];

    public function configLanguage()
    {
        return $this->belongsTo(\App\Models\ConfigLanguage::class, 'language_id');
    }

    public function mSchool()
    {
        return $this->belongsTo(\App\Models\MSchool::class, 'school_id');
    }

    public function mKeywordSchool()
    {
        return $this->belongsTo(\App\Models\MKeywordSchool::class, 'translation_id');
    }
}
