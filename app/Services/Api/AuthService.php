<?php

namespace App\Services\Api;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{

    public function login(array $credentials): ?array {
        $user = User::where('username', $credentials['username'])->first();

        //Check if user exists
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return null;
        }

        //Create token by device
        $token = $user->createToken($credentials['device'] . '_token');

        $result = [
            'username' => $user->username,
            'token' => $token->plainTextToken,
        ];

        return $result;
    }

    public function logout(User $user) {
        $user->currentAccessToken()->delete();
    }

}