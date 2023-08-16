<?php

namespace App\Services\Auth;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class LoginService
{

    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function login($request)
    {
        $data = $this->user->where('email', $request['email'])->first();

        if (!$data || !Hash::check($request['password'], $data->password)) {
            return response()->json([
                'title' => 'Atenção!',
                'message' => 'E-mail ou senha incorretos.',
                'type' => 'error',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $token = $data->createToken('auth_token');

        return response()->json([
            // 'user_id' => $data->id,
            'token' => $token->plainTextToken
        ], Response::HTTP_OK);
    }

    public function logout($request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Loggout']);
    }
}
