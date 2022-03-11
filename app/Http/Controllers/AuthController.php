<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        //
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
            'role' => 'required|integer',
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'role' => $fields['role'],
        ]);   

        $token = $user->createToken($request->userAgent(),[$fields['role']])->plainTextToken;
        
        $reponse = [
            'user' => $user,
            'token' => $token,
        ];

        return response($reponse,201);
    }
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        
        // check email
        $user = User::where('email', $fields['email'])->first();
       
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Invalid Login',
            ], 401);
        } else {
            //ลบ Token เก่าออกก่อน แล้วค่อยสร้างใหม่ 
            $user->tokens()->delete();
            $token = $user->createToken($request->userAgent(), ["$user->role"])->plainTextToken;
        }
        
        $reponse = [
            'user' => $user,
            'token' => $token,
        ];

        return response($reponse,200);
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();

        return response([
            'message' => 'Loged Out',
        ], 200);
    }

}