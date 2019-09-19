<?php

namespace App\Notifications;

use App\Services\EmailService;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\App;

/**
 * Class MailLinkNotification
 * @package App\Notifications
 */
class MailLinkNotification extends Notification
{
    use Queueable;

    /**
     * @var EmailService
     */
    protected $emailService;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * MailLinkNotification constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data         = $data;
        $this->emailService = App::make(EmailService::class);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the email representation of the notification.
     *
     * @param mixed $notifiable
     */
    public function toMail($notifiable)
    {
        $templateVars = array(
            'fullName'  => $this->data['firstName'] . ' ' . $this->data['lastName'],
            'email'     => $this->data['email'],
            'accountId' => $this->data['accountId'],
            'message'   => $this->data['text'],
        );

        $options = array(
            'toName'       => 'Our Team',
            'toEmail'      => 'apps@website.com',
            'templateId'   => $this->emailService::TEMPLATES['feedbackReceived'],
            'templateVars' => $templateVars,
        );

        $this->emailService->send($options);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
