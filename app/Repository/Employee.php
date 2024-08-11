<?php

namespace App\Repository;

use App\Exceptions\EmployeeNotFoundException;
use App\Interfaces\Employee as IEmployee;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use DateTimeImmutable;
use DateInterval;

class Employee implements IEmployee
{
    /**
     * @return array{start: DateTimeImmutable, end: DateTimeImmutable}
     */
    private function getCurrentWeekRange()
    {
        $today = new DateTimeImmutable();
        // $today = DateTimeImmutable::createFromFormat('Y-m-d', '2024-01-17'); // temp date
        
        $dayOfTheWeek = $today->format('N') - 1;

        $startOfTheWeek = $today->modify('-' . $dayOfTheWeek . 'days');
        $endOfTheWeek = $startOfTheWeek->modify("+6 days");

        $startOfTheWeekStr = $startOfTheWeek->format('Y-m-d');
        $endOfTheWeekStr = $endOfTheWeek->format('Y-m-d');

        $startOfTheWeekDateTime = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', "{$startOfTheWeekStr} 00:00:00");
        $endOfTheWeekDateTime = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', "{$endOfTheWeekStr} 23:59:59");
        return [
            'start' => $startOfTheWeekDateTime,
            'end' => $endOfTheWeekDateTime
        ];
    }


    // TODO: tambahkan filter berapa banyak yang harus aku ambil, gimana kalau take(1000) untuk pengambilan data awal dan belum di filter?
    public function getPresensi($userId, $week)
    {
        // // ambil data dari database
        if (!empty($week) && $week == true) {
            $weekRange = $this->getCurrentWeekRange();
            $queryResult = DB::table('checkinout')
                ->where('USERID', '=', $userId)
                ->whereBetween('CHECKTIME', [$weekRange['start'], $weekRange['end']])
                ->get(['CHECKTIME', 'CHECKTYPE'])
                ->toArray();
        } else {
            $queryResult = DB::table('checkinout')
                            ->where('USERID', '=', $userId)
                            ->get(['CHECKTIME', 'CHECKTYPE'])
                            ->take(50)
                            ->toArray();
        }

        
        // // ubah CHECKTIME dari string ke DateTimeImmutable
        $presensi = [];
        for ($i = 0; $i < count($queryResult); $i++) {
            $singlePresensi = [];
            $checkdatetime = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $queryResult[$i]->CHECKTIME);
            $checkdate = $checkdatetime->format('Y-m-d');
            $checktime = $checkdatetime->format('H:i:s');
            
            $singlePresensi['type'] = $queryResult[$i]->CHECKTYPE;
            $singlePresensi['datetime'] = $checkdatetime;
            $singlePresensi['date'] = $checkdate;
            $singlePresensi['time'] = $checktime;
            $presensi[] = $singlePresensi; 
        }

        // // pisahkan antara jam datang dan jam pulang
        $datang = [];
        $pulang = [];
        for($i = 0; $i < count($presensi); $i++) {
            if($presensi[$i]['type'] == 'I') {
                $datang[] = $presensi[$i];
            }

            if($presensi[$i]['type'] == 'O') {
                $pulang[] = $presensi[$i];
            }
        }

        // // kelompokkan berdasarkan datang, pulang, hari
        $result = [];
        for($i = 0; $i < count($datang); $i++) {
            $tempResult = [];
            for($j = 0; $j < count($pulang); $j++) {
                if($datang[$i]['date'] == $pulang[$j]['date']) {
                    $tempResult['tanggal'] = $datang[$i]['date'];
                    $tempResult['jam_masuk'] = $datang[$i]['time'];
                    $tempResult['jam_pulang'] = $pulang[$j]['time'];
                    $result[] = $tempResult;
                    break;
                }
            }
        }

        return $result;
    }

    // TODO: tambahkan filter berapa banyak yang aku ambil
    // take(1000) untuk default, aku ngga tahu, maksudnya aku pingin paginasi tapi aku belum tahu implementasinya gimana
    public function getAbsensi($userId) {
        $queryResult = DB::table('user_speday')
                    ->join('leaveclass', 'user_speday.DATEID', '=', 'leaveclass.LEAVEID')
                    ->where('user_speday.USERID', '=', $userId)
                    ->select(['user_speday.STARTSPECDAY', 'user_speday.ENDSPECDAY', 'leaveclass.LEAVENAME', 'user_speday.date'])
                    ->take(50)
                    ->get();


        $transfomedQueryResults = [];
        foreach ($queryResult as $qr) {
            $temp = [];
            $datetimeMasuk = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $qr->STARTSPECDAY);
            $datetimePulang = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $qr->ENDSPECDAY);
            if(!empty($qr->date)) {
                $date = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $qr->date);
            }
            
            $temp['jam_masuk'] = $datetimeMasuk->format('H:i');
            $temp['jam_pulang'] = $datetimePulang->format('H:i');
            $temp['tanggal'] = isset($date) ? $date->format('Y-m-d') : null;
            
            $temp['tipe_absen'] = $qr->LEAVENAME;
            $transfomedQueryResults[] = $temp;
        }



        return $transfomedQueryResults;
    }

    public function getAtasanByKaryawanId($karyawanId)
    {
        $jabatan = DB::table('jabatan')->select('atasan_id')->where('user_id', '=', $karyawanId)->first();
        return $jabatan->atasan_id;
    }

    /**
     * @return list<array{
     *   user_id: int,
     *   badgenumber: string,
     *   fullname: string,
     *   ssn: string,
     *   department_name: string
     * }>
     */
    public function findAllForHR()
    {
        $user = User::all();

        $user->transform(function($item) {
            return [
                'user_id' => $item->USERID,
                'badgenumber' => $item->Badgenumber,
                'fullname' => $item->fullname,
                'ssn' => $item->SSN,
                'department_name' => $item->department->DEPTNAME
            ];
        });

        return $user->toArray();
    }

    /**
     * @param int $uid
     * @return 'hr'|'manager'|'staff'|'IT'
     * @throws App\Exceptions\EmployeeNotFoundException
     */
    public function getRoles($uid)
    {
        $departmentFromTable = DB::table('userinfo as u')
            ->join('deptseq as ds', 'u.DEFAULTDEPTID', '=', 'ds.DEPTID')
            ->where('u.USERID', '=', $uid)
            ->select(['ds.DEPTID', 'ds.DLEVEL'])
            ->first();
        
        $lowestDepartmentLevel = DB::table('deptseq')
            ->get('DLEVEL')
            ->max('DLEVEL');

        if(empty($departmentFromTable)) {
            throw new EmployeeNotFoundException($uid);
        }

        if($departmentFromTable->DEPTID === 54) {
            return 'hr';
        } else if($departmentFromTable->DEPTID === 159) {
            return 'IT';
        } else if(
            $departmentFromTable->DLEVEL >= 1.0 && 
            $departmentFromTable->DLEVEL < $lowestDepartmentLevel) {
                return 'manager';
        } else {
            return 'staff';
        }
    }

    private function insertLeaveAllowance()
    {
        DB::transaction(function() {
            $userinfoTable = DB::table('userinfo')
                ->select('USERID')
                ->get();
            foreach ($userinfoTable as $value) {
                $leaveAllowanceRow = [
                    'user_id' => $value->USERID,
                    'allowance' => 12,
                    'year' => 2024
                ];
    
                DB::table('leave_allowance')->insert(($leaveAllowanceRow));
            }
        });
    }
}