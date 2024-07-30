<?php

namespace App\Repositories;

use App\Models\LikeAction;
use Illuminate\Support\Facades\Session;

class LikeActionRepository implements LikeActionRepositoryInterface
{
    public function createLike($post_id)
    {
        $user_id = Session::get('user_id');
        $user_name = Session::get('user_name');

        $like_action = LikeAction::create([
            'user_id' => $user_id,
            'user_name' => $user_name,
            'post_id' => $post_id,
            'created_time' => now(),
            'updated_time' => now()
        ]);

        return ['code' => '200', 'like_action_id' => $like_action->id];
    }


    public function deleteLike($post_id)
    {
        $user_id = Session::get('user_id');

        if (empty($post_id))
        {
            return ['code' => '100', 'message' => 'post_id is empty'];
        }

        $like_action = LikeAction::where('user_id', $user_id)->where('post_id', $post_id);
        
        if($like_action)
        {
            $like_action->delete();
        }
    }

    
    public function getLikeCountByPostId($post_id)
    {
        if (empty($post_id))
        {
            return ['code' => '100', 'message' => 'post_id is empty'];
        }

        $like_count = LikeAction::where('post_id', $post_id)->count();

        return $like_count;
    }


    public function isLike($post_id)
    {
        $user_id = Session::get('user_id');

        if (empty($post_id))
        {
            return ['code' => '100', 'message' => 'post_id is empty'];
        }

        $like_action_exists = LikeAction::where('user_id', $user_id)->where('post_id', $post_id)->exists();

        if($like_action_exists)
        {
            return True;
        }
        else
        {
            return False;
        }
    }
}
