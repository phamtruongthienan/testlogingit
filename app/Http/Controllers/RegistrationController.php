<?php

namespace App\Http\Controllers;
use App\Model\User;
use Validator;
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
        $password = $request->password;
        $confirm = $request->confirm;
        $rules = array(
            'username' => 'required|min:5|max:15',
            'password'=> 'required|min:6|max:20',
            'confirm'=>"required|min:6|max:20|same:password"
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
                return view('login.registration',['comment'=>"Lỗi validator!"]);
        } else {
            try {
                $check = User::where('username',$username)->first();
                if($check == true) {
                    return view('login.registration',['comment'=>'Đã tồn tại tài khoản']);
                } else {
                    $user = [
                        'username' => $request->username,
                        'password' => Hash::make($request->password),
                        'raw_password' => $request->password,
                        'status'   => 1
                    ];
                    User::insert($user);
                    return view('login.registration',['comment'=>"Đăng ký thành công!"]);
                }
            } catch (\Exception $e) {
            //    return response()->json(['error' => 'There are some errors.']);
                return "exception";
            }
        } 
    }
}
