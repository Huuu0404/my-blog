<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRepository implements UserRepositoryInterface
{
    public function checkUserName($user_name)
    {
        return User::where('user_name', $user_name)->exists();
    }


    public function checkEmail($email)
    {
        return User::where('email', $email)->exists();
    }


    public function createUser($user_name, $email, $password)
    {
        $user = User::create([
            'user_name'=> $user_name,
            'email'=> $email,
            'email_verified_at' => now(),
            'password' => Hash::make($password),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at'=> now(),
        ]);

        return $user;
    }


    public function getUserByEmail($email)
    {
        $user = User::where('email', $email)->first();

        return $user;
    }
}
