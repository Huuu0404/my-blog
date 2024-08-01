<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Support\Facades\Session;

class PostRepository implements PostRepositoryInterface
{
    public function whatsNewList()
    {
        $results = Post::orderBy("updated_time","desc")
        ->get()
        ->toArray();

        return $results;
    }

    
    public function myWorldList()
    {
        $user_id = Session::get("user_id");

        $results = Post::where('user_id', $user_id)
        ->orderBy('updated_time','desc')
        ->get()
        ->toArray();

        return $results;
    }


    public function createPost($content)
    {
        $user_id = Session::get('user_id');
        $user_name = Session::get('user_name');
        $email  = Session::get('user_email');

        $post = Post::create([
            'user_id' => $user_id,
            'user_name' => $user_name,
            'email' => $email,
            'content' => $content,
            'created_time' => now(),
            'updated_time' => now()
        ]);

        return ['code' => '200', 'post_id' => $post->id];
    }


    public function updatePost($post_id, $content)
    {
        if (empty($post_id))
        {
            return ['code' => '100', 'message' => 'post_id is empty'];
        }

        $post = Post::where('id', $post_id);

        if($post)
        {
            $post->update([
                'content' => $content,
                'updated_time' => now(),
            ]);
        }
    }


    public function deletePost($post_id)
    {
        if (empty($post_id))
        {
            return ['code' => '100', 'message' => 'post_id is empty'];
        }

        $post = Post::where('id', $post_id);
        
        if($post)
        {
            $post->delete();
        }
    }


    public function getUserIdByPostId($post_id)
    {
        $post = Post::find($post_id);

        if ($post) {
            return $post->user_id;
        }
    
        return "Can't find user_id"; 
    }
}
