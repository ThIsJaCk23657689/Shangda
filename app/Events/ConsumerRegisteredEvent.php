<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class ConsumerRegisteredEvent
{
    use SerializesModels;

    public $consumer;

    public function __construct($consumer){
        $this->consumer = $consumer;
    }
}
