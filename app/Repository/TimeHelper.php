<?php

namespace App\Repository;
use \DateTimeImmutable;
use \DateInterval;
use App\Interfaces\TimeHelper as ITimeHelper;

class TimeHelper implements ITimeHelper
{
    public function getFirstDateAndLastDateOfMonth($year, $month) 
    {
        $firstDay = DateTimeImmutable::createFromFormat('Y n j', "$year $month 1");
        if($month == 12) {
            $lastDay = DateTimeImmutable::createFromFormat('Y n j', "$year $month 31");
        } else {
            $nextMonth = $month + 1;
            $firstNextMonthDay = DateTimeImmutable::createFromFormat('Y n j', "$year");
            $lastDay = $firstNextMonthDay->sub(new DateInterval('P1D')); 
        }
        return [
            'first' => $firstDay,
            'last' => $lastDay
        ];
    }
}
