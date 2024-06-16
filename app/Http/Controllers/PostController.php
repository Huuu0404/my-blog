<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PostService;


class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     *  Whats new! 頁面
     */
    public function whatsNew(Request $request)
    {
        try
        {
            $list = $this->postService->whatsNewList();
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
            $list = $this->postService->myWorldList();
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
    public function createPost(Request $request)
    {
        try
        {
            $content = $request->input("content");

            $post_id = $this->postService->createPost($content);
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
    public function updatePost(Request $request)
    {
        try
        {
            $post_id = (int) $request->input("post_id");
            $content = $request->input("content");

            $this->postService->updatePost($post_id, $content);
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
    public function deletePost(Request $request)
    {
        try
        {
            $post_id = (int) $request->input("post_id");

            $this->postService->deletePost($post_id);
        }
        catch(\Exception $e)
        {
            return ['code'=>'100', 'message'=>$e->getMessage()];
        }

        return ['code'=> '200','message'=> 'Delete successfully'];
    }
}
