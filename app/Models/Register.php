<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Register extends Model
{
    /**
     *  ajax - 註冊帳號
     * @param string $name
     * @param string $email
     * @param string $password
     */
    static public function register($name=null, $email=null, $password=null)   
    {
        if(empty($name))
        {
            return ['code'=>'100', 'message'=>'name is empty'];
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
        $existingUserName = DB::table('users')->where('user_name', $name)->exists();
        if ($existingUserName)
        {
            return ['code' => '100', 'message' => 'Username is already taken'];
        }

        // 檢查 email 是否重複
        $existingEmail = DB::table('users')->where('email', $email)->exists();
        if ($existingEmail)
        {
            return ['code' => '100', 'message' => 'Email is already registered'];
        }

        $register_id = DB::table('users')->insertGetId([
            'user_name'=> $name,
            'email'=> $email,
            'email_verified_at' => now(),
            'password' => Hash::make($password),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at'=> now(),
        ]);

        return ['code'=>'200', 'register_id'=>$register_id];
    }
}