<?php

namespace App\Services;

use App\Repositories\NotificationRepositoryInterface;

class NotificationService
{
    protected $notificationRepository;

    public function __construct(NotificationRepositoryInterface $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }


    public function getNotification()
    {
        return $this->notificationRepository->getNotification();
    }


    public function getUnreadCount()
    {
        return $this->notificationRepository->getUnreadCount();
    }


    public function readNotification($notification_ids)
    {
        $this->notificationRepository->readNotification($notification_ids);
    }


    public function insertNotification($user_id, $content)
    {
        $this->notificationRepository->insertNotification($user_id, $content);
    }
}