<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    function getUser($id=null)
    {
        if($id){
            $user = User::find($id);
        }else{
            $user = User::get();
        }

        return response()->json(['user' => $user], 200);
    }

    function getUserByEmail($email=null)
    {
        $user = User::where('email', $email)->first();
        return response()->json(['user' => $user], 200);
    }

    function createUser(Request $request)
    {
        $data = $request->all();

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->save();
        return response()->json($user->save(), 201);
    }

    function userUpdate(Request $request, $id)
    {
        $data = $request->all();
        $user = User::findOrFail($id);
        $user->name = $data['name'];
        $user->password = bcrypt($data['password']);
        
        return $user->save();
    }
}
