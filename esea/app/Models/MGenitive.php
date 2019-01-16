<?php

/**
 * Created by ARIS
 * Date: Tue, 18 Dec 2018 02:50:13 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Laravel\Scout\Searchable;

/**
 * Class MGenitive
 * 
 * @property string $id
 * @property string $genitive
 *
 * @package App\Models
 */
class MGenitive extends Eloquent
{
    use Searchable;
    public $asYouType = true;

	protected $table = 'web_esearch.m_genitive';
	public $incrementing = false;
	public $timestamps = false;
	public static $snakeAttributes = false;

	protected $fillable = [
		'genitive'
	];
}
