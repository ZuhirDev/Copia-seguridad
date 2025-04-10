<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        return response()->json([
            "status" => true,
            "message" => "User created successfully",
            "data" => $user,
        ], 201);
    }

    public function login(Request $request) //LoginRequest
    {
        // dd($request->only(['email', 'password']));
        $token = JWTAuth::attempt($request->only(['email', 'password']));

        if(!$token){
            return response()->json([
                "status" => false,
                "message" => "The provided credentials are incorrect.",
            ], 401);
        }

        $user = JWTAuth::user();

        if($user->google2fa_secret){
            return response()->json([
                'status' => 403,
                'message' => '2FA required',
                "token" => $token,
                'user' => $user,
            ]);
        }

        return response()->json([
            "message" => 'Login successfull',
            "user" => $user,
            "token" => $token,
        ], 200);
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        User::find(Auth::user()->id)->update([
            'google2fa_enabled' => false,
        ]);

        return response()->json([
            "message" => 'Logged out successfully',
        ], 200);
    }

    public function me()
    {
        $user = JWTAuth::user();

        return response()->json([
            "user" => $user,
        ], 200);
    }
}
