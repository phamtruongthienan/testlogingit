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
 * Class MGroupEmail
 *
 * @property int $id
 * @property string $name
 * @property int $group
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \Illuminate\Database\Eloquent\Collection $mEmails
 * @property \Illuminate\Database\Eloquent\Collection $mGroupEmailUsers
 *
 * @package App\Models
 */
class MGroupEmail extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    protected $table = 'm_group_email';
    public static $snakeAttributes = false;

    protected $casts = [
        'group' => 'int'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'name',
        'group'
    ];

    public function mEmails()
    {
        return $this->hasMany(\App\Models\MEmail::class, 'group_id');
    }

    public function mGroupEmailUsers()
    {
        return $this->hasMany(\App\Models\MGroupEmailUser::class, 'group_id');
    }
}
