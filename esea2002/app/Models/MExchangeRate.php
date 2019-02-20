<?php

/**
 * Created by ARIS
 * Date: Thu, 27 Dec 2018 02:44:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Laravel\Scout\Searchable;

/**
 * Class MExchangeRate
 * 
 * @property int $id
 * @property int $language_id
 * @property string $rate
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\ConfigLanguage $configLanguage
 *
 * @package App\Models
 */
class MExchangeRate extends Eloquent
{
    use Searchable;
    public $asYouType = true;

	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'web_esearch.m_exchange_rate';
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
		'language_id',
		'rate'
	];

	public function configLanguage()
	{
		return $this->belongsTo(\App\Models\ConfigLanguage::class, 'language_id');
	}
}
