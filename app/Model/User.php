<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends  Authenticatable
{
    //
    protected $table = "users";
    protected $fillable = [
        'id', 'username','password','raw_password','status'
    ];
    public function decentralization(){
        return $this->hasOne('App\Model\decentralizationModel','id_user');
    }
    public function relationship(){
        return User::where('id','>=',1)
        ->where('username','admin')
        ->get();
        // return User::with('decentralization')->get();
    }
}
