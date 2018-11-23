<?php

namespace App\Http\Controllers;
use App\Model\User;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ShowUserController extends Controller
{
    public function show(){
        return view('showuser');
    }
    public function showuser(){
        $data = User::select()->get();
        // return var_dump($data);
        return view('showuser',['data'=>$data]);

    }
}
