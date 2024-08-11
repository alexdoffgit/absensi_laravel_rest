<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class InvalidPasswordException extends Exception {
    public function __construct($code = 0, Throwable $previous = null) 
    {
        parent::__construct("password don't match", $code, $previous);
    }
}