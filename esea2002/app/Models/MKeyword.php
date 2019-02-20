<?php

/**
 * Created by ARIS
 * Date: Thu, 17 Jan 2019 10:31:31 +0700.
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
 * @property \Illuminate\Database\Eloquent\Collection $mKeywordTranslations
 *
 * @package App\Models
 */
class MKeyword extends Eloquent
{
    use Searchable;
    public $asYouType = true;

	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'web_esearch.m_keyword';
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

	public function mKeywordTranslations()
	{
		return $this->hasMany(\App\Models\MKeywordTranslation::class, 'translation_id')->where('language_id', LaravelLocalization::getCurrentLocaleID());
	}
	
	public function mKeywordTranslationsAll()
	{
		return $this->hasMany(\App\Models\MKeywordTranslation::class, 'translation_id');
	}
}
