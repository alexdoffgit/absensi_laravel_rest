<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class DepartmentNotFoundException extends Exception {
    /**
     * Create a new class instance.
     */
    public function __construct($deptId, $code = 0, Throwable $previous = null)
    {
        parent::__construct("department with id {$deptId} not found", $code, $previous);
    }
}