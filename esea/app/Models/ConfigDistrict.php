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
 * Class ConfigDistrict
 *
 * @property int $id
 * @property string $name
 * @property int $city_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \App\Models\ConfigCity $configCity
 * @property \Illuminate\Database\Eloquent\Collection $configWards
 * @property \Illuminate\Database\Eloquent\Collection $mKeywordPriotyTranslations
 * @property \Illuminate\Database\Eloquent\Collection $mSchools
 *
 * @package App\Models
 */
class ConfigDistrict extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'config_district';
    public static $snakeAttributes = false;

    protected $casts = [
        'city_id' => 'int'
    ];

    protected $hidden = [
        'city_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'name',
        'city_id'
    ];

    public function configCity()
    {
        return $this->belongsTo(\App\Models\ConfigCity::class, 'city_id');
    }

    public function configWards()
    {
        return $this->hasMany(\App\Models\ConfigWard::class, 'district_id');
    }

    public function mKeywordPriotyTranslations()
    {
        return $this->hasMany(\App\Models\MKeywordPriotyTranslation::class, 'district_id');
    }

    public function mSchools()
    {
        return $this->hasMany(\App\Models\MSchool::class, 'district_id');
    }
}
