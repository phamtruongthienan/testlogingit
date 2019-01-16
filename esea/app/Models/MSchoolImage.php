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
 * Class MSchoolImage
 *
 * @property int $id
 * @property string $image
 * @property int $school_id
 * @property int $is_avatar
 * @property int $is_cover
 * @property int $is_intro
 * @property int $is_gallery
 * @property int $is_meta
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \App\Models\MSchool $mSchool
 *
 * @package App\Models
 */
class MSchoolImage extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'm_school_image';
    public static $snakeAttributes = false;

    protected $casts = [
        'school_id' => 'int',
        'is_avatar' => 'int',
        'is_cover' => 'int',
        'is_intro' => 'int',
        'is_gallery' => 'int',
        'is_meta' => 'int'
    ];

    protected $hidden = [
        'school_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'image',
        'school_id',
        'is_avatar',
        'is_cover',
        'is_intro',
        'is_gallery',
        'is_meta'
    ];

    public function mSchool()
    {
        return $this->belongsTo(\App\Models\MSchool::class, 'school_id');
    }
}
