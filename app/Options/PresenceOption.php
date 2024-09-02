<?php

namespace App\Options;

class PresenceOption {
    public int $employeeID;
    /**
     * @var array{start: \DateTimeInterface, end: \DateTimeInterface}
     */
    public $period;

    /**
     * @param int $employeeID
     * @param array{start: \DateTimeInterface, end: \DateTimeInterface} $period
     */
    public function __construct($employeeID, $period)
    {
        $this->employeeID = $employeeID;
        $this->period = $period;
    }
}