<?php

namespace App\Listeners;

use App\Events\CreatedEntityName;
use Exception;

class SendEmailNewEntity
{
    protected $mailService;

    /**
     * SendEmailNewEntity constructor.
     *
     */
    public function __construct()
    {
//        $this->mailService = $sender;
    }

    /**
     * @param $event
     *
     * @throws Exception
     */
    public function handle(CreatedEntityName $event)
    {
        $this->sendEmail($event->entityData);
    }

    /**
     * @param array $entityData
     *
     * @throws Exception
     */
    private function sendEmail(array $entityData)
    {
        if ($entityData['typeId'] !== self::BONUS_TYPES['welcome']) {
            foreach ($entityData['recipientIds'] as $recipient) {
                // TODO: Create email after created new entity
//                $this->mailService->create($entityData, $recipient['userId']);
            }
        }
    }
}
