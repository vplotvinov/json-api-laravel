<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AccountRegistration
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $account;

    /**
     * AccountRegistration constructor.
     *
     * @param array $accountData
     */
    public function __construct(array $accountData)
    {
        $this->account = $accountData;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
