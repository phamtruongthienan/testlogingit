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
 * Class ConfigMain
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \Illuminate\Database\Eloquent\Collection $configMainTranslations
 *
 * @package App\Models
 */
class ConfigMain extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    protected $table = 'config_main';
    public static $snakeAttributes = false;

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function configMainTranslations()
    {
        return $this->hasMany(\App\Models\ConfigMainTranslation::class, 'translation_id')->where('language_id', LaravelLocalization::getCurrentLocaleID());
    }
}
