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
 * Class MKeywordPrioty
 *
 * @property int $id
 * @property int $keyword_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \App\Models\MKeyword $mKeyword
 * @property \Illuminate\Database\Eloquent\Collection $mKeywordPriotyTranslations
 *
 * @package App\Models
 */
class MKeywordPrioty extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'm_keyword_prioty';
    public static $snakeAttributes = false;

    protected $casts = [
        'keyword_id' => 'int'
    ];

    protected $hidden = [
        'keyword_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'keyword_id'
    ];

    public function mKeyword()
    {
        return $this->belongsTo(\App\Models\MKeyword::class, 'keyword_id');
    }

    public function mKeywordPriotyTranslations()
    {
        return $this->hasMany(\App\Models\MKeywordPriotyTranslation::class, 'translation_id')->where('language_id', LaravelLocalization::getCurrentLocaleID());
    }
}
