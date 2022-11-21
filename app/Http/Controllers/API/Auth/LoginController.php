<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class LoginController extends Controller
{
    function userLogin(Request $request)
    {
        $data = $request->all();
        if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])){
            $user = User::where(['email' => $data['email']])->first();
        
            $token = $user->createToken($user->email)->accessToken;
            return $token;
        }
        
        $msg = [
            "type" => "danger",
            "msg"  => "Authentication Failed!<br>Please Check your Email/Password Combination",
            "status" => false
        ];
        return response()->json(['msg' => $msg]);
    }
}
