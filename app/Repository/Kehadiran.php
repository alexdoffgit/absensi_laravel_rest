<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use App\Interfaces\Kehadiran as IKehadiran;
use App\Exceptions\EmployeeNotFoundException;
use App\Interfaces\TimeHelper;
use App\Exceptions\NegativeNumberException;
use Illuminate\Support\Collection;

class Kehadiran implements IKehadiran
{
    private $testDateBack = ['2024-01-11', '2024-01-18'];
    private $testDepartment = 80;

    public function __construct(private TimeHelper $time) {}

    /**
     * @param int $uid
     * @param array{
     *   start: \DateTimeImmutable,
     *   end: \DateTimeImmutable,
     * } $timeRange
     * @return list<array{
     *   start: string,
     *   end: string,
     *   color: 'red'|'green'|'orange'|'purple',
     *   display: 'background'
     * }>
     * @throws App\Exceptions\EmployeeNotFoundException
     */
    public function getEmployeeAttendanceByIdAndTimeRange($uid, $timeRange)
    {
        $employeeAttendance = [];


        $presenceCount = DB::table('presensi')
            ->whereDate('work_date_start', '>=', $timeRange['start'])
            ->whereDate('work_date_end', '<=', $timeRange['end'])
            ->where('user_id', '=', $uid)
            ->count();
        if($presenceCount > 0) {
            $presenceTable = DB::table('presensi')
                ->whereDate('work_date_start', '>=', $timeRange['start'])
                ->whereDate('work_date_end', '<=', $timeRange['end'])
                ->where('user_id', '=', $uid)
                ->select(['checkin', 'checkout'])
                ->get();

                foreach ($presenceTable as $value) {
                    $clockIn = explode(' ', $value->checkin)[1];
                    $clockOut = explode(' ', $value->checkout)[1];

                    $employeeAttendance[] = [
                        'start' => explode(' ', $value->checkin)[0],
                        'end' => explode(' ', $value->checkout)[0],
                        'color' => 'green',
                        'display' => 'list-item',
                        'title' => "in: {$clockIn}"
                    ];

                    $employeeAttendance[] = [
                        'start' => explode(' ', $value->checkin)[0],
                        'end' => explode(' ', $value->checkout)[0],
                        'color' => 'green',
                        'display' => 'list-item',
                        'title' => "out: {$clockOut}"
                    ];
                }
        }
        //  else {
        //     $skip = 0;
        //     $take = 200;
        //     $userScheduleTable = DB::table('user_sch')
        //         ->whereDate('COMETIME', '>=', $timeRange['start'])
        //         ->whereDate('LEAVETIME', '<=', $timeRange['end'])
        //         ->where('USERID', '=', $uid)
        //         ->orderBy('COMETIME')
        //         ->select(['COMETIME', 'LEAVETIME'])
        //         ->get()
        //         ->map(function($item, $key) {
        //             $item->dateStart = explode(' ', $item->COMETIME)[0];
        //             $item->dateEnd = explode(' ', $item->LEAVETIME)[0];
        //             return $item;
        //         });
        //     $checkInOutTable = DB::table('checkinout')
        //         ->whereDate('CHECKTIME', '>=', $timeRange['start'])
        //         ->whereDate('CHECKTIME', '<=', $timeRange['end'])
        //         ->where('USERID', '=', $uid)
        //         ->orderBy('CHECKTIME')
        //         ->select(['CHECKTIME', 'CHECKTYPE', 'USERID'])
        //         ->get()
        //         ->map(function($item, $key) {
        //             $item->datestring = explode(' ', $item->CHECKTIME)[0];
        //             return $item;
        //         });
        //     $presenceTable = [];
        //     foreach ($userScheduleTable as $userScheduleRow_1) {
        //         $presenceTableRow = $this->searchUserCheckTime(
        //             $checkInOutTable,
        //             $uid,
        //             $userScheduleRow_1->dateStart,
        //             $userScheduleRow_1->dateEnd,
        //             [
        //                 'cometime' => $userScheduleRow_1->COMETIME,
        //                 'leavetime' => $userScheduleRow_1->LEAVETIME
        //             ]
        //         );
        //         $presenceTable[] = $presenceTableRow;
        //     }
        //     $presenceTable = $this->validPresence($presenceTable);
        //     DB::table('presensi')->insert($presenceTable);
        //     $presenceTable = DB::table('presensi')
        //         ->whereDate('work_date_start', '>=', $timeRange['start'])
        //         ->whereDate('work_date_end', '<=', $timeRange['end'])
        //         ->where('user_id', '=', $uid)
        //         ->select(['checkin', 'checkout'])
        //         ->get()
        //         ->map(function($item, $key) {
        //             return [
        //                 'start' => explode(' ', $item->checkin)[0],
        //                 'end' => explode(' ', $item->checkout)[0],
        //                 'color' => 'green',
        //                 'display' => 'background'
        //             ];
        //         });
        //     foreach ($presenceTable as $presenceRow) {
        //         $employeeAttendance[] = $presenceRow;
        //     }
        // }

        // $absensiCount = DB::table('absensi')
        //     ->whereDate('tanggal_mulai', '>=', $timeRange['start'])
        //     ->whereDate('tanggal_selesai', '<=', $timeRange['end'])
        //     ->where('user_id', '=', $uid)
        //     ->count();
        // if($absensiCount > 0) {
        //     $absensiTable = DB::table('absensi as a')
        //         ->join('leaveclass as l', 'a.leaveclass_id', '=', 'l.LEAVEID')
        //         ->whereDate('a.tanggal_mulai', '>=', $timeRange['start'])
        //         ->whereDate('a.tanggal_selesai', '<=', $timeRange['end'])
        //         ->where('a.user_id', '=', $uid)
        //         ->select(['a.tanggal_mulai', 'a.tanggal_selesai', 'l.LEAVENAME'])
        //         ->get()
        //         ->map(function($item, $key) {
        //             return [
        //                 'start' => $item->tanggal_mulai,
        //                 'end' => $item->tanggal_selesai,
        //                 'color' => 'purple',
        //                 'display' => 'background'
        //             ];
        //         });

        //     foreach ($absensiTable as $absensiRow) {
        //         $employeeAttendance[] = $absensiRow;
        //     }
        // }

        $absensiTable = DB::table('user_speday as us')
            ->join('leaveclass as l', 'us.dateid', '=', 'l.LEAVEID')
            ->where('us.userid', '=', $uid)
            ->select(['us.startspecday', 'us.endspecday', 'l.LEAVENAME'])
            ->get();

        foreach ($absensiTable as $absensiRow) {
            $dateStart = explode(' ', $absensiRow->startspecday)[0];
            $dateEnd = explode(' ', $absensiRow->endspecday)[0];

            $employeeAttendance[] = [
                'start' => $dateStart,
                'end' => $dateEnd,
                'color' => 'red',
                'display' => 'list-item',
                'title' => $absensiRow->LEAVENAME
            ];
        }

        return $employeeAttendance;
    }

    /**
     * @param int $deptId
     * @param array{
     *   time: 'week'|'month',
     *   page: int
     * }|null $options
     * @return list<object{
     *   id: int,
     *   work_date_start: string,
     *   work_date_end: string,
     *   checkin: string,
     *   checkout: string,
     *   checkin_schedule: string,
     *   checkout_schedule: string,
     *   istirahat_start: string|null,
     *   istirahat_end: string|null,
     *   istirahat_start_schedule: string|null,
     *   istirahat_end_schedule: string|null,
     *   user_id: int
     * }>
     * @throws App\Exceptions\NegativeNumberException
     */
    public function getPresenceFiltered($deptId, $options)
    {

        $presensi = [];
        if(!empty($options)) {

            if (!isset($options['page'])) {
                $page = 1;
            } else {
                if($options['page'] < 0) {
                    throw new NegativeNumberException();
                }
                $page = $options['page'];
            }

            if(isset($options['time']) && $options['time'] == 'week') {
                
                $dayCalc = 7 * ($page - 1);
                $modifier = "-{$dayCalc} days";
                $date = (new \DateTimeImmutable())->modify($modifier);
                $timeRange = $this->time->getMondayAndSunday($date);
                $timeRange = [
                    'first' => \DateTimeImmutable::createFromFormat('Y-m-d', '2024-01-15'),
                    'last' => \DateTimeImmutable::createFromFormat('Y-m-d', '2024-01-21'),
                ];
                $presensi = $this->timeRangeFilter($deptId, $timeRange);
            }

            if(isset($options['time']) && $options['time'] == 'month') {
                
                $dayCalc = $page - 1;
                $modifier = "-{$dayCalc} month";
                $date = (new \DateTimeImmutable())->modify($modifier);
                // dd($date->format('n'));
                $timeRange = $this->time->getFirstDateAndLastDateOfMonth(intval($date->format('Y')), intval($date->format('n')));
                $timeRange = [
                    'first' => \DateTimeImmutable::createFromFormat('Y-m-d', '2023-12-01'),
                    'last' => \DateTimeImmutable::createFromFormat('Y-m-d', '2023-12-31'),
                ];
                $presensi = $this->timeRangeFilter($deptId, $timeRange);
            }

        } else {

            $page = 1;
            $dayCalc = 7 * ($page - 1);
            $modifier = "-{$dayCalc} days";
            $date = (new \DateTimeImmutable())->modify($modifier);
            $timeRange = $this->time->getMondayAndSunday($date);
            $timeRange = [
                'first' => \DateTimeImmutable::createFromFormat('Y-m-d', '2024-01-15'),
                'last' => \DateTimeImmutable::createFromFormat('Y-m-d', '2024-01-21'),
            ];
            $presensi = $this->timeRangeFilter($deptId, $timeRange);

        }

        $presensi = $this->validPresence($presensi);
        // dd($presensi);

        DB::table('presensi')->insert($presensi);
        
        $presensiFromTable = DB::table('presensi')
            ->get();

        return $presensiFromTable->toArray();
    }
    
    /**
     * @param \DateTimeImmutable $date
     * @param array{
     *   deptId: int,
     *   userId?: int
     * } $options
     * @return list<object{
     *   id: int,
     *   work_date_start: string,
     *   work_date_end: string,
     *   checkin: string,
     *   checkout: string,
     *   istirahat_start: string|null,
     *   istirahat_end: string|null,
     *   istirahat_start_schedule: string|null,
     *   istirahat_end_schedule: string|null,
     *   username: string,
     *   user_id: int
     * }>
     */
    public function getPresencePerDay($date, $options)
    {
        // check if data exist in database
        $presenceQty = DB::table('presensi')->count();

        if($presenceQty == 0) {
            if (isset($options['userId'])) {
                $checkInOutTable = DB::table('checkinout as c')
                    ->join('userinfo as u', 'c.USERID', '=', 'u.USERID')
                    ->join('user_sch as us', 'u.USERID', '=', 'us.USERID')
                    ->where('u.DEFAULTDEPTID', '=', $options['deptId'])
                    ->where('u.USERID', '=', $options['userId'])
                    ->whereDate('c.CHECKTIME', '=', $date)
                    ->select(['c.USERID', 'c.CHECKTIME', 'c.CHECKTYPE'])
                    ->get();

                $userScheduleTable = DB::table('user_sch as us')
                    ->join('userinfo as u', 'us.USERID', '=', 'u.USERID')
                    ->where('u.USERID', '=', $options['userId'])
                    ->where('u.DEFAULTDEPTID', '=', $options['deptId'])
                    ->whereDate('us.COMETIME', '=', $date)
                    ->select(['us.USERID', 'us.COMETIME', 'us.LEAVETIME', 'us.SCHCLASSID'])
                    ->get();
            } else {
                // if i ask for certain date, should i get range yesterday
                $checkInOutTable = DB::table('checkinout as c')
                    ->join('userinfo as u', 'c.USERID', '=', 'u.USERID')
                    ->join('user_sch as us', 'u.USERID', '=', 'us.USERID')
                    ->where('u.DEFAULTDEPTID', '=', $options['deptId'])
                    ->whereDate('c.CHECKTIME', '=', $date)
                    ->select(['c.USERID', 'c.CHECKTIME', 'c.CHECKTYPE'])
                    ->get();

                // i don't know if i should use the same cometime and leavetime
                $userScheduleTable = DB::table('user_sch as us')
                    ->join('userinfo as u', 'us.USERID', '=', 'u.USERID')
                    ->where('u.DEFAULTDEPTID', '=', $options['deptId'])
                    ->whereDate('us.COMETIME', '=', $date)
                    ->select(['us.USERID', 'us.COMETIME', 'us.LEAVETIME', 'us.SCHCLASSID'])
                    ->get();
            }
    

    
            $checkInOutTable->transform(function($item, $key) {
                $item->datestring = explode(' ', $item->CHECKTIME)[0];
                return $item;
            });
    
            $userScheduleTable->transform(function($item, $key) {
                $item->dateStart = explode(' ', $item->COMETIME)[0];
                $item->dateEnd = explode(' ', $item->LEAVETIME)[0];
                return $item;
            });
    
            $userSchedule = [];
            foreach ($userScheduleTable as $i => $scheduleRow) {
                $datetimeData = $this->searchUserCheckTime(
                    $checkInOutTable, 
                    $scheduleRow->USERID,
                    $scheduleRow->dateStart,
                    $scheduleRow->dateEnd,
                    [
                        'cometime' => $scheduleRow->COMETIME,
                        'leavetime' => $scheduleRow->LEAVETIME
                    ]
                );
                $userSchedule[] = $datetimeData;
            }
    
            $validUserSchedule = $this->validPresence($userSchedule);

            DB::table('presensi')->insert($validUserSchedule);

            $presence = DB::table('presensi')
                ->whereDate('work_date_start', '=', $date)
                ->whereDate('work_date_end', '=', $date)
                ->get();
            
            return $presence->toArray();
        } else {
            if (isset($options['userId'])) {
                $presence = DB::table('presensi as p')
                    ->join('userinfo as u', 'u.USERID', '=', 'p.user_id')
                    ->where('u.DEFAULTDEPTID', '=', $options['deptId'])
                    ->where('p.user_id', '=', $options['userId'])
                    ->whereDate('p.work_date_start', '=', $date)
                    ->whereDate('p.work_date_end', '=', $date)
                    ->get();
            } else {
                $presence = DB::table('presensi as p')
                    ->join('userinfo as u', 'u.USERID', '=', 'p.user_id')
                    ->where('u.DEFAULTDEPTID', '=', $options['deptId'])
                    ->whereDate('p.work_date_start', '=', $date)
                    ->whereDate('p.work_date_end', '=', $date)
                    ->get();
            }

            return $presence->toArray();
        }
    }

    /**
     * @param \DateTimeImmutable $date
     * @param int $deptId
     * @param array{userId?: int} $options
     * @return list<object{
     *   id: int,
     *   user_id: int,
     *   tanggal_pengajuan: string,
     *   tanggal_mulai: string,
     *   tanggal_selesai: string,
     *   alasan: string,
     *   dokumen_pendukung: string,
     *   tipe_absen: string
     * }>
     */
    public function getAbsencePerDay($date, $deptId, $options)
    {
        $absensiTable = DB::table('absensi as a')
            ->join('leaveclass as l', 'a.leaveclass_id', '=', 'l.LEAVEID')
            ->join('userinfo as u', 'u.USERID', '=', 'a.user_id')
            ->whereDate('a.tanggal_mulai', '=', $date)
            ->where('u.DEFAULTDEPTID', '=', $deptId)
            ->select([
                'a.id', 
                'a.user_id', 
                'a.tanggal_pengajuan', 
                'a.tanggal_mulai',
                'a.tanggal_selesai',
                'a.alasan',
                'a.dokumen_pendukung',
                'l.LEAVENAME'
            ])
            ->get();

        return $absensiTable->toArray();
    }

    /**
     * @param array{
     *   start: \DateTimeImmutable,
     *   end: \DateTimeImmutable
     * } $timeRange
     * @param int $deptId
     * @param array{
     *   userId: int
     * } $options
     * @return array{
     *   leave_total_count: int,
     *   sick_total_count: int
     * }
     */
    public function getPresenceSummary($timeRange, $deptId, $options)
    {
        $leave_total_count = DB::table('absensi')
            ->whereDate('tanggal_mulai', '>=', $timeRange['start'])
            ->whereDate('tanggal_mulai', '<=', $timeRange['end'])
            ->where('leaveclass_id', '=', 8)
            ->count();
        $sick_total_count = DB::table('absensi')
            ->whereDate('tanggal_mulai', '>=', $timeRange['start'])
            ->whereDate('tanggal_mulai', '<=', $timeRange['end'])
            ->where('leaveclass_id', '=', 5)
            ->count();
        return [
            'leave_total_count' => $leave_total_count,
            'sick_total_count' => $sick_total_count
        ];
    }

    /**
     * @param \DateTimeImmutable $day
     * @param array{
     *   deptId?: int,
     *   userId?: int,
     * }|null $options
     * @return list<array{
     *   deptId: int,
     *   deptName: string,
     *   summary: array<string, int>
     * }>
     */
    public function getPresenceSummaryPerDay($day, $options)
    {
        $userSpedayTable = DB::table('user_speday as us')
            ->join('leaveclass as l', 'us.dateid', '=', 'l.LEAVEID')
            ->join('userinfo as u', 'l.userid', '=', 'u.USERID')
            ->whereDate('us.startspecday', '=', $day);
    
        if(!empty($options)) {
            if(array_key_exists('deptId', $options)) {
                $userSpedayTable->where('u.DEFAULTDEPTID', '=', $options['deptId']);
            }
            if(array_key_exists('userId', $options)) {
                $userSpedayTable = $userSpedayTable->where('u.USERID', '=', $options['userId']);
            }
        }

        $userSpedayTable = $userSpedayTable
            ->select(['l.LEAVENAME', 'u.DEFAULTDEPTID', 'u.Name', 'u.USERID'])
            ->get();

        foreach ($variable as $key => $value) {
            # code...
        }
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

    /**
     * @param int $deptId
     * @param array{first: \DateTimeImmutable, last: \DateTimeImmutable} $timeRange
     * @return list<array{
     *   id: int,
     *   work_date_start: string,
     *   work_date_end: string,
     *   checkin: string,
     *   checkin_schedule: string,
     *   checkout_schedule: string,
     *   checkout: string,
     *   istirahat_start: string|null,
     *   istirahat_end: string|null,
     *   istirahat_start_schedule: string|null,
     *   istirahat_end_schedule: string|null,
     *   user_id: int
     * }>
     */
    private function timeRangeFilter($deptId, $timeRange) 
    {
        $checkInOutTable = DB::table('checkinout')
            ->join('userinfo', 'userinfo.USERID', '=', 'checkinout.USERID')
            ->where('userinfo.DEFAULTDEPTID', '=', $deptId)
            ->whereDate('checkinout.CHECKTIME', '>=', $timeRange['first'])
            ->whereDate('checkinout.CHECKTIME', '<=', $timeRange['last'])
            ->select(['checkinout.USERID', 'checkinout.CHECKTIME', 'checkinout.CHECKTYPE'])
            ->orderBy('checkinout.CHECKTIME')
            ->get();
        

        $scheduleTable = DB::table('user_sch')
            ->join('userinfo', 'userinfo.USERID', '=', 'user_sch.USERID')
            ->whereDate('COMETIME', '>=', $timeRange['first'])
            ->whereDate('LEAVETIME', '<=', $timeRange['last'])
            ->where('userinfo.DEFAULTDEPTID', '=', $deptId)
            ->select(['user_sch.USERID', 'user_sch.COMETIME', 'user_sch.LEAVETIME', 'user_sch.SCHCLASSID'])
            ->get();
        
        $checkInOutTable = $checkInOutTable->map(function($item, $key) {
            $item->datestring = explode(' ', $item->CHECKTIME)[0];
            return $item;
        });


        $scheduleTable = $scheduleTable->map(function($item, $key) {
            $item->dateStart = explode(' ', $item->COMETIME)[0];
            $item->dateEnd = explode(' ', $item->LEAVETIME)[0];
            return $item;
        });

        

        $userSchedule = [];
        foreach ($scheduleTable as $i => $scheduleRow) {
            $datetimeData = $this->searchUserCheckTime(
                    $checkInOutTable, 
                    $scheduleRow->USERID,
                    $scheduleRow->dateStart,
                    $scheduleRow->dateEnd,
                    [
                        'cometime' => $scheduleRow->COMETIME,
                        'leavetime' => $scheduleRow->LEAVETIME
                    ]
                );
            $userSchedule[] = $datetimeData;
        }

        return $userSchedule;
    }

    /**
     * @param list<object{
     *   USERID: int,
     *   CHECKTIME: string,
     *   CHECKTYPE: 'I'|'O',
     *   datestring: string
     * }> $checkInOut
     * @param int $userId
     * @param string $dateStart
     * @param string $dateEnd
     * @param array{
     *   cometime: string, 
     *   leavetime: string,
     * } $injected
     * @return array{
     *   id: int,
     *   work_date_start: string,
     *   work_date_end: string,
     *   checkin: string,
     *   checkout: string,
     *   checkin_schedule: string,
     *   checkout_schedule: string,
     *   istirahat_start: string|null,
     *   istirahat_end: string|null,
     *   istirahat_start_schedule: string|null,
     *   istirahat_end_schedule: string|null,
     *   user_id: int
     * }
     */
    private function searchUserCheckTime($checkInOut, $userId, $dateStart, $dateEnd, $injected)
    {
        $userPresensi = [];
        foreach ($checkInOut as $valueRow_1) {
            if(
                $valueRow_1->USERID == $userId && 
                $valueRow_1->datestring == $dateStart && 
                $valueRow_1->CHECKTYPE == 'I') {
                    $userPresensi['user_id'] = $valueRow_1->USERID;
                    $userPresensi['checkin'] = $valueRow_1->CHECKTIME;
                    $userPresensi['checkin_schedule'] = $injected['cometime'];
                    $userPresensi['checkout_schedule'] = $injected['leavetime'];
                    $userPresensi['work_date_start'] = $dateStart;
                    $userPresensi['work_date_end'] = $dateEnd;
                    $userPresensi['istirahat_start'] = null;
                    $userPresensi['istirahat_end'] = null;
                    $userPresensi['istirahat_start_schedule'] = null;
                    $userPresensi['istirahat_end_schedule'] = null;
                }

            if(
                $valueRow_1->USERID == $userId && 
                $valueRow_1->datestring == $dateEnd && 
                $valueRow_1->CHECKTYPE == 'O') {
                    $userPresensi['user_id'] = $valueRow_1->USERID;
                    $userPresensi['checkout'] = $valueRow_1->CHECKTIME;
                    $userPresensi['checkin_schedule'] = $injected['cometime'];
                    $userPresensi['checkout_schedule'] = $injected['leavetime'];
                    $userPresensi['work_date_start'] = $dateStart;
                    $userPresensi['work_date_end'] = $dateEnd;
                    $userPresensi['istirahat_start'] = null;
                    $userPresensi['istirahat_end'] = null;
                    $userPresensi['istirahat_start_schedule'] = null;
                    $userPresensi['istirahat_end_schedule'] = null;
                }
        }

        return $userPresensi;
    }

    /**
     * @param list<array{
     *   id: int,
     *   work_date_start: string,
     *   work_date_end: string,
     *   checkin: string,
     *   checkin_schedule: string,
     *   checkout_schedule: string,
     *   checkout: string,
     *   istirahat_start: string|null,
     *   istirahat_end: string|null,
     *   istirahat_start_schedule: string|null,
     *   istirahat_end_schedule: string|null,
     *   user_id: int
     * }> $presenceArr
     * @return list<array{
     *   id: int,
     *   work_date_start: string,
     *   work_date_end: string,
     *   checkin: string,
     *   checkin_schedule: string,
     *   checkout_schedule: string,
     *   checkout: string,
     *   istirahat_start: string|null,
     *   istirahat_end: string|null,
     *   istirahat_start_schedule: string|null,
     *   istirahat_end_schedule: string|null,
     *   user_id: int
     * }>
     */
    private function validPresence($presenceArr)
    {
        return array_filter($presenceArr, function($value) {
            return count($value) == 11;
        });
    }
}
