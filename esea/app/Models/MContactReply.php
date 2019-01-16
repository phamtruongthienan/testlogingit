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
 * Class MContactReply
 *
 * @property int $id
 * @property int $contact_id
 * @property int $user_id
 * @property int $smtp_id
 * @property string $content
 * @property int $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \App\Models\MContact $mContact
 * @property \App\Models\ConfigEmail $configEmail
 * @property \App\Models\MUser $mUser
 *
 * @package App\Models
 */
class MContactReply extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'm_contact_reply';
    public static $snakeAttributes = false;

    protected $casts = [
        'contact_id' => 'int',
        'user_id' => 'int',
        'smtp_id' => 'int',
        'status' => 'int'
    ];

    protected $hidden = [
        'contact_id',
        'user_id',
        'smtp_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'contact_id',
        'user_id',
        'smtp_id',
        'content',
        'status'
    ];

    public function mContact()
    {
        return $this->belongsTo(\App\Models\MContact::class, 'contact_id');
    }

    public function configEmail()
    {
        return $this->belongsTo(\App\Models\ConfigEmail::class, 'smtp_id');
    }

    public function mUser()
    {
        return $this->belongsTo(\App\Models\MUser::class, 'user_id');
    }
}
