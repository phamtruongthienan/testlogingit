<?php

namespace App\Http\Controllers;
use App\Model\User;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
  public function login(){
    return view('login.login');
  }
  public function submit_login(Request $request){
    $rules = [
      'username' => 'required|min:5|max:15',
      'password' => 'required|min:6|max:20'
    ];
    $validator = Validator::make($request->all(),$rules);
    if($validator->fails()){
      return view('login.login',['comment'=>$validator->errors()->first()]);
    }else{
      try{
        $username = $request->username;
        $pass = $request->password;
          if(Auth::attempt(['username' => $username, 'password' => $pass])){
            return view('wrapper');
          }else{
            return view('login.login',['comment'=>"Sai thông tin đăng nhập"]);
          };
      }catch(\Exception $ex){
        return view('login.login',['comment'=>"exception"]);
      }
    }
  }
}
