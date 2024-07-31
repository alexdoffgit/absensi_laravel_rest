<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class ManagerNotFoundException extends Exception {
    public function __construct($uid, $code = 0, Throwable $previous = null)
    {
        parent::__construct("invalid employee id: {$uid}, employee don't have manager", $code, $previous);
    }
}