<?php

/**
 * ONLY FOR BACKEND
 */
namespace App\Notifications;

use App\Services\EmailService;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\App;

/**
 * Class FeedbackNotification
 * @package App\Notifications
 */
class FeedbackNotification extends Notification
{
    use Queueable;

    /**
     * @var EmailService
     */
    protected $emailService;

    protected $data = [];

    /**
     * FeedbackNotification constructor.
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
        return ['slack', 'mail'];
    }

    /**
     * Get the slack representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return SlackMessage
     */
    public function toSlack($notifiable)
    {
        $accountId = $this->data['accountId'];
        $email     = $this->data['email'];
        $text      = $this->data['text'];
        $fullName  = $this->data['firstName'] . ' ' . $this->data['lastName'];

        return (new SlackMessage)
            ->from('Feedback Bot', ':ghost:')
            ->to($this->data['slackChannel'])
            ->content("User: $fullName \ $email \ $accountId  \n Message: $text");
    }

    /**
     * Get the SendGrid representation of the notification.
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
            'toName'       => 'website Team',
            'toEmail'      => 'apps@website.one',
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
