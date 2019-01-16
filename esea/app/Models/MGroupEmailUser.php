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
 * Class MGroupEmailUser
 *
 * @property int $id
 * @property int $group_id
 * @property string $email
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \App\Models\MGroupEmail $mGroupEmail
 *
 * @package App\Models
 */
class MGroupEmailUser extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    protected $table = 'm_group_email_user';
    public static $snakeAttributes = false;

    protected $casts = [
        'group_id' => 'int'
    ];

    protected $hidden = [
        'group_id',
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'group_id',
        'email'
    ];

    public function mGroupEmail()
    {
        return $this->belongsTo(\App\Models\MGroupEmail::class, 'group_id');
    }
}
