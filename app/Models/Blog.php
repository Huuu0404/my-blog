<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class Blog extends Model
{
    /**
     *  列表 - My world 頁面 
     */
    static public function myWorldList()
    {
        $user_name = Session::get("user_name");

        $list = DB::table('posts')
        ->where('user_name', $user_name)
        ->orderBy('updated_time', 'desc')
        ->get()->toArray();

        return $list;
    }


    /**
     *  列表 - What's new 頁面
     */
    static public function whatsNewList()
    {
        $list = DB::table('posts')
        ->orderBy('updated_time', 'desc')
        ->get()->toArray();

        return $list;
    }


    /**
     *  ajax - 建立貼文
     * @param string $content
     */
    static public function createPosts($content)   
    {
        $user_name = Session::get("user_name");
        $email = Session::get("user_email");
        
        $post_id = DB::table('posts')->insertGetId([
            'user_name'=> $user_name,
            'email'=> $email,
            'content' => $content,
            'created_time' => now(),
            'updated_time'=> now(),
        ]);

        return ['code'=>'200', 'post_id'=>$post_id];
    }


    /**
     *  ajax - 編輯貼文
     * @param int $post_id
     * @param string $content 
     */
    static public function updatePosts($post_id, $content)
    {
        if(empty($post_id))
        {
            return ['code'=> '100','message'=> 'post_id is empty'];
        }

        DB::table('posts')
        ->where('id', $post_id)
        ->update([
            'content' => $content,
            'updated_time'=> now(),
        ]);
    }


    /**
     *  ajax - 刪除貼文
     * @param int $post_id
     */
    static public function deletePosts($post_id)
    {
        if(empty($post_id))
        {
            return ['code'=> '100','message'=> 'post_id is empty'];
        }

        DB::table('posts')
        ->where('id', $post_id)
        ->delete();
    }
}