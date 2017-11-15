<?php

namespace App\Exceptions;

use Exception;

class ValidationException extends Exception
{
    /**
     * @param string    $message  The internal exception message
     * @param Exception $previous The previous exception
     * @param int       $code     The internal exception code
     */
    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, 422, $previous);
    }
}
