<?php
namespace App\Exceptions;
use Exception;
use Throwable;

class NegativeNumberException extends Exception {
    /**
     * Create a new class instance.
     */
    public function __construct($code = 0, Throwable $previous = null)
    {
        parent::__construct("a negative number is not allowed", $code, $previous);
    }
}