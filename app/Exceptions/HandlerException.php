<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class HandlerException extends Exception
{
    public function __construct(
        $message = '',
        $code = 500,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
