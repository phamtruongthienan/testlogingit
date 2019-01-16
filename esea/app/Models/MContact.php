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
 * Class MContact
 *
 * @property int $id
 * @property string $email
 * @property int $type
 * @property string $title
 * @property string $content
 * @property string $browser
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \Illuminate\Database\Eloquent\Collection $mContactReplies
 *
 * @package App\Models
 */
class MContact extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'm_contact';
    public static $snakeAttributes = false;

    protected $casts = [
        'type' => 'int'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'email',
        'type',
        'title',
        'content',
        'browser'
    ];

    public function mContactReplies()
    {
        return $this->hasMany(\App\Models\MContactReply::class, 'contact_id');
    }
}
