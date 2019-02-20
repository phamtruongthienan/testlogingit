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
 * Class MChild
 *
 * @property int $id
 * @property int $customer_id
 * @property string $name
 * @property \Carbon\Carbon $dob
 * @property int $gender
 * @property string $genitive
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
class MChild extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'm_child';
    public static $snakeAttributes = false;

    protected $casts = [
        'customer_id' => 'int',
        'gender' => 'int',
        'school_id' => 'int'
    ];

    protected $dates = [
        'dob'
    ];

    protected $hidden = [
        'customer_id',
        'school_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'customer_id',
        'name',
        'dob',
        'gender',
        'genitive',
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
