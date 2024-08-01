<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LikeCreated
{
    use Dispatchable, SerializesModels;

    public $postId; //被按讚的貼文
    public $userId; //按讚的人

    /**
     * Create a new event instance.
     */
    public function __construct($postId, $userId)
    {
        $this->postId = $postId;
        $this->userId = $userId;
    }

    /**
     * Get the channels the event should broadcast on.
     */
    public function broadcastOn()
    {
        return new Channel('channel-name');
    }
}
