<?php

/**
 * Created by ARIS
 * Date: Wed, 28 Nov 2018 03:52:46 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Laravel\Scout\Searchable;

/**
 * Class MSchoolCommentReply
 * 
 * @property int $id
 * @property int $comment_id
 * @property string $content
 * @property int $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\MSchoolComment $mSchoolComment
 *
 * @package App\Models
 */
class MSchoolCommentReply extends Eloquent
{
    use Searchable;
    public $asYouType = true;

	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'm_school_comment_reply';
	public static $snakeAttributes = false;

	protected $casts = [
		'comment_id' => 'int',
		'status' => 'int'
	];

	protected $hidden = [
		'comment_id',
		'created_at',
		'updated_at',
		'deleted_at'
	];

	protected $fillable = [
		'comment_id',
		'content',
		'status'
	];

	public function mSchoolComment()
	{
		return $this->belongsTo(\App\Models\MSchoolComment::class, 'comment_id');
	}
}
