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
 * Class MMenu
 *
 * @property int $id
 * @property int $news_id
 * @property int $sort
 * @property int $position
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \App\Models\MNews $mNews
 * @property \Illuminate\Database\Eloquent\Collection $mMenuTranslations
 *
 * @package App\Models
 */
class MMenu extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'm_menu';
    public static $snakeAttributes = false;

    protected $casts = [
        'news_id' => 'int',
        'sort' => 'int',
        'position' => 'int'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'news_id',
        'sort',
        'position',
        'layout_id'
    ];

    public function mNews()
    {
        return $this->belongsTo(\App\Models\MNews::class, 'news_id')->where('status', 1);
    }

    public function mMenuTranslations()
    {
        return $this->hasMany(\App\Models\MMenuTranslation::class, 'translation_id')->where('language_id', LaravelLocalization::getCurrentLocaleID());
    }

    public function mMenuTranslationsAll()
    {
        return $this->hasMany(\App\Models\MMenuTranslation::class, 'translation_id');
    }
}
