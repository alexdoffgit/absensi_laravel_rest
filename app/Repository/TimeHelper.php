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
            $firstNextMonthDay = DateTimeImmutable::createFromFormat('Y n j', "$year $nextMonth 1");
            $lastDay = $firstNextMonthDay->sub(new DateInterval('P1D')); 
        }
        return [
            'first' => $firstDay,
            'last' => $lastDay
        ];
    }

    /**
     * @param \DateTimeInterface $start
     * @param \DateTimeInterface $end
     * @return bool
     */
    public function timeStartGreater($start, $end)
    {
        if ($start->diff($end)->format("%R") == '+')
        {
            return true;
        } 
        else 
        {
            return false;
        }
    }

    /**
     * @param \DateTimeInterface $start
     * @param \DateTimeInterface $end
     * @return bool
     */
    public function timeStartLess($start, $end)
    {
        if ($start->diff($end)->format("%R") == '-')
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * @param \DateTimeInterface $start
     * @param \DateTimeInterface $end
     * @return bool
     */
    public function timeEndGreater($start, $end)
    {
        if ($end->diff($start)->format("%R") == '+')
        {
            return true;
        } 
        else 
        {
            return false;
        }
    }

    /**
     * @param \DateTimeInterface $start
     * @param \DateTimeInterface $end
     * @return bool
     */
    public function timeEndLess($start, $end)
    {
        if ($end->diff($start)->format("%R") == '-')
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    /**
     * get monday and sunday based on datetime you input
     * @param \DateTimeImmutable $date
     * @return array{first: \DateTimeImmutable, last: \DateTimeImmutable}
     */
    public function getMondayAndSunday($date)
    {
        $monday = clone $date;
        $sunday = clone $date;
        
        $dayOfTheWeek = intval($date->format('N'));

        $monday = $monday->modify('-' . ($dayOfTheWeek - 1) . ' days');
        $sunday = $sunday->modify('+' . (7 - $dayOfTheWeek) . ' days');

        return [
            'first' => $monday->format('Y-m-d'),
            'last' => $sunday->format('Y-m-d')
        ];
    }
}
