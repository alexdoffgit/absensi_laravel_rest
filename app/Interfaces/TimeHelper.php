<?php

namespace App\Interfaces;

interface TimeHelper
{
    /**
     * @param int $year
     * integer of year, example: 2012
     * @param int $month
     * an integer from 1 to 12, 1 being january and 12 being december
     * @return array{first: \DateTimeImmutable, last: \DateTimeImmutable}
     */
    public function getFirstDateAndLastDateOfMonth($year, $month);
}
