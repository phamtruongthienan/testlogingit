<?php

/**
 * Created by ARIS
 * Date: Wed, 28 Nov 2018 03:53:58 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Laravel\Scout\Searchable;

/**
 * Class MSchoolComment
 * 
 * @property int $id
 * @property int $customer_id
 * @property string $content
 * @property int $rating
 * @property int $school_id
 * @property int $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\MCustomer $mCustomer
 * @property \App\Models\MSchool $mSchool
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolCommentRatings
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolCommentReplies
 *
 * @package App\Models
 */
class MSchoolComment extends Eloquent
{
    use Searchable;
    public $asYouType = true;

	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'm_school_comment';
	public static $snakeAttributes = false;

	protected $casts = [
		'customer_id' => 'int',
		'rating' => 'int',
		'school_id' => 'int',
		'status' => 'int'
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
		'content',
		'rating',
		'school_id',
		'status'
	];

	public function mCustomer()
	{
		return $this->belongsTo(\App\Models\MCustomer::class, 'customer_id');
	}

	public function mSchool()
	{
		return $this->belongsTo(\App\Models\MSchool::class, 'school_id');
	}

	public function mSchoolCommentRatings()
	{
		return $this->hasMany(\App\Models\MSchoolCommentRating::class, 'comment_id');
	}

	public function mSchoolCommentReplies()
	{
		return $this->hasMany(\App\Models\MSchoolCommentReply::class, 'comment_id');
	}
}
