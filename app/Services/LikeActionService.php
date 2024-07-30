<?php

namespace App\Services;

use App\Repositories\LikeActionRepositoryInterface;

class LikeActionService
{
    protected $likeActionRepository;  

    public function __construct(LikeActionRepositoryInterface $likeActionRepository)
    {
        $this->likeActionRepository = $likeActionRepository;
    }


    public function createLike($post_id)
    {
        return $this->likeActionRepository->createLike($post_id);
    }


    public function deleteLike($post_id)
    {
        return $this->likeActionRepository->deleteLike($post_id);
    }

}