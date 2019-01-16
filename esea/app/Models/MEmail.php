<?php

/**
 * Created by ARIS
 * Date: Fri, 09 Nov 2018 06:47:39 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Laravel\Scout\Searchable;

/**
 * Class MEmail
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $email
 * @property int $status
 * @property int $group_id
 * @property int $smtp_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \App\Models\MGroupEmail $mGroupEmail
 * @property \App\Models\ConfigEmail $configEmail
 *
 * @package App\Models
 */
class MEmail extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'm_email';
    public static $snakeAttributes = false;

    protected $casts = [
        'status' => 'int',
        'group_id' => 'int',
        'smtp_id' => 'int'
    ];

    protected $hidden = [
        'group_id',
        'smtp_id',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'title',
        'content',
        'email',
        'status',
        'group_id',
        'smtp_id'
    ];

    public function mGroupEmail()
    {
        return $this->belongsTo(\App\Models\MGroupEmail::class, 'group_id');
    }

    public function configEmail()
    {
        return $this->belongsTo(\App\Models\ConfigEmail::class, 'smtp_id');
    }
}
