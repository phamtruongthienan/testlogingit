<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class decentralizationModel extends Model
{
    protected $table = "decentralization";
    protected $fillable = [
        'id_user', 'id_role'
    ];
    //
    
}
