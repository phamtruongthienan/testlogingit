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
 * Class MSchoolEvent
 *
 * @property int $id
 * @property string $logo
 * @property int $type
 * @property string $target
 * @property int $date_type
 * @property \Carbon\Carbon $start_date
 * @property \Carbon\Carbon $end_date
 * @property int $discount_type
 * @property float $discount
 * @property string $code
 * @property int $position
 * @property int $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolEventTranslations
 *
 * @package App\Models
 */
class MSchoolEvent extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'm_school_event';
    public static $snakeAttributes = false;

    protected $casts = [
        'type' => 'int',
//        'target' => 'json',
        'date_type' => 'int',
        'discount_type' => 'int',
        'discount' => 'float',
        'position' => 'int',
        'status' => 'int'
    ];

    protected $dates = [
        'start_date',
        'end_date'
    ];

    protected $hidden = [
//        'target',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'logo',
        'type',
        'target',
        'date_type',
        'start_date',
        'end_date',
        'discount_type',
        'discount',
        'code',
        'position',
        'status'
    ];

    public function mSchoolEventTranslations()
    {
        return $this->hasMany(\App\Models\MSchoolEventTranslation::class, 'translation_id')->where('language_id', LaravelLocalization::getCurrentLocaleID());
    }
	
		public function mSchoolEventTranslationsAll()
		{
			return $this->hasMany(\App\Models\MSchoolEventTranslation::class, 'translation_id');
		}
		
    public function getSchoolAttribute()
    {
        $items = json_decode($this->attributes['target']);
        $instance = new \App\Models\MSchool();
        return $instance->newCollection(array_map(function ($item) use ($instance) {
            return $instance->with('mSchoolTranslations')->get();
        }, $items))[0];
    }


}
