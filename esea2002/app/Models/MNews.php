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
 * Class MNews
 *
 * @property int $id
 * @property int $layout_id
 * @property int $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \App\Models\MLayout $mLayout
 * @property \Illuminate\Database\Eloquent\Collection $mMenus
 * @property \Illuminate\Database\Eloquent\Collection $mNewsTranslations
 *
 * @package App\Models
 */
class MNews extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'm_news';
    public static $snakeAttributes = false;

    protected $casts = [
        'layout_id' => 'int',
        'status' => 'int'
    ];

    protected $hidden = [
        'layout_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'layout_id',
        'status'
    ];

    public function mLayout()
    {
        return $this->belongsTo(\App\Models\MLayout::class, 'layout_id');
    }

    public function mMenus()
    {
        return $this->hasMany(\App\Models\MMenu::class, 'news_id');
    }

    public function mNewsTranslations()
    {
        return $this->hasMany(\App\Models\MNewsTranslation::class, 'translation_id')->where('language_id', LaravelLocalization::getCurrentLocaleID());
    }

    public function mNewsTranslationsAll()
    {
        return $this->hasMany(\App\Models\MNewsTranslation::class, 'translation_id');
    }
}
