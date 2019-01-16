<?php

/**
 * Created by ARIS
 * Date: Fri, 30 Nov 2018 07:04:27 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Laravel\Scout\Searchable;

/**
 * Class MSchoolScore
 * 
 * @property int $id
 * @property int $score
 * @property int $school_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\MSchool $mSchool
 *
 * @package App\Models
 */
class MSchoolScore extends Eloquent
{
    use Searchable;
    public $asYouType = true;

	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'm_school_score';
	public static $snakeAttributes = false;

	protected $casts = [
		'score' => 'int',
		'school_id' => 'int'
	];

	protected $hidden = [
		'school_id',
		'created_at',
		'updated_at',
		'deleted_at'
	];

	protected $fillable = [
		'score',
		'school_id'
	];

	public function mSchool()
	{
		return $this->belongsTo(\App\Models\MSchool::class, 'school_id');
	}
}
