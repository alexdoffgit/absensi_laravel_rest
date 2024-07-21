<?php

namespace App\Http\Controllers;

use App\Interfaces\Attendance as IAttendance;
use App\Interfaces\TimeHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Interfaces\Employee;

class AttendanceController extends Controller
{
    public function __construct(
        private IAttendance $store,
        private TimeHelper $timeHelper,
        private Employee $karyawan
    ) {}

    public function index(Request $request) 
    {
        $uid = session()->get('userId');
        $position = $this->karyawan->getRoles(intval($uid));
        $userinfo = DB::table('userinfo')
            ->where('USERID', '=', $uid)
            ->select('fullname')
            ->first();

        return view('attendance', [
            'position' => $position,
            'uid' => $uid,
            'empName' => $userinfo->fullname
        ]);
    }

    public function getEventObjects(Request $request, $uid)
    {
        $startParam = $request->query('start');
        $endParam = $request->query('end');

        $startDate = explode('T', $startParam)[0];
        $endDate = explode('T', $endParam)[0];

        $timeRange = [
            'start' => \DateTimeImmutable::createFromFormat('Y-m-d', $startDate),
            'end' => \DateTimeImmutable::createFromFormat('Y-m-d', $endDate)
        ];

        $data = $this->store->getEmployeeAttendanceByIdAndTimeRange($uid, $timeRange);
        return response()->json($data);
    }
}
