<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     *  登入頁面
     */
    public function loginIndex(Request $request)
    {
        try
        {
            
        }
        catch(\Exception $e)
        {
            return $e->getMessage();
        }
        $view_data['error_message'] = '';

        return view("login", $view_data);
    }


    /**
     * ajax - 登入驗證
     */
    public function login(Request $request)
    {
        try
        {
            $credentials = $request->only('email', 'password');

            $user = User::where('email', $credentials['email'])->first();

            if(!$user)
            {
                $view_data['error_message'] = 'Email not found';
                return view('login', $view_data);
            }

            if (!Hash::check($credentials['password'], $user->password))
            {
                $view_data['error_message'] = 'Incorrect password';
                return view('login', $view_data);
            }

            Session::put('user_id', $user->id);
            Session::put('user_name', $user->user_name);
            Session::put('user_email', $user->email);
        }
        catch(\Exception $e)
        {
            return $e->getMessage();
        }

        return redirect('/whats_new');
    }

}
