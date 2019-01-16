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
 * Class MSchoolCategoryRating
 *
 * @property int $id
 * @property int $school_category_id
 * @property int $school_id
 * @property int $rating
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \App\Models\MSchoolCategory $mSchoolCategory
 * @property \App\Models\MSchool $mSchool
 *
 * @package App\Models
 */
class MSchoolCategoryRating extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'm_school_category_rating';
    public static $snakeAttributes = false;

    protected $casts = [
        'school_category_id' => 'int',
        'school_id' => 'int',
        'rating' => 'int'
    ];

    protected $hidden = [
        'school_category_id',
        'school_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'school_category_id',
        'school_id',
        'rating'
    ];

    public function mSchoolCategory()
    {
        return $this->belongsTo(\App\Models\MSchoolCategory::class, 'school_category_id');
    }

    public function mSchool()
    {
        return $this->belongsTo(\App\Models\MSchool::class, 'school_id');
    }
}
