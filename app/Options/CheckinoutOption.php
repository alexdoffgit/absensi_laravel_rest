<?php

namespace App\Options;

class CheckinoutOption {
    public $employeeId;
    /**
     * @var array{start: \DateTimeInterface, end: \DateTimeInterface}
     */
    public $period;

    /**
     * @param array{start: \DateTimeInterface, end: \DateTimeInterface} $period
     */
    public function __construct($employeeId, $period)
    {
        $this->employeeId = $employeeId;
        $this->period = $period;
    }
}