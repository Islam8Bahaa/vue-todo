<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        if (!auth()->attempt($data)){
            return response()->json([
                'success' => false,
                'error' => 'wrong credential',
                'token' => '',
                'user' => [],
            ]);
        }
        return response()->json([
            'success' => true,
            'error' => '',
            'token' => '',
            'user' => auth()->user(),
        ]);
    }

    public function logout(Request $request)
    {
        auth('web')->logout();
        session()->regenerate(true);
        return 'logout';
    }

    public function me(Request $request)
    {
        return $request->user();
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());
        auth('web')->login($user);
        return $user;
    }


}
