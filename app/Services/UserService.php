<?php

namespace App\Services;

use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function register($user_name=null, $email=null, $password=null)
    {
        if(empty($user_name))
        {
            return ['code'=>'100', 'message'=>'user_name is empty'];
        }

        if(empty($email))
        {
            return ['code'=>'100', 'message'=>'email is empty'];
        }

        if(empty($password))
        {
            return ['code'=>'100', 'message'=>'password is empty'];
        }

        // 檢查 user_name 是否重複
        if ($this->userRepository->checkUserName($user_name))
        {
            return ['code' => '100', 'message' => 'Username is already taken'];
        }

        // 檢查 email 是否重複
        if ($this->userRepository->checkEmail($email))
        {
            return ['code' => '100', 'message' => 'Email is already registered'];
        }

        // 新建用戶
        $user = $this->userRepository->createUser($user_name, $email, $password);

        return ['code'=>'200', 'register_user_id'=>$user->id];
    }


    public function login($email, $password)
    {
        $user = $this->userRepository->getUserByEmail($email);

        if (!$user)
        {
            return ['error_message' => 'Email not found'];
        }

        if (!Hash::check($password, $user->password))
        {
            return ['error_message' => 'Incorrect password'];
        }

        Session::put('user_id', $user->id);
        Session::put('user_name', $user->user_name);
        Session::put('user_email', $user->email);

        return [
            'user_id' => Session::get('user_id'),
            'user_name' => Session::get('user_name'),
            'user_email' => Session::get('user_email'),
        ];
    }
}