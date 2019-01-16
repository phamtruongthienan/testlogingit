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
 * Class MActivityLog
 *
 * @property int $id
 * @property string $log_name
 * @property string $description
 * @property int $subject_id
 * @property string $subject_type
 * @property int $causer_id
 * @property string $causer_type
 * @property string $properties
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class MActivityLog extends Eloquent
{
    use Searchable;
    public $asYouType = true;

    protected $table = 'm_activity_log';
    public static $snakeAttributes = false;

    protected $casts = [
        'subject_id' => 'int',
        'causer_id' => 'int'
    ];

    protected $hidden = [
        'subject_id',
        'causer_id',
        'updated_at'
    ];

    protected $fillable = [
        'log_name',
        'description',
        'subject_id',
        'subject_type',
        'causer_id',
        'causer_type',
        'properties'
    ];
}
