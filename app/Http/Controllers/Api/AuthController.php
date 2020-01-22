<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $role=[
            'name'=>'required|min:5',
            'email'=>'required|unique:users|email',
            'password'=>'required|min:6|confirmed'
        ];

        $validated=Validator::make($request->all(),$role);

        if ($validated->fails()){
            return response()->json(['errors'=>$validated->errors()],422);
        }


        $information=$request->all();
        $information['password']=Hash::make($information['password']);

        $user=User::create($information);

        $success['token']=$user->createToken('Laravel')->accessToken;
        $success['name']=$user->name;

        return response()->json(['success'=>$success],200);
    }

    public function login(Request $request)
    {
        $role=[
            'email'=>'required|email',
            'password'=>'required|min:6'
            ];
        $validated=Validator::make($request->all(),$role);

        if ($validated->fails()){
            return response()->json(['errors'=>$validated->errors()],422);
        }

        if (Auth::attempt(['email'=>$request->input('email'),'password'=>$request->input('password')]))
        {
            $user=Auth::user();
            $success['token']=$user->createToken('Laravel')->accessToken;

            return response()->json(['success'=>$success],200);
        }else{
            return response()->json(['error'=>'چنین کاربری وجود ندارد'],404);
        }
    }
}
