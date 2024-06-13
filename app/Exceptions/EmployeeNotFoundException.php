<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class EmployeeNotFoundException extends Exception
{
    /**
     * Create a new class instance.
     */
    public function __construct($uid, $code = 0, Throwable $previous = null)
    {
        parent::__construct("employee with id {$uid} not found", $code, $previous);
    }
}
