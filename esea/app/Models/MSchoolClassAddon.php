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
 * Class MSchoolClassAddon
 *
 * @property int $id
 * @property int $school_class_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \App\Models\MSchoolClass $mSchoolClass
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolClassAddonTranslations
 *
 * @package App\Models
 */
class MSchoolClassAddon extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'm_school_class_addon';
    public static $snakeAttributes = false;

    protected $casts = [
        'school_class_id' => 'int'
    ];

    protected $hidden = [
//        'school_class_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'school_class_id'
    ];

    public function mSchoolClass()
    {
        return $this->belongsTo(\App\Models\MSchoolClass::class, 'school_class_id');
    }

    public function mSchoolClassAddonTranslations()
    {
        return $this->hasMany(\App\Models\MSchoolClassAddonTranslation::class, 'translation_id')->where('language_id', LaravelLocalization::getCurrentLocaleID());
    }
	
		public function mSchoolClassAddonTranslationsAll()
		{
			return $this->hasMany(\App\Models\MSchoolClassAddonTranslation::class, 'translation_id');
		}
}
