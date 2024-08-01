<?php

namespace App\Listeners;

use App\Events\LikeCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Repositories\NotificationRepository;
use App\Repositories\UserRepository;
use App\Repositories\PostRepository;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\PostRepositoryInterface;
use App\Repositories\NotificationRepositoryInterface;

class InsertNotification
{
    protected $notificationRepository;
    protected $userRepository;
    protected $postRepository;

    /**
     * Create the event listener.
     */
    public function __construct(NotificationRepositoryInterface $notificationRepository, UserRepositoryInterface $userRepository, PostRepositoryInterface $postRepository)
    {
        $this->notificationRepository = $notificationRepository;
        $this->userRepository = $userRepository;
        $this->postRepository = $postRepository;
    }

    /**
     * Handle the event.
     */
    public function handle(LikeCreated $event)
    {
        $user_name = $this->userRepository->getUserNameByUserId($event->userId); //按讚的人
        $user_id = $this->postRepository->getUserIdByPostId($event->postId); //被按讚的人

        $content = $user_name . ' liked your post！';
        $this->notificationRepository->insertNotification($user_id, $content);
    }
}
