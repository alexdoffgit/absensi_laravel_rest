<?php

namespace App\Interfaces;

interface Kehadiran
{
    /**
     * @param int $uid
     * @param \DateTimeImmutable $date
     * @return array<int, array{
     *   start: string,
     *   end: string,
     *   color: 'red'|'green',
     *   display: 'background'
     * }>
     * @throws App\Exceptions\EmployeeNotFoundException
     */
    public function getScheduleByEmployeeIdAndDate($uid, $date);
    public function getAllEmployeePresence();
}