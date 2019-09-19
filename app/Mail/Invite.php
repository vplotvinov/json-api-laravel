<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Invite extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $name;
    public $recipient;
    public $emailView;
    public $fast;

    /**
     * Invite constructor.
     *
     * @param $token
     * @param $name
     * @param $emailView
     * @param $fast
     */
    public function __construct($token, $name, $emailView, $fast)
    {
        $this->token     = $token;
        $this->name      = $name;
        $this->emailView = $emailView;
        $this->fast      = $fast;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@website.com', 'Team')
                    ->view($this->emailView)
                    ->subject('You have invite in account ')
                    ->with(
                        [
                            'token' => $this->token,
                            'name'  => $this->name,
                            'fast'  => $this->fast,
                        ]);
    }
}
