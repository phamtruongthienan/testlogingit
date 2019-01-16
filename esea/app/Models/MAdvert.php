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
 * Class MAdvert
 *
 * @property int $id
 * @property int $type
 * @property int $position
 * @property int $target
 * @property string $link
 * @property \Carbon\Carbon $start_date
 * @property \Carbon\Carbon $end_date
 * @property int $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \Illuminate\Database\Eloquent\Collection $mAdvertsTranslations
 *
 * @package App\Models
 */
class MAdvert extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'm_adverts';
    public static $snakeAttributes = false;

    protected $casts = [
        'type' => 'int',
        'position' => 'int',
        'target' => 'int',
        'status' => 'int'
    ];

    protected $dates = [
        'start_date',
        'end_date'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'type',
        'position',
        'target',
        'link',
        'start_date',
        'end_date',
        'status'
    ];

    public function mAdvertsTranslations()
    {
        return $this->hasMany(\App\Models\MAdvertsTranslation::class, 'translation_id')->where('language_id', LaravelLocalization::getCurrentLocaleID());
    }
}
