<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FirstUserLogin
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

    /**
     * FirstUserLogin constructor.
     *
     * @param array $userData
     */
    public function __construct(array $userData)
    {
        $this->user = $userData;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
