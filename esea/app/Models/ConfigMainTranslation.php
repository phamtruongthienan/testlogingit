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
 * Class ConfigMainTranslation
 *
 * @property int $id
 * @property string $logo
 * @property string $name
 * @property string $company_name
 * @property string $slogan
 * @property string $quote
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property string $represent
 * @property int $num_promo
 * @property string $background_search
 * @property string $background_promotion
 * @property string $background_client
 * @property bool $enable_ssl
 * @property string $meta_title
 * @property string $meta_keyword
 * @property string $meta_description
 * @property string $analytics_id
 * @property string $facebook_page
 * @property string $googleplus_page
 * @property int $language_id
 * @property int $translation_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \App\Models\ConfigLanguage $configLanguage
 * @property \App\Models\ConfigMain $configMain
 *
 * @package App\Models
 */
class ConfigMainTranslation extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    protected $table = 'config_main_translation';
    public static $snakeAttributes = false;

    protected $casts = [
        'num_promo' => 'int',
        'enable_ssl' => 'bool',
        'language_id' => 'int',
        'translation_id' => 'int'
    ];

    protected $hidden = [
        'analytics_id',
        //'language_id',
        //'translation_id',
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'logo',
        'name',
        'company_name',
        'slogan',
        'quote',
        'address',
        'phone',
        'email',
        'represent',
        'num_promo',
        'background_search',
        'background_promotion',
        'background_client',
        'enable_ssl',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'analytics_id',
        'facebook_page',
        'googleplus_page',
        'language_id',
        'translation_id'
    ];

    public function configLanguage()
    {
        return $this->belongsTo(\App\Models\ConfigLanguage::class, 'language_id');
    }

    public function configMain()
    {
        return $this->belongsTo(\App\Models\ConfigMain::class, 'translation_id');
    }
}
