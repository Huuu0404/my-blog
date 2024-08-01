<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NotificationService;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }


    /**
     *  ajax - 已讀通知
     */
    public function readNotification(Request $request)
    {
        try
        {
            $notification_ids = $request->input("notification_ids");

            $this->notificationService->readNotification($notification_ids);
        }
        catch(\Exception $e)
        {
            return ['code'=>'100', 'message'=>$e->getMessage()];
        }

        return ['code'=> '200','message'=> 'Success'];
    }


    /**
     * ajax - 獲取通知列表
     */
    public function getNotification(Request $request)
    {
        try
        {
            $notification_list = $this->notificationService->getNotification();
        }
        catch(\Exception $e)
        {
            return ['code'=>'100', 'message'=>$e->getMessage()];
        }

        return $notification_list;
    }


    /**
     *  ajax - 獲得未讀通知數量
     */
    public function getUnreadCount(Request $request)
    {
        try
        {
            $unread_counts = $this->notificationService->getUnreadCount();
        }
        catch(\Exception $e)
        {
            return ['code'=>'100', 'message'=>$e->getMessage()];
        }

        return $unread_counts;
    }
}
