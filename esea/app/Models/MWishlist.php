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
 * Class MWishlist
 *
 * @property int $id
 * @property int $customer_id
 * @property int $school_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \App\Models\MCustomer $mCustomer
 * @property \App\Models\MSchool $mSchool
 *
 * @package App\Models
 */
class MWishlist extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    protected $table = 'm_wishlist';
    public static $snakeAttributes = false;

    protected $casts = [
        'customer_id' => 'int',
        'school_id' => 'int'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'customer_id',
        'school_id'
    ];

    public function mCustomer()
    {
        return $this->belongsTo(\App\Models\MCustomer::class, 'customer_id');
    }

    public function mSchool()
    {
        return $this->belongsTo(\App\Models\MSchool::class, 'school_id');
    }
}
