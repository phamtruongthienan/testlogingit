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
 * Class MSchoolLevelTranslation
 *
 * @property int $id
 * @property string $name
 * @property int $language_id
 * @property int $translation_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \App\Models\ConfigLanguage $configLanguage
 * @property \App\Models\MSchoolLevel $mSchoolLevel
 *
 * @package App\Models
 */
class MSchoolLevelTranslation extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'm_school_level_translation';
    public static $snakeAttributes = false;

    protected $casts = [
        'language_id' => 'int',
        'translation_id' => 'int'
    ];

    protected $hidden = [
        // 'language_id',
        // 'translation_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'name',
        'language_id',
        'translation_id'
    ];

    public function configLanguage()
    {
        return $this->belongsTo(\App\Models\ConfigLanguage::class, 'language_id');
    }

    public function mSchoolLevel()
    {
        return $this->belongsTo(\App\Models\MSchoolLevel::class, 'translation_id');
    }
}