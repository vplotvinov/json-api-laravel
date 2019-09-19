<?php

namespace App\Exceptions;

use Exception;

class UserNotFoundException extends Exception
{
    /**
     * The exception description.
     *
     * @var string
     */
    protected $message = 'No user found for the given email address.';
}
