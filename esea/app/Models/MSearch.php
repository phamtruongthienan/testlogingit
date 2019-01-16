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
 * Class MSearch
 *
 * @property int $id
 * @property int $customer_id
 * @property int $language_id
 * @property string $keyword
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \App\Models\MCustomer $mCustomer
 * @property \App\Models\ConfigLanguage $configLanguage
 *
 * @package App\Models
 */
class MSearch extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'm_search';
    public static $snakeAttributes = false;

    protected $casts = [
        'customer_id' => 'int',
        'language_id' => 'int'
    ];

    protected $hidden = [
        'customer_id',
        'language_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'customer_id',
        'language_id',
        'keyword'
    ];

    public function mCustomer()
    {
        return $this->belongsTo(\App\Models\MCustomer::class, 'customer_id');
    }

    public function configLanguage()
    {
        return $this->belongsTo(\App\Models\ConfigLanguage::class, 'language_id');
    }
}
