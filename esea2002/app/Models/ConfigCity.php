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
 * Class ConfigCity
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \Illuminate\Database\Eloquent\Collection $configDistricts
 * @property \Illuminate\Database\Eloquent\Collection $mSchools
 *
 * @package App\Models
 */
class ConfigCity extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'config_city';
    public static $snakeAttributes = false;

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'name'
    ];

    public function configDistricts()
    {
        return $this->hasMany(\App\Models\ConfigDistrict::class, 'city_id');
    }

    public function mSchools()
    {
        return $this->hasMany(\App\Models\MSchool::class, 'city_id');
    }
}
