<?php

namespace App\Repositories;

interface LikeActionRepositoryInterface
{
    public function createLike($post_id);
    public function deleteLike($post_id);
    public function getLikeCountByPostId($post_id);
    public function isLike($post_id);
}