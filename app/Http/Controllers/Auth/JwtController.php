<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JwtController extends Controller
{
    public function login(Request $request) {
        $credentials = $request->all(['email', 'password']);

        Validator::make($credentials, [
            'email' => 'required|string',
            'password' => 'required|string'
        ])->validate();

        $token = auth('api')->attempt($credentials);

        if (!$token) {
            return response()->json(['Email or password does not match'], 401);
        }

        return response()->json(['data' => $token], 200);
    }


    public function logout() {
        auth('api')->logout();

        return response()->json(['data' => 'until next time'], 200);
    }


    public function refreshToken() {
        $newToken = auth('api')->refresh();

        return response()->json(['data' => $newToken], 200);
    }
}
