<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Register;

class RegisterController extends Controller
{
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
            $name = $request->input("name");
            $email = $request->input("email");
            $password = $request->input("password");

            $results = Register::register($name, $email, $password);
        }
        catch(\Exception $e)
        {
            return ['code'=>'100', 'message'=>$e->getMessage()];
        }

        return $results;
    }
}
