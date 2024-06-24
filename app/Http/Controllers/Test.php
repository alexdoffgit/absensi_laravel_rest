<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Interfaces\Kehadiran;
use Illuminate\Contracts\Database\Query\Builder;

class Test extends Controller
{
    public function __construct(private Kehadiran $kehadiran) {}

    public function index(Request $request)
    {
        // select checktime, checktype, userid dalam  5 tahun dari hari ini
        // pisahkan menjadi format date, time start, time end
        dd($this->kehadiran->getPresenceFiltered(80, ['time' => 'month', 'page' => 1]));
        // $this->kehadiran->getPresenceFiltered(80, ['time' => 'month', 'page' => 1]);

        return view('test', ['jabatan' => 'hr', 'uid' => 3]);
    }

    private function testing_how_long_i_can_go_back_in_time_before_memory_run_out()
    {
        $checkinoutTable = DB::table('checkinout')
            ->whereDate('CHECKTIME', '>=', '2021-12-01')
            ->select(['CHECKTYPE', 'CHECKTIME'])
            ->get();

        // dd($checkinoutTable);
    }

    private function testing_user_grouping_kehadiran()
    {
        // $this->kehadiran->getPresenceByDepartmentId(80, null);
    }
    
    private function testing_merge_user_and_schedule()
    {
        // $checkinoutOneUser = DB::table('checkinout')
        //     ->whereDate('CHECKTIME', '>=', '2024-01-17')
        //     ->whereDate('CHECKTIME', '<=', '2024-01-18')
        //     ->where('USERID', '=', 1015)
        //     ->select(['USERID', 'CHECKTIME', 'CHECKTYPE'])
        //     ->orderBy('CHECKTIME')
        //     ->get();
        
        // $scheduleOneUser = DB::table('user_sch')
        //     ->where('USERID', '=', 1015)
        //     ->whereDate('COMETIME', '=', '2024-01-17')
        //     ->select(['USERID', 'COMETIME', 'LEAVETIME', 'SCHCLASSID'])
        //     ->get();

        // $checkinoutOneUser = $checkinoutOneUser->map(function($item, $key) {
        //     $item->datestring = explode(' ', $item->CHECKTIME)[0];
        //     return $item;
        // });

        // $scheduleOneUser = $scheduleOneUser->map(function($item, $key) {
        //     $item->dateStart = explode(' ', $item->COMETIME)[0];
        //     $item->dateEnd = explode(' ', $item->LEAVETIME)[0];
        //     return $item;
        // });

        // $arrEnd2 = [];
        // foreach ($checkinoutOneUser as $key1 => $value1) {
        //     foreach ($scheduleOneUser as $key2 => $value2) {
        //         if($value1->CHECKTYPE == 'I') {
        //             if($value1->datestring == $value2->dateStart) {
        //                 $arrEnd2['time_start'] = $value1->CHECKTIME;
        //                 $arrEnd2['schedule_start'] = $value2->COMETIME;
        //             }
        //         }

        //         if($value1->CHECKTYPE == 'O') {
        //             if($value1->datestring == $value2->dateEnd) {
        //                 $arrEnd2['time_end'] = $value1->CHECKTIME;
        //                 $arrEnd2['schedule_end'] = $value2->LEAVETIME;
        //             }
        //         }
        //         $arrEnd2['user_id'] = $value2->USERID;
        //     }
        // }

        // // end result
        // $arrEnd = [
        //     'user_id' => $checkinoutOneUser->first()->USERID,
        //     'schedule_start' => $scheduleOneUser->first()->COMETIME,
        //     'schedule_end' => $scheduleOneUser->first()->LEAVETIME,
        //     'time_start' => $checkinoutOneUser[1]->CHECKTIME,
        //     'time_end' => $checkinoutOneUser[2]->CHECKTIME
        // ]; 

        $checkinoutTwoUser = DB::table('checkinout')
            ->whereDate('CHECKTIME', '>=', '2024-01-17')
            ->whereDate('CHECKTIME', '<=', '2024-01-18')
            ->where(function ($query) {
                $query->where('USERID', '=', 1015)
                    ->orWhere('USERID', '=', 288);
            })
            ->select(['USERID', 'CHECKTIME', 'CHECKTYPE'])
            ->orderBy('CHECKTIME')
            ->get();
        
        $scheduleTwoUser = DB::table('user_sch')
            ->where(function ($query) {
                $query->where('USERID', '=', 1015)
                    ->orWhere('USERID', '=', 288);
            })
            ->whereDate('COMETIME', '=', '2024-01-17')
            ->select(['USERID', 'COMETIME', 'LEAVETIME', 'SCHCLASSID'])
            ->get();

        $checkinoutTwoUser = $checkinoutTwoUser->map(function($item, $key) {
            $item->datestring = explode(' ', $item->CHECKTIME)[0];
            return $item;
        });

        $scheduleTwoUser = $scheduleTwoUser->map(function($item, $key) {
            $item->dateStart = explode(' ', $item->COMETIME)[0];
            $item->dateEnd = explode(' ', $item->LEAVETIME)[0];
            return $item;
        });

        $search = function($arr, $userid, $dateStart, $dateEnd, $cometime, $leavetime) {
            $userPresensi = [];
            foreach ($arr as $key => $value) {
                if(
                    $value->USERID == $userid && 
                    $value->datestring == $dateStart && 
                    $value->CHECKTYPE == 'I') {
                        $userPresensi['user_id'] = $value->USERID;
                        $userPresensi['schedule_start'] = $cometime;
                        $userPresensi['time_start'] = $value->CHECKTIME;
                    }

                if(
                    $value->USERID == $userid && 
                    $value->datestring == $dateEnd && 
                    $value->CHECKTYPE == 'O') {
                        $userPresensi['user_id'] = $value->USERID;
                        $userPresensi['schedule_end'] = $leavetime;
                        $userPresensi['time_end'] = $value->CHECKTIME;
                    }
            }

            // check if user presensi array is valid

            return $userPresensi;
        };

        $arrEnd3 = [];
        foreach ($scheduleTwoUser as $key => $value) {
            $temp = $search($checkinoutTwoUser, $value->USERID, $value->dateStart, $value->dateEnd, $value->COMETIME, $value->LEAVETIME);
            $arrEnd3[] = $temp;
        }
        // dump($checkinoutTwoUser);
        // dump($scheduleTwoUser);
        // dump($arrEnd);
        dump($arrEnd3);
        die();
    }
}
