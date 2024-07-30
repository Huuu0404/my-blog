<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use App\Services\UserService;

class LoginController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

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
            $email = $request->input("email");
            $password = $request->input("password");

            $login_results = $this->userService->login($email, $password);
            if(isset($login_results['error_message']))
            {
                return $login_results['error_message'];
            }
        }
        catch(\Exception $e)
        {
            return $e->getMessage();
        }

        return redirect('/whats_new');
    }

}
