<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Blog;


class BlogController extends Controller
{
    /**
     *  Whats new! 頁面
     */
    public function whatsNew(Request $request)
    {
        try
        {
            $list = Blog::whatsNewList();
        }
        catch(\Exception $e)
        {
            return $e->getMessage();
        }

        $view_data['list'] = $list;

        return view("whats_new", $view_data);
    }


    /**
     *  My World 頁面
     */
    public function myWorld(Request $request)
    {
        try
        {
            $list = Blog::myWorldList();
        }
        catch(\Exception $e)
        {
            return $e->getMessage();
        }

        $view_data['list'] = $list;

        return view("my_world", $view_data);
    }


    /**
     *  ajax - 建立貼文
     */
    public function createPosts(Request $request)
    {
        try
        {
            $content = $request->input("content");

            $post_id = Blog::createPosts($content);
        }
        catch(\Exception $e)
        {
            return ['code'=>'100', 'message'=>$e->getMessage()];
        }

        return ['code'=> '200','post_id'=> $post_id];
    }


    /**
     *  ajax - 編輯貼文
     */
    public function updatePosts(Request $request)
    {
        try
        {
            $post_id = (int) $request->input("post_id");
            $content = $request->input("content");

            Blog::updatePosts($post_id, $content);
        }
        catch(\Exception $e)
        {
            return ['code'=>'100', 'message'=>$e->getMessage()];
        }

        return ['code'=> '200','message'=> 'Update successfully'];
    }


    /**
     *  ajax - 刪除貼文
     */
    public function deletePosts(Request $request)
    {
        try
        {
            $post_id = (int) $request->input("post_id");

            Blog::deletePosts($post_id);
        }
        catch(\Exception $e)
        {
            return ['code'=>'100', 'message'=>$e->getMessage()];
        }

        return ['code'=> '200','message'=> 'Delete successfully'];
    }
}
