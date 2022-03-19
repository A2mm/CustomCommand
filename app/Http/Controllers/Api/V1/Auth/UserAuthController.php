<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Api\V1\Auth\LoginApiRequest;

class UserAuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $data['password'] = bcrypt($request->password);

        $user = User::create($data);
        $token = $user->createToken('API Token')->accessToken;
        return response([ 'user' => $user, 'token' => $token]);
    }

    public function login(LoginApiRequest $request)
    {
        $data = $request->only('email', 'password');
        if (!auth()->attempt($data)) {
            return response()->json([
                'error_message' => 'Incorrect Details. Please try again',
                'status_code'   => 400,
            ], 400);
        }

        $token = auth()->user()->createToken('API Token')->accessToken;
        return response()->json([
            'user'          => auth()->user(), 
            'token'         => $token, 
            'status_code'   => 200,
        ], 200);

    }
}
