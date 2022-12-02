<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\ApiAuthResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function register(RegisterRequest $request){
        $user = $request->register();

        return new ApiAuthResource($user);
    }

    public function login(LoginRequest $request){
        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)){
            abort(400, 'Username or Password is worng.');
        }

        return new ApiAuthResource($user);
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return response()->noContent();
    }
}
