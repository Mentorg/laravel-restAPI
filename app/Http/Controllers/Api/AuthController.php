<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * Create a new user
     *
     * @param array $data
     */
    public function register(CreateUserRequest $request)
    {
        $fields = $request->validated();

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);

        $token = $user->createToken('mytoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);
    }

    /**
     * Authenticate user
     *
     * @param Request $request
     * @return Response
     */
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => "required|string",
            'password' => "required|string",
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => "Bad credentials!",
            ], 401);
        }

        $token = $user->createToken('mytoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
            'message' => "You are logged in."
        ];

        return response($response, 201);
    }

    /**
     * Destroy authenticated user's token
     *
     * @return string[]
     */
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => "Logged out."
        ];
    }
}
