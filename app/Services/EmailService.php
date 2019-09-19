<?php

namespace App\Services;

use App\Exceptions\EmailSendException;
use Exception;
use SendGrid\Mail\From as From;
use SendGrid\Mail\Mail as SendgridMail;
use SendGrid\Mail\To as To;
use SendGrid\SendGrid;

class EmailService
{
    public const TEMPLATES = [
        'feedbackReceived' => 'sasda',
    ];

    public function send(array $options)
    {
        $from = new From('team@website.com', 'Our Team');

        $to = new To(
            $options['toEmail'],
            $options['toName'],
            $options['templateVars'],
        );

        $email = new SendgridMail($from, $to,);

        $email->setTemplateId($options['templateId']);

        $sendgrid = new \SendGrid(env('MAIL_API_KEY'));

        try {
            $response = $sendgrid->send($email);
        } catch (Exception $e) {
            throw new EmailSendException('Failed sent email.', 400);
        }
    }
}
