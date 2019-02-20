<?php

/**
 * Created by ARIS
 * Date: Thu, 29 Nov 2018 09:57:45 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Laravel\Scout\Searchable;

/**
 * Class MSchoolCommentRating
 * 
 * @property int $id
 * @property int $school_id
 * @property int $customer_id
 * @property int $category_id
 * @property int $rating
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\MSchoolCategory $mSchoolCategory
 * @property \App\Models\MCustomer $mCustomer
 * @property \App\Models\MSchool $mSchool
 *
 * @package App\Models
 */
class MSchoolCommentRating extends Eloquent
{
    use Searchable;
    public $asYouType = true;

	//use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'm_school_comment_rating';
	public static $snakeAttributes = false;

	protected $casts = [
		'school_id' => 'int',
		'customer_id' => 'int',
		'category_id' => 'int',
		'rating' => 'int'
	];

	protected $hidden = [
		'created_at',
		'updated_at',
		'deleted_at'
	];

	protected $fillable = [
		'school_id',
		'customer_id',
		'category_id',
		'rating'
	];

	public function mSchoolCategory()
	{
		return $this->belongsTo(\App\Models\MSchoolCategory::class, 'category_id');
	}

	public function mCustomer()
	{
		return $this->belongsTo(\App\Models\MCustomer::class, 'customer_id');
	}

	public function mSchool()
	{
		return $this->belongsTo(\App\Models\MSchool::class, 'school_id');
	}
}
