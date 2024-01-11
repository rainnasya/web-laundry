<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function response($user)
    {
        $token = $user->createToken( str()->random(40) )->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4',
        ]);

        $user = User::create([
            'username' => ucwords($request->username),
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'level' => 'Pelanggan',
        ]);

        return $this->response($user);
    }

    public function login(Request $request)
    {
        $scred = $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:4',
        ]);

        if (!Auth::attempt($scred)) {
            return response()->json([
                'message' => 'Unauthorized.'
            ], 401);
        }
        return $this->response(Auth::user());
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response()->json([
            'message'=>'Anda Berhasil Keluar'
        ]);
    }
}
