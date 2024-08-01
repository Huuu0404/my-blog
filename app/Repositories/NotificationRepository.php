<?php

namespace App\Repositories;

use App\Models\Notification;
use Illuminate\Support\Facades\Session;

class NotificationRepository implements NotificationRepositoryInterface
{
    public function getNotification()
    {
        $user_id = Session::get("user_id");

        $results = Notification::where('user_id', $user_id)
        ->orderBy('updated_at','desc')
        ->limit(10)
        ->get()
        ->toArray();

        return $results;
    }


    public function getUnreadCount()
    {
        $user_id = Session::get("user_id");

        $unread_counts = Notification::where('user_id', $user_id)
        ->where('is_read', 0)
        ->count();

        return $unread_counts;
    }


    public function insertNotification($user_id, $content)
    {
        $notification = Notification::create([
            'user_id' => $user_id,
            'content' => $content,
            'is_read' => 0,
            'created_time' => now(),
            'updated_time' => now()
        ]);

        return ['code' => '200', 'notification_id' => $notification->id];
    }


    public function readNotification($notification_ids)
    {
        Notification::whereIn('id', $notification_ids)->update(['is_read' => 1]);
    }
}
