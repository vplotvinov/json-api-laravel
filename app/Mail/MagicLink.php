<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MagicLink extends Mailable
{
    use Queueable, SerializesModels;

    public $link;
    public $name;
    public $recipient;
    public $emailView;

    /**
     * Invite constructor.
     *
     * @param $token
     * @param $name
     * @param $emailView
     */
    public function __construct($link, $name, $emailView)
    {
        $this->link      = $link;
        $this->name      = $name;
        $this->emailView = $emailView;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@website.com', ' Team')
                    ->view($this->emailView)
                    ->subject('Please open Magic link for login in your account')
                    ->with(
                        [
                            'link' => $this->link,
                            'name'  => $this->name,
                        ]);
    }
}
