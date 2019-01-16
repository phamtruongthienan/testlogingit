<?php

/**
 * Created by ARIS
 * Date: Wed, 28 Nov 2018 03:52:20 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Laravel\Scout\Searchable;

/**
 * Class MRating
 * 
 * @property int $id
 * @property string $rating
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $mRatingTranslations
 *
 * @package App\Models
 */
class MRating extends Eloquent
{
    use Searchable;
    public $asYouType = true;

	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'm_rating';
	public static $snakeAttributes = false;

	protected $hidden = [
		'created_at',
		'updated_at',
		'deleted_at'
	];

	protected $fillable = [
		'rating'
	];

	public function mRatingTranslations()
	{
		return $this->hasMany(\App\Models\MRatingTranslation::class, 'translation_id')->where('language_id', LaravelLocalization::getCurrentLocaleID());
	}
}
