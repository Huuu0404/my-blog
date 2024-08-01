<?php

namespace App\Repositories;

interface PostRepositoryInterface
{
    public function whatsNewList();
    public function myWorldList();
    public function createPost($content);
    public function updatePost($post_id, $content);
    public function deletePost($post_id);
    public function getUserIdByPostId($post_id);
}