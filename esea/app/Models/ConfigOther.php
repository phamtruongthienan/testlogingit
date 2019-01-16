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
 * Class ConfigOther
 *
 * @property string $key
 * @property string $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class ConfigOther extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    protected $table = 'config_other';
    public $incrementing = false;
    public static $snakeAttributes = false;

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'key',
        'value'
    ];
}
