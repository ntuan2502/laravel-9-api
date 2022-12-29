<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed'], //password_confirmation
        ]);

        if ($validator->fails()) return response()->json($validator->errors());

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        $token = $user->createToken('auth_token');
        return response()->json(
            [
                'data' => $user,
                'access_token' => $token->plainTextToken,
                'token_type' => 'Bearer',
            ]
        );
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token');
        return response()->json(
            [
                'message' => 'Chào ' . $user->name . '! Chúc an lành',
                'access_token' => $token->plainTextToken,
                'token_type' => 'Bearer',
            ]
        );
    }
    public function logout()
    {
        // Revoke all tokens...
        // Auth::user()->tokens()->delete();

        // Revoke the token that was used to authenticate the current request...
        Auth::user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Bạn đã thoát ứng dụng và token đã xóa']);
    }
}
