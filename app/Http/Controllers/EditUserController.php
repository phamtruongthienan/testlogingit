<?php

namespace App\Http\Controllers;
use App\Model\User;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use database\seeds\DatabaseSeeder;
use Illuminate\Http\Request;

class EditUserController extends Controller
{
    public function edituser(){
        $data = User::select()->where('status',1)->get();
        // return var_dump($data);
        return view('edituser',['data'=>$data]);
    }
    public function editusers(Request $request){
        $id = $request->id;
        if(isset($request->valueUser))
        {
            $rules = [
                'valueUser' => 'required|min:5|max:15'
            ];
            $validator = Validator::make($request->all(),$rules);
            // return var_dump($validator);
            if($validator->fails()){
                return response()->json(['comment'=>"lỗi validation ".$validator->errors()->first()]);
            }
            else{
                try{
                    $check = User::where('username',$request->valueUser)->first();
                    if($check)
                        return response()->json(['comment' => 'User đã tồn tại']);
                    $user = [
                        'username' => $request->valueUser
                    ];
                    $data = User::where('id',$id)->update($user);
                    if($data){
                        return response()->json(['comment' => 'sửa user thành công']);
                        // return view('wrapper');
                    }else{
                        return response()->json(['comment' => 'sửa user không thành công']);
                    };
                }catch(\Exception $ex){
                    return response()->json(['comment' => 'exception user']);
                }
            }
        }
        else if(isset($request->valuePass)){
            $rules = [
                'valuePass' => 'required|min:6|max:20'
            ];
            $validator = Validator::make($request->all(),$rules);
            // return var_dump($validator);
            if($validator->fails()){
                return response()->json(['comment'=>"lỗi validation ".$validator->errors()->first()]);
            }else{
                try{
                    $user = [
                        'password' => Hash::make($request->valuePass),
                       'raw_password' => $request->valuePass
                    ];
                    $data = User::where('id',$id)->update($user);
                    if($data){
                        return response()->json(['comment' => 'sửa password thành công']);
                        // return view('wrapper');
                    }else{
                        return response()->json(['comment' => 'sửa password không thành công']);
                    };
                }catch(\Exception $ex){
                    return response()->json(['comment' => 'exception password']);
                }
            }
        }
        else{          
            try{
                $data = User::where('id',$id)->delete();
                if($data){
                    return response()->json(['comment' => 'xóa thành công']);
                    // return view('wrapper');
                }else{
                    return response()->json(['comment' => 'xóa không thành công']);
                };
            }catch(\Exception $ex){
                return response()->json(['comment' => 'exception password']);
            }
        }
    }
    
}
