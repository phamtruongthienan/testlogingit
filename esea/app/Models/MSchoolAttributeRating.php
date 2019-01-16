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
 * Class MSchoolAttributeRating
 *
 * @property int $id
 * @property int $school_attribute_id
 * @property int $school_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \App\Models\MSchoolAttribute $mSchoolAttribute
 * @property \App\Models\MSchool $mSchool
 *
 * @package App\Models
 */
class MSchoolAttributeRating extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'm_school_attribute_rating';
    public static $snakeAttributes = false;

    protected $casts = [
        'school_attribute_id' => 'int',
        'school_id' => 'int'
    ];

    protected $hidden = [
        'school_attribute_id',
        'school_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'school_attribute_id',
        'school_id'
    ];

    public function mSchoolAttribute()
    {
        return $this->belongsTo(\App\Models\MSchoolAttribute::class, 'school_attribute_id');
    }

    public function mSchool()
    {
        return $this->belongsTo(\App\Models\MSchool::class, 'school_id');
    }
}
