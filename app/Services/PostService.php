<?php

namespace App\Services;

use App\Repositories\PostRepositoryInterface;

class PostService
{
    protected $postRepository;  

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }


    public function whatsNewList()
    {
        return $this->postRepository->whatsNewList();
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