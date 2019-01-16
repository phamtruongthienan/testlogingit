<?php

/**
 * Created by ARIS
 * Date: Fri, 30 Nov 2018 07:05:52 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Laravel\Scout\Searchable;
use Carbon\Carbon;
use Auth;
use Spatie\QueryBuilder\QueryBuilder as Builder;
use \JordanMiguel\LaravelPopular\Traits\Visitable;

/**
 * Class MSchool
 * 
 * @property int $id
 * @property int $branch
 * @property int $school_id
 * @property int $city_id
 * @property int $district_id
 * @property int $ward_id
 * @property int $school_level_id
 * @property int $school_type_id
 * @property string $facebook_page
 * @property string $google_page
  * @property string $logo
 * @property string $file_360
 * @property string $file_pdf
 * @property string $file_video
 * @property string $background_intro
 * @property string $background_facility
 * @property string $background_price
 * @property string $background_review
 * @property string $background_map
 * @property string $lat
 * @property string $lng
 * @property string $tuition
 * @property string $tuition_max
 * @property int $search
 * @property int $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\ConfigCity $configCity
 * @property \App\Models\ConfigDistrict $configDistrict
 * @property \App\Models\MSchool $mSchool
 * @property \App\Models\MSchoolLevel $mSchoolLevel
 * @property \App\Models\MSchoolType $mSchoolType
 * @property \App\Models\ConfigWard $configWard
 * @property \Illuminate\Database\Eloquent\Collection $mBookings
 * @property \Illuminate\Database\Eloquent\Collection $mChildren
 * @property \Illuminate\Database\Eloquent\Collection $mClientTranslations
 * @property \Illuminate\Database\Eloquent\Collection $mHits
 * @property \Illuminate\Database\Eloquent\Collection $mKeywordSchoolTranslations
 * @property \Illuminate\Database\Eloquent\Collection $mSchools
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolAttributeAddons
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolAttributeRatings
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolCategoryRatings
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolComments
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolCommentRatings
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolCourses
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolImages
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolLanguageCourses
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolPrograms
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolScores
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolTeachers
 * @property \Illuminate\Database\Eloquent\Collection $mSchoolTranslations
 * @property \Illuminate\Database\Eloquent\Collection $mWishlists
 *
 * @package App\Models
 */
class MSchool extends Eloquent
{
	use Searchable;
	use Visitable;
    public $asYouType = true;

	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'm_school';
	public static $snakeAttributes = false;

	protected $casts = [
		'branch' => 'int',
		'school_id' => 'int',
		'city_id' => 'int',
		'district_id' => 'int',
		'ward_id' => 'int',
		'school_level_id' => 'int',
		'school_type_id' => 'int',
		'search' => 'int',
		'status' => 'int'
	];

	protected $hidden = [
		// 'school_id',
		// 'city_id',
		// 'district_id',
		// 'ward_id',
		// 'school_level_id',
		// 'school_type_id',
		'created_at',
		'updated_at',
		'deleted_at'
	];

	protected $fillable = [
		'branch',
		'school_id',
		'city_id',
		'district_id',
		'ward_id',
		'school_level_id',
		'school_type_id',
		'facebook_page',
		'google_page',
		'logo',
		'file_360',
		'file_pdf',
		'file_video',
		'background_intro',
		'background_facility',
		'background_price',
		'background_review',
		'background_map',
		'lat',
		'lng',
		'tuition',
		'tuition_max',
		'search',
		'status'
	];

	protected $appends = ['rating'];

	public function configCity()
	{
		return $this->belongsTo(\App\Models\ConfigCity::class, 'city_id');
	}

	public function configDistrict()
	{
		return $this->belongsTo(\App\Models\ConfigDistrict::class, 'district_id');
	}

	public function mSchool()
	{
		return $this->belongsTo(\App\Models\MSchool::class, 'school_id');
	}

	public function mSchoolLevel()
	{
		return $this->belongsTo(\App\Models\MSchoolLevel::class, 'school_level_id');
	}

	public function mSchoolType()
	{
		return $this->belongsTo(\App\Models\MSchoolType::class, 'school_type_id');
	}

	public function configWard()
	{
		return $this->belongsTo(\App\Models\ConfigWard::class, 'ward_id');
	}

	public function mBookings()
	{
		return $this->hasMany(\App\Models\MBooking::class, 'school_id');
	}

	public function mChildren()
	{
		return $this->hasMany(\App\Models\MChild::class, 'school_id');
	}

	public function mClientTranslations()
	{
		return $this->hasMany(\App\Models\MClientTranslation::class, 'school_id');
	}

	public function mHits()
	{
		return $this->hasMany(\App\Models\MHit::class, 'school_id');
	}

	public function mKeywordSchoolTranslations()
	{
		return $this->hasMany(\App\Models\MKeywordSchoolTranslation::class, 'school_id');
	}

	public function mSchools()
	{
		return $this->hasMany(\App\Models\MSchool::class, 'school_id');
	}

	public function mSchoolAttributeAddons()
	{
		return $this->hasMany(\App\Models\MSchoolAttributeAddon::class, 'school_id');
	}

	public function mSchoolAttributeRatings()
	{
		return $this->hasMany(\App\Models\MSchoolAttributeRating::class, 'school_id');
	}

	public function mSchoolCategoryRatings()
	{
		return $this->hasMany(\App\Models\MSchoolCategoryRating::class, 'school_id');
	}

	public function mSchoolComments()
	{
		return $this->hasMany(\App\Models\MSchoolComment::class, 'school_id')->where('status', 1);
	}

	public function mSchoolCommentRatings()
	{
		return $this->hasMany(\App\Models\MSchoolCommentRating::class, 'school_id');
	}

	public function mSchoolCourses()
	{
		return $this->hasMany(\App\Models\MSchoolCourse::class, 'school_id');
	}

	public function mSchoolImages()
	{
		return $this->hasMany(\App\Models\MSchoolImage::class, 'school_id');
	}

	public function mSchoolLanguageCourses()
	{
		return $this->hasMany(\App\Models\MSchoolLanguageCourse::class, 'school_id');
	}

	public function mSchoolPrograms()
	{
		return $this->hasMany(\App\Models\MSchoolProgram::class, 'school_id');
	}

	public function mSchoolScores()
	{
		return $this->hasMany(\App\Models\MSchoolScore::class, 'school_id');
	}

	public function mSchoolTeachers()
	{
		return $this->hasMany(\App\Models\MSchoolTeacher::class, 'school_id');
	}

	public function mSchoolTranslations()
	{
		return $this->hasMany(\App\Models\MSchoolTranslation::class, 'translation_id')->where('language_id', LaravelLocalization::getCurrentLocaleID());
	}

	public function mWishlists()
	{
		return $this->hasMany(\App\Models\MWishlist::class, 'school_id')->where('customer_id', Auth::user()->id);
    }
	//CUSTOM

    public function getRatingAttribute($filter = null)
    {
		if(!empty($filter)) {
			$data = $this->mSchoolComments()
            ->where('status', 1)
			->selectRaw('avg(rating) as aggregate, school_id')
			->where('aggregate', $filter)
            ->groupBy('school_id')->first();
		} else {
			$data = $this->mSchoolComments()
            ->where('status', 1)
            ->selectRaw('avg(rating) as aggregate, school_id')
			->groupBy('school_id')->first();
		}
		if($data) {
			return round($data->aggregate);
		} else {
			return 0;
		}
	}
	
    public function getReviewAttribute()
    {
        return $this->mSchoolComments()->count();
    }
    
}
