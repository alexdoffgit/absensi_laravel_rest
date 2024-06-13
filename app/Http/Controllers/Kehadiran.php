<?php

namespace App\Http\Controllers;

use App\Interfaces\Kehadiran as IKehadiran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Kehadiran extends Controller
{
    public function __construct(private IKehadiran $store) {}

    public function index(Request $request, $uid) 
    {
        $positionTableData = DB::table('temp_user_jabatan')
            ->select('jabatan')
            ->where('userid', '=', intval($uid))
            ->first();
        $this->store->getScheduleByEmployeeIdAndDate($uid, \DateTimeImmutable::createFromFormat('Y-m-d', '2023-12-12'));

        return view('kehadiran', [
            'position' => $positionTableData->jabatan,
            'uid' => $uid
        ]);
    }

    public function getEventObjects(Request $request, $uid, $yearmonth)
    {
        $data = $this->store->getScheduleByEmployeeIdAndDate($uid, \DateTimeImmutable::createFromFormat('Y-m-d', $yearmonth));
        return response()->json($data);
    }
}
