<?php

namespace App\Listeners;

use App\Events\ManualUserRegistration;
use App\Services\Sender;

class SendActiveLinkForUser
{
    protected $sender;

    /**
     * Create the event listener.
     *
     * @param Sender $sender
     *
     * @return void
     */
    public function __construct(Sender $sender)
    {
        $this->sender = $sender;
    }

    /**
     * Handle the event.
     *
     * @param ManualUserRegistration $event
     *
     * @return void
     */
    public function handle(ManualUserRegistration $event)
    {
        // TODO: Send active link
    }
}
