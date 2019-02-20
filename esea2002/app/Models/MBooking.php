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
 * Class MBooking
 *
 * @property int $id
 * @property int $login_customer
 * @property \Carbon\Carbon $booking_date
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $content
 * @property int $status
 * @property int $status_booking
 * @property int $school_id
 * @property int $customer_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \App\Models\MCustomer $mCustomer
 * @property \App\Models\MSchool $mSchool
 * @property \Illuminate\Database\Eloquent\Collection $mBookingReplies
 *
 * @package App\Models
 */
class MBooking extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'm_booking';
    public static $snakeAttributes = false;

    protected $casts = [
        'login_customer' => 'int',
        'status' => 'int',
        'status_booking' => 'int',
        'school_id' => 'int',
        'customer_id' => 'int'
    ];

    protected $dates = [
        'booking_date'
    ];

    protected $hidden = [
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'login_customer',
        'booking_date',
        'name',
        'phone',
        'email',
        'content',
        'status',
        'status_booking',
        'school_id',
        'customer_id'
    ];

    public function mCustomer()
    {
        return $this->belongsTo(\App\Models\MCustomer::class, 'customer_id');
    }

    public function mSchool()
    {
        return $this->belongsTo(\App\Models\MSchool::class, 'school_id');
    }

    public function mBookingReplies()
    {
        return $this->hasMany(\App\Models\MBookingReply::class, 'booking_id');
    }
}
