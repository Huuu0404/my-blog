<?php

namespace App\Repositories;

interface NotificationRepositoryInterface
{
    public function getNotification();
    public function getUnreadCount();
    public function insertNotification($user_id, $content);
    public function readNotification($notification_ids);
}