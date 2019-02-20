<?php

/**
 * Created by quan.vh.
 * Date: Fri, 09 Nov 2018 02:19:02 +0000.
 */

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Reliese\Database\Eloquent\Model as Eloquent;
use \Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Laravel\Scout\Searchable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MUser
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $name
 * @property \Carbon\Carbon $dob
 * @property string $phone
 * @property int $locked
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \Illuminate\Database\Eloquent\Collection $m_booking_replies
 * @property \Illuminate\Database\Eloquent\Collection $m_contact_replies
 * @property \Illuminate\Database\Eloquent\Collection $role_users
 *
 * @package App\Models
 */
class MUser extends Authenticatable
{
    use Notifiable;
    use SoftDeletes, EntrustUserTrait {
        SoftDeletes::restore insteadof EntrustUserTrait;
        EntrustUserTrait::restore insteadof SoftDeletes;
    }
    // use Searchable;

    public $asYouType = true;

    public function toSearchableArray()
    {
        $array = $this->toArray();
        return $array;
    }

    protected $table = 'm_users';

    protected $casts = [
        'locked' => 'int',
        'phone' => 'string'
    ];

    protected $dates = [
        'dob'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $fillable = [
        'email',
        'password',
        'name',
        'dob',
        'phone',
        'locked',
        'remember_token'
    ];

    public function m_booking_replies()
    {
        return $this->hasMany(\App\Models\MBookingReply::class, 'user_id');
    }

    public function m_contact_replies()
    {
        return $this->hasMany(\App\Models\MContactReply::class, 'user_id');
    }

    public function role_users()
    {
        return $this->hasMany(\App\Models\RoleUser::class, 'user_id');
    }
}
