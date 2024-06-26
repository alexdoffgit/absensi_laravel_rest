<?php

namespace App\Http\Controllers;

use App\Interfaces\Kehadiran as IKehadiran;
use App\Interfaces\TimeHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Interfaces\Karyawan;

class Kehadiran extends Controller
{
    public function __construct(
        private IKehadiran $store,
        private TimeHelper $timeHelper,
        private Karyawan $karyawan
    ) {}

    public function index(Request $request, $uid) 
    {
        $position = $this->karyawan->getRoles(intval($uid));
        $userinfo = DB::table('userinfo')
            ->where('USERID', '=', $uid)
            ->select('Name')
            ->first();

        return view('kehadiran', [
            'position' => $position,
            'uid' => $uid,
            'empName' => $userinfo->Name
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
