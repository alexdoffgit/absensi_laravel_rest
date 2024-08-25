<?php

namespace App\Repository\Database;

use App\Interfaces\Schedule as ISchedule;
use Illuminate\Support\Facades\DB;

class Schedule implements ISchedule
{
    /**
     * @return list<array{
     *   id: int,
     *   schedule_name: string,
     *   time_start: string,
     *   time_end: string
     * }>
     */
    public function listSummary()
    {
        $scheduleTable = DB::table('schclass')
            ->select(['schclassid', 'SCHNAME', 'STARTTIME', 'ENDTIME'])
            ->get();

        $returnData = [];
        foreach ($scheduleTable as $key => $row) {
            $temp = [
                'id' => $row->schclassid,
                'schedule_name' => $row->SCHNAME,
                'time_start' => $row->STARTTIME,
                'time_end' => $row->ENDTIME
            ];
            $returnData[] = $temp;
        }

        return $returnData;
    }

    /**
     * @param array{
     *   schedule_name: string,
     *   time_start: string,
     *   time_end: string
     * } $data
     */
    public function create($data)
    {
        $newData = [
            'SCHNAME' => $data['schedule_name'],
            'STARTTIME' => \DateTime::createFromFormat('H:i', $data['time_start']),
            'ENDTIME' => \DateTime::createFromFormat('H:i', $data['time_end'])
        ];
        DB::table('schclass')->insert($newData);
    }
}
