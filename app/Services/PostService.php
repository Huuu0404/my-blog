<?php

namespace App\Services;

use App\Repositories\PostRepositoryInterface;
use App\Repositories\LikeActionRepositoryInterface;

class PostService
{
    protected $postRepository;
    protected $likeActionRepository;  

    public function __construct(PostRepositoryInterface $postRepository, LikeActionRepositoryInterface $likeActionRepository)
    {
        $this->postRepository = $postRepository;
        $this->likeActionRepository = $likeActionRepository;
    }


    public function whatsNewList()
    {
        $post_list =  $this->postRepository->whatsNewList();

        foreach($post_list as &$post)
        {
            $post['like_count'] = $this->likeActionRepository->getLikeCountByPostId($post['id']);
            $post['is_like'] = $this->likeActionRepository->isLike($post['id']);
        }

        return $post_list;
    }


    public function myWorldList()
    {
        return $this->postRepository->myWorldList();
    }


    public function createPost($content)
    {
        return $this->postRepository->createPost($content);
    }


    public function updatePost($post_id, $content)
    {
        return $this->postRepository->updatePost($post_id, $content);
    }


    public function deletePost($post_id)
    {
        return $this->postRepository->deletePost($post_id);
    }

}