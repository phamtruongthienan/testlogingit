<?php

/**
 * Created by ARIS
 * Date: Thu, 29 Nov 2018 07:48:09 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Laravel\Scout\Searchable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


/**
 * Class MCustomer
 * 
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $name
 * @property \Carbon\Carbon $dob
 * @property string $phone
 * @property string $address
 * @property string $logo
 * @property int $type
 * @property int $gender
 * @property int $status
 * @property string $lat
 * @property string $long
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $mBookings
 * @property \Illuminate\Database\Eloquent\Collection $mChildren
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolComments
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolCommentRatings
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolRatingStars
 * @property \Illuminate\Database\Eloquent\Collection $mSearches
 * @property \Illuminate\Database\Eloquent\Collection $mWishlists
 *
 * @package App\Models
 */
class MCustomer extends Authenticatable
{
	use Notifiable;
	
	protected $guard = 'customer';

    use Searchable;
    public $asYouType = true;

	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'm_customer';
	public static $snakeAttributes = false;

	protected $casts = [
		'type' => 'int',
		'gender' => 'int',
		'status' => 'int',
		'phone' => 'string'
	];

	protected $dates = [
		'dob'
	];

	protected $hidden = [
		'password',
		'remember_token',
		'created_at',
		'updated_at',
		'deleted_at'
	];

	protected $fillable = [
		'email',
		'password',
		'name',
		'dob',
		'phone',
		'address',
		'logo',
		'type',
		'gender',
		'status',
		'lat',
		'long',
		'remember_token'
	];

	public function mBookings()
	{
		return $this->hasMany(\App\Models\MBooking::class, 'customer_id');
	}

	public function mChildren()
	{
		return $this->hasMany(\App\Models\MChild::class, 'customer_id');
	}

	public function mSchoolComments()
	{
		return $this->hasMany(\App\Models\MSchoolComment::class, 'customer_id');
	}

	public function mSchoolCommentRatings()
	{
		return $this->hasMany(\App\Models\MSchoolCommentRating::class, 'customer_id');
	}

	public function mSchoolRatingStars()
	{
		return $this->hasMany(\App\Models\MSchoolRatingStar::class, 'customer_id');
	}

	public function mSearches()
	{
		return $this->hasMany(\App\Models\MSearch::class, 'customer_id');
	}

	public function mWishlists()
	{
		return $this->hasMany(\App\Models\MWishlist::class, 'customer_id');
	}
}
