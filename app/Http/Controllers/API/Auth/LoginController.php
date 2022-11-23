<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function userLogin(Request $request)
    {
        $data = $request->all();

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'is_active' => 1])) {
            $user = User::where(['email' => $data['email']])->first();
        
            $access_token = $user->createToken($user->email)->accessToken;
            User::where(['email' => $data['email']])->update(['access_token' => $access_token]);
            return response()->json(['access_token' => $access_token, "email" => $user->email]);
        }
        
        return response()->json(['status' => false]);
    }

    function userLogout(Request $request)
    {
        $data = $request->all();
        
        $userUpdate = User::where(['email' => $data['email']])
                        ->where(['access_token' => $data['access_token']])
                        ->update(['access_token' => '']);

        if($userUpdate){
            return response()->json(['status' => true]);
        }
        
        return response()->json(['status' => false]);
    }
}