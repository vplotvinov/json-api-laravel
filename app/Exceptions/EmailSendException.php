<?php

namespace App\Exceptions;

use Exception;

class EmailSendException extends Exception
{
    /**
     * Report or log an exception.
     *
     * @return void
     */
    public function report()
    {
        \Log::debug('Email not send');
    }
}
