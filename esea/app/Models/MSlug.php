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
 * Class MSlug
 *
 * @property int $id
 * @property string $slug
 * @property string $category
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @package App\Models
 */
class MSlug extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'm_slug';
    public static $snakeAttributes = false;

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'slug',
        'category'
    ];
}
