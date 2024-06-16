<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Services\UserService;

class RegisterController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     *  註冊頁面
     */
    public function registerIndex(Request $request)
    {
        try
        {
            
        }
        catch(\Exception $e)
        {
            return $e->getMessage();
        }

        return view("register");
    }


    /**
     *  ajax - 註冊帳號
     */
    public function register(Request $request)
    {
        try
        {
            $user_name = $request->input("name");
            $email = $request->input("email");
            $password = $request->input("password");

            $results = $this->userService->register($user_name, $email, $password);
        }
        catch(\Exception $e)
        {
            return ['code'=>'100', 'message'=>$e->getMessage()];
        }

        return $results;
    }
}
