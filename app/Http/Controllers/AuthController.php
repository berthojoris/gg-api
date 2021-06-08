<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function userActive(Request $request)
    {
        return auth()->user();
    }

    public function register(RegisterRequest $request) {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken(config('app.token_name'))->plainTextToken;

        $response = [
            'data' => $user,
            'token' => $token,
            'message' => "Register Success"
        ];

        return response()->json($response);
    }

    public function login(LoginRequest $request) {

        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'data' => null,
                'token' => null,
                'message' => 'Bad credentials'
            ], 401);
        }

        $token = $user->createToken(config('app.token_name'))->plainTextToken;

        $response = [
            'data' => $user,
            'token' => $token,
            'message' => 'Login success'
        ];

        return response()->json($response);
    }

    public function logout(Request $request) {

        auth()->user()->tokens()->delete();

        return [
            'data' => null,
            'token' => null,
            'message' => 'Logout success'
        ];
    }
}
