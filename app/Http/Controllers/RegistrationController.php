<?php

namespace App\Http\Controllers;
use App\Model\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use database\seeds\DatabaseSeeder;
class RegistrationController extends Controller
{
    public function regis(){
        return view('login.registration');
    }
    public function relationship(){
        // return User::where('id','>=',1)
        // ->where('username','admin')
        // ->get();
        // return User::with('decentralization')->get();
    }
    public function submit_regis(Request $request){
        
        $username = $request->username;
        $check = User::where('username',$username)->first();
        if($check){
            return "da ton tai username";
        }else{
            $user = [
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'raw_password' => $request->password,
                'status'   => 1
            ];

            User::insert($user);
            return 'them thanh cong!';
        }
        
    }
}
