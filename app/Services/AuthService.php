<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function register(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return [
            'token' => $user->createToken('api-token')->plainTextToken
        ];
    }

    public function login(array $data)
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages(['email' => 'Invalid credentials']);
        }

        return [
            'token' => $user->createToken('api-token')->plainTextToken
        ];
    }

    public function logout($user)
    {
        $user->tokens()->delete();
        return ['message' => 'Logged out'];
    }
}
