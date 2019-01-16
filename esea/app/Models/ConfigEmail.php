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
 * Class ConfigEmail
 *
 * @property int $id
 * @property string $smtp_server
 * @property string $smtp_port
 * @property string $smtp_username
 * @property string $smtp_password
 * @property string $smtp_protocol
 * @property string $smtp_name
 * @property bool $default
 * @property bool $default_credentials
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \Illuminate\Database\Eloquent\Collection $mBookingReplies
 * @property \Illuminate\Database\Eloquent\Collection $mContactReplies
 * @property \Illuminate\Database\Eloquent\Collection $mEmails
 *
 * @package App\Models
 */
class ConfigEmail extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'config_email';
    public static $snakeAttributes = false;

    protected $casts = [
        'default' => 'bool',
        'default_credentials' => 'bool'
    ];

    protected $hidden = [
        'smtp_password',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'smtp_server',
        'smtp_port',
        'smtp_username',
        'smtp_password',
        'smtp_protocol',
        'smtp_name',
        'default',
        'default_credentials'
    ];

    public function mBookingReplies()
    {
        return $this->hasMany(\App\Models\MBookingReply::class, 'smtp_id');
    }

    public function mContactReplies()
    {
        return $this->hasMany(\App\Models\MContactReply::class, 'smtp_id');
    }

    public function mEmails()
    {
        return $this->hasMany(\App\Models\MEmail::class, 'smtp_id');
    }
}
