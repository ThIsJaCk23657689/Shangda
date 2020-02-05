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

class AddSaleOrderEvnet
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $notice;
    public $saleOrder_id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Notification $notice, $saleOrder_id)
    {
        $this->notice = $notice->comment;
        $this->saleOrder_id = $saleOrder_id;
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
