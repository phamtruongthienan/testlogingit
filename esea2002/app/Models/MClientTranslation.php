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
 * Class MClientTranslation
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $email
 * @property string $phone
 * @property string $fax
 * @property string $website
 * @property string $job
 * @property string $content
 * @property float $investment
 * @property int $staff
 * @property string $logo
 * @property int $school_id
 * @property int $language_id
 * @property int $translation_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \App\Models\ConfigLanguage $configLanguage
 * @property \App\Models\MSchool $mSchool
 * @property \App\Models\MClient $mClient
 *
 * @package App\Models
 */
class MClientTranslation extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'm_client_translation';
    public static $snakeAttributes = false;

    protected $casts = [
        'investment' => 'float',
        'staff' => 'int',
        'school_id' => 'int',
        'language_id' => 'int',
        'translation_id' => 'int'
    ];

    protected $hidden = [
//        'school_id',
//        'language_id',
//        'translation_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'name',
        'address',
        'email',
        'phone',
        'fax',
        'website',
        'job',
        'content',
        'investment',
        'staff',
        'logo',
        'school_id',
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

    public function mClient()
    {
        return $this->belongsTo(\App\Models\MClient::class, 'translation_id');
    }
}
