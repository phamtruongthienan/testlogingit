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
 * Class ConfigWard
 *
 * @property int $id
 * @property string $name
 * @property int $district_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \App\Models\ConfigDistrict $configDistrict
 * @property \Illuminate\Database\Eloquent\Collection $mSchools
 *
 * @package App\Models
 */
class ConfigWard extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'config_ward';
    public static $snakeAttributes = false;

    protected $casts = [
        'district_id' => 'int'
    ];

    protected $hidden = [
//        'district_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'name',
        'district_id'
    ];

    public function configDistrict()
    {
        return $this->belongsTo(\App\Models\ConfigDistrict::class, 'district_id');
    }

    public function mSchools()
    {
        return $this->hasMany(\App\Models\MSchool::class, 'ward_id');
    }
}
