<?php

namespace App\Http\Controllers;
use App\Model\User;
use Validator;
use DB;
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
                DB::beginTransaction();
                $check = User::where('username',$username)->first();
                if($check == true) {
                    return view('login.registration',['comment'=>'Đã tồn tại tài khoản']);
                } else {
                    $user_input = [
                        'username' => $request->username,
                        'password' => Hash::make($request->password),
                        'raw_password' => $request->password,
                        'status'   => 1
                    ];
                    $user = User::create($user_input);
                    if($user){
                        DB::commit();
                        $data_user = User::all();
                        return view('showuser',['infor'=>'Thêm tài khoản thành công','data'=>$data_user]);
                    } else {
                        DB::rollback();
                        return view('login.registration',['comment'=>"Lỗi validator!"]);
                    }    
                }
            } catch (\Exception $e) {
                DB::rollback();
            //    return response()->json(['error' => 'There are some errors.']);
                return "exception";
            }
        } 
    }
}
