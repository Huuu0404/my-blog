<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    /**
     * ajax - 登出
     */
    public function logout(Request $request)
    {
        try
        {
            Session::flush();
        }
        catch(\Exception $e)
        {
            return $e->getMessage();
        }

        return redirect('/login')->with('success', 'You have been logged out successfully.');
    }

}
