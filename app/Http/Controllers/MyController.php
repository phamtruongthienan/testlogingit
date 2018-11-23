<?php

namespace App\Http\Controllers;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MyController extends Controller
{
    //
    public function relationship(){
        // return User::where('id','>=',1)
        // ->where('username','admin')
        // ->get();
        return User::with('decentralization')->get();
    }
    public function login(){
        return view('login.login');
    }
    public function submit_login(Request $request){
        $username = $request->username;
        $password = $request->password;
          if(Auth::attempt(['username' => $username, 'password' => $password])){
            return view('wrapper');
          }else{
              return "Tai khoan khong chinh xac!";
          };
        
    }
    public function logout(){
        Auth::logout();
    }

    public function redirect($id){
        try{
            $user = User::where('id',$id)->first();
            if($user){
                return view('view_demo',['b'=>$user]);
            }else{
               
            }
            
        }catch(\Exception $ex){
            return "Xay ra loi trong qua trinh xu ly";
        }
       
    }
}
