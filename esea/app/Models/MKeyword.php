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
 * Class MKeyword
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \Illuminate\Database\Eloquent\Collection $mKeywordPrioties
 * @property \Illuminate\Database\Eloquent\Collection $mKeywordSchools
 * @property \Illuminate\Database\Eloquent\Collection $mKeywordSearches
 *
 * @package App\Models
 */
class MKeyword extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'm_keyword';
    public static $snakeAttributes = false;

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function mKeywordPrioties()
    {
        return $this->hasMany(\App\Models\MKeywordPrioty::class, 'keyword_id');
    }

    public function mKeywordSchools()
    {
        return $this->hasMany(\App\Models\MKeywordSchool::class, 'keyword_id');
    }

    public function mKeywordSearches()
    {
        return $this->hasMany(\App\Models\MKeywordSearch::class, 'keyword_id');
    }
}
