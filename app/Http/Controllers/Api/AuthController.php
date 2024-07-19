<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Login using the specified resource.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @return array
     */
    public function login(UserRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $response = [
            'user'  => $user,
            'token' => $user->createToken($request->email)->plainTextToken,
        ];

        return $response;
    }

 
    public function logout(UserRequest $request)
    {
        // Revoke the token that was used to authenticate the current request
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out nimo nisuccessfully'], 200);
    }

    //sir code
    // public function logout(Request $request)
    // {
    //     // Revoke the token that was used to authenticate the current request
    //     $request->user()->tokens()->delete();

    //     $response = [
    //         'message' => 'logout'
    //     ];

    //     return $response;
    // }
}

