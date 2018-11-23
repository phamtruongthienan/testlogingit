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
        $data = User::select()->get();
        // return var_dump($data);
        return view('edituser',['data'=>$data]);
    }
    public function editusers(Request $request){
        
        $id = $request->id;
        $value = $request->value;
        $password= "123456";
        //  echo ($value.$id);     
        $user = [
            'username' => $value
        ];
        $data = User::where('id',$id)->update($user);
        // return var_dump($data);
        return "thành công";
    }
    
}
