<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LikeActionService;


class LikeActionController extends Controller
{
    protected $LikeActionService;

    public function __construct(LikeActionService $LikeActionService)
    {
        $this->LikeActionService = $LikeActionService;
    }


    /**
     *  ajax - 按愛心
     */
    public function createLike(Request $request)
    {
        try
        {
            $post_id = $request->input("post_id");

            $like_action_id = $this->LikeActionService->createLike($post_id);
        }
        catch(\Exception $e)
        {
            return ['code'=>'100', 'message'=>$e->getMessage()];
        }

        return ['code'=> '200','like_action_id'=> $like_action_id];
    }


    /**
     *  ajax - 收回愛心
     */
    public function deleteLike(Request $request)
    {
        try
        {
            $post_id = (int) $request->input("post_id");

            $this->LikeActionService->deleteLike($post_id);
        }
        catch(\Exception $e)
        {
            return ['code'=>'100', 'message'=>$e->getMessage()];
        }

        return ['code'=> '200','message'=> 'Delete successfully'];
    }
}
