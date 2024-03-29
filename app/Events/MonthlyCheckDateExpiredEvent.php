<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Notification;

class MonthlyCheckDateExpiredEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $notice;
    public $consumer_id;
    public $uncheckedAmount;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Notification $notice, $consumer_id, $uncheckedAmount)
    {
        $this->notice = $notice->comment;
        $this->consumer_id = $consumer_id;
        $this->uncheckedAmount = $uncheckedAmount;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel2');
    }
}
