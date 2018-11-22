<?php

namespace App\Http\Controllers;
use App\Model\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(){
        return view('login.login');
    }
    public function submit_login(Request $request){
        $username = $request->username;
        $pass = $request->password;
          if(Auth::attempt(['username' => $username, 'password' => $pass])){
            return view('wrapper');
          }else{
              return "Tai khoan khong chinh xac!";
          };
        
    }
}
