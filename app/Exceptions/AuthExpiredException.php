<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class AuthExpiredException extends Exception
{
    public function __construct(
        $message = 'Token has expired',
        $code = 401,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
