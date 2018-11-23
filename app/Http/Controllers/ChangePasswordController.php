<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use database\seeds\DatabaseSeeder;
use App\Model\User;
class ChangePasswordController extends Controller
{
    public function change(){
        return view('login.change');
    }
    public function submit_change(Request $request){
        
        $username = $request->username;
        $currentpassword = $request->currentpassword;
        $password = $request->password;
        $confirm = $request->confirm;
       
        $checkusername = User::where('username',$username)->first();
        if(!$checkusername){
            $_SESSION['error'] = "Tài khoản không tồn tại";
            return view('login.change');
            // return "da ton tai username";
        }
        // return $checkpassword = User::where('username',$username)->where('raw_password',$currentpassword)->first();
        $checkpassword = User::where('username',$username)->where('raw_password',$currentpassword)->first();
        if(!$checkpassword){
            $_SESSION['error'] = "Mật khẩu không đúng";
            return view('login.change');
            // return "da ton tai username";
        }
        if($password!=$confirm){
            $_SESSION['error'] = "Mật khẩu không trùng";
            return view('login.change');}
        else{
            $user = [
                'username' => $username,
                'password' => Hash::make($password),
                'raw_password' => $password,
                'status'   => 1
            ];
            User::where('username',$username)->update($user);
            return 'Sửa thành công!';
        }
    }
}
