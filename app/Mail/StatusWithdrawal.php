<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StatusWithdrawal extends Mailable
{
    use Queueable, SerializesModels;

    public $withdrawalDto;
    public $recipient;
    public $emailView;

    /**
     * Invite constructor.
     *
     * @param $withdrawalDto
     * @param $emailView
     */
    public function __construct($withdrawalDto, $emailView)
    {
        $this->withdrawalDto = $withdrawalDto;
        $this->emailView     = $emailView;
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
                    ->subject('Hi, Admin! In your account was updates withdrawal, ')
                    ->with(
                        [
                            'withdrawalDto' => $this->withdrawalDto,
                        ]);
    }
}
