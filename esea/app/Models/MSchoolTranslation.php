<?php

/**
 * Created by ARIS
 * Date: Fri, 09 Nov 2018 06:47:39 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Laravel\Scout\Searchable;

/**
 * Class MSchoolTranslation
 *
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property string $slogan
 * @property string $meta_title
 * @property string $meta_keyword
 * @property string $meta_description
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property string $content
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $language_id
 * @property int $translation_id
 * @property string $deleted_at
 *
 * @property \App\Models\ConfigLanguage $configLanguage
 * @property \App\Models\MSchool $mSchool
 *
 * @package App\Models
 */
class MSchoolTranslation extends Model
{
    use Searchable;
    public $asYouType = true;

    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'm_school_translation';
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
        'slug',
        'name',
        'slogan',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'address',
        'phone',
        'email',
        'content',
        'description',
        'language_id',
        'translation_id'
    ];

    public function configLanguage()
    {
        return $this->belongsTo(\App\Models\ConfigLanguage::class, 'language_id');
    }

    public function mSchool()
    {
        return $this->belongsTo(\App\Models\MSchool::class, 'translation_id');
    }
}
