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

class RefundConfirmedNoticeEvnet
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $notice;
    public $returnOrder_id;
    public $consumer_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Notification $notice, $consumer_id, $returnOrder_id)
    {
        $this->notice = $notice->comment;
        $this->returnOrder_id = $returnOrder_id;
        $this->consumer_id = $consumer_id;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel3');
    }
}
