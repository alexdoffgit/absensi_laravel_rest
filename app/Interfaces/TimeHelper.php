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
    
    /**
     * get monday and sunday based on datetime you input
     * @param \DateTimeImmutable $date
     * @return array{monday: \DateTimeImmutable, sunday: \DateTimeImmutable}
     */
    public function getMondayAndSunday($date);

    /**
     * @param \DateTimeInterface $start
     * @param \DateTimeInterface $end
     * @return bool
     */
    public function timeStartGreater($start, $end);

    /**
     * @param \DateTimeInterface $start
     * @param \DateTimeInterface $end
     * @return bool
     */
    public function timeStartLess($start, $end);

    /**
     * @param \DateTimeInterface $start
     * @param \DateTimeInterface $end
     * @return bool
     */
    public function timeEndLess($start, $end);

    /**
     * @param \DateTimeInterface $start
     * @param \DateTimeInterface $end
     * @return bool
     */
    public function timeEndGreater($start, $end);
}
