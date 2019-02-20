<?php

/**
 * Created by ARIS
 * Date: Wed, 09 Jan 2019 05:41:30 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Laravel\Scout\Searchable;

/**
 * Class MKeywordSearch
 * 
 * @property int $id
 * @property string $keyword
 * @property int $language_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\ConfigLanguage $configLanguage
 *
 * @package App\Models
 */
class MKeywordSearch extends Eloquent
{
    use Searchable;
    public $asYouType = true;

	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'web_esearch.m_keyword_search';
	public static $snakeAttributes = false;

	protected $casts = [
		'language_id' => 'int'
	];

	protected $hidden = [
		'language_id',
		'created_at',
		'updated_at',
		'deleted_at'
	];

	protected $fillable = [
		'keyword',
		'language_id'
	];

	public function configLanguage()
	{
		return $this->belongsTo(\App\Models\ConfigLanguage::class, 'language_id');
	}
}
