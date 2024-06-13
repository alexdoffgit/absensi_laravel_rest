<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use App\Interfaces\Kehadiran as IKehadiran;
use App\Exceptions\EmployeeNotFoundException;
use App\Interfaces\TimeHelper;
use Illuminate\Contracts\Database\Eloquent\Builder;

class Kehadiran implements IKehadiran
{
    public function __construct(private TimeHelper $time) {}

    public function getScheduleByEmployeeIdAndDate($uid, $date)
    {
        $monthInterval = $this->time->getFirstDateAndLastDateOfMonth(
            intval($date->format('Y')), intval($date->format('n')));

        $schclassTable = DB::table('schclass')
            ->join('user_schedule', 'schclass.schclassid', '=', 'user_schedule.schclass_id')
            ->where('user_schedule.user_id', '=', $uid)
            ->select(['STARTTIME', 'ENDTIME'])
            ->first();

        
        
        if(empty($schclassTable)) {
            throw new EmployeeNotFoundException($uid);
        }
        $timeSchedule = [
            'start' => \DateTimeImmutable::createFromFormat('H:i:s', $schclassTable->STARTTIME),
            'end' => \DateTimeImmutable::createFromFormat('H:i:s', $schclassTable->ENDTIME)
        ];


        // if checkin is bigger than starttime or checkout is smaller than endtime, red, else green
        $checkinoutTable = DB::table('checkinout')
            ->where('USERID', '=', $uid)
            ->whereDate('CHECKTIME', '>=', $monthInterval['first']->format('Y-m-d'))
            ->whereDate('CHECKTIME', '<=', $monthInterval['last']->format('Y-m-d'))
            ->select(['CHECKTYPE', 'CHECKTIME'])
            ->get();


        // turn checktype to datetime immutable
        $nativeCheckinout = [];
        foreach ($checkinoutTable as $checkinout1) {
            $temp1 = [];
            $temp1['CHECKTYPE'] = $checkinout1->CHECKTYPE;
            $temp1['CHECKTIME'] = \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $checkinout1->CHECKTIME);
            $nativeCheckinout[] = $temp1;
        }

        /*
            change collection to: [
                'datetime' => ...,
                'time_start => ...,
                'time_end' => ...,
            ]
        */
        $checkinout2 = $this->checkinoutTransformer($nativeCheckinout);


        // check if time_start is more than STARTTIME or time_end is smaller than ENDTIME, add color red to it else add color green
        /*
            end data type:
            [
                'start' => ...,
                'end' => ...,
                'color' => ...,
                'display' => 'background'
            ]
        */
        return $this->presentDateTransformer($checkinout2, $timeSchedule);
    }

    /**
     * @param array<int, array{CHECKTYPE: string, CHECKTIME: \DateTimeImmutable}> $nativeCheckinout
     * @return array<int, array{
     *   datetime: \DateTimeImmutable,
     *   time_start: \DateTimeImmutable,
     *   time_end: \DateTimeImmutable
     * }>
     */
    private function checkinoutTransformer($nativeCheckinout)
    {
        $begin = [];
        $end = [];
        foreach ($nativeCheckinout as $checkinout1) {
            if($checkinout1['CHECKTYPE'] == 'I') {
                $temp1 = [];
                $temp1['datetime'] = $checkinout1['CHECKTIME'];
                $temp1['date_string'] = $checkinout1['CHECKTIME']->format('Y-m-d');
                $begin[] = $temp1;
            }

            if($checkinout1['CHECKTYPE'] == 'O') {
                $temp2 = [];
                $temp2['datetime'] = $checkinout1['CHECKTIME'];
                $temp2['date_string'] = $checkinout1['CHECKTIME']->format('Y-m-d');
                $end[] = $temp2;
            }
        }

        $result = [];
        for ($i=0; $i < count($begin); $i++) { 
            for ($j=0; $j < count($end); $j++) { 
                if($begin[$i]['date_string'] == $end[$j]['date_string']) {
                    $temp3 = [];
                    $temp3['datetime'] = \DateTimeImmutable::createFromFormat('Y-m-d', $begin[$i]['date_string']);
                    $temp3['time_start'] = $begin[$i]['datetime'];
                    $temp3['time_end'] = $end[$i]['datetime'];
                    $result[] = $temp3;
                    break;
                }
            }
        }

        return $result;
    }

    /**
     * @param array<int, array{
     *   datetime: \DateTimeImmutable,
     *   time_start: \DateTimeImmutable,
     *   time_end: \DateTimeImmutable
     * }> $checkinout
     * @param array{start: \DateTimeImmutable, end: \DateTimeImmutable} $timeSchedule
     * @return array<int, array{
     *   start: string,
     *   end: string,
     *   color: 'red'|'green',
     *   display: 'background'
     * }>
     */
    private function presentDateTransformer($checkinout, $timeSchedule) 
    {
        $result = [];
        foreach ($checkinout as $value1) {
            $temp1 = [];
            if (
                $value1['time_start']->diff($timeSchedule['start'])->format("%R") == '+' ||
                $value1['time_end']->diff($timeSchedule['end'])->format('%R') == '-' ) {
                    $temp1['color'] = 'red';
                } else {
                    $temp1['color'] = 'green';
                }
                    $temp1['start'] = $value1['datetime']->format('Y-m-d');
                    $temp1['end'] = $value1['datetime']->format('Y-m-d');
                    $temp1['display'] = 'background';
            $result[] = $temp1;
        }

        return $result;
    }
}
