<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Interfaces\LeaveTracking;

class LeaveTrackingController extends Controller
{
    public function __construct(private LeaveTracking $store) {}

    public function leaveSummaries(Request $request, $uid)
    {
        $jabatanTable = DB::table('temp_user_jabatan')
            ->select('jabatan')
            ->where('userid', '=', intval($uid))
            ->first();

        $permitSummaryMatrix = $this->store->summary(intval($uid));

        return view('permit-tracking', [
            'karyawanId' => $uid,
            'jabatan' => $jabatanTable->jabatan,
            'permitSummaryMatrix' => $permitSummaryMatrix
        ]);
    }

    public function leaveDetail(Request $request, $absentid, $uid)
    {
        $jabatanTable = DB::table('temp_user_jabatan')
            ->select('jabatan')
            ->where('userid', '=', intval($uid))
            ->first();

        $permitDetail = $this->store->detail(intval($absentid));

        return view('tracking-detail', [
            'karyawanId' => $uid,
            'jabatan' => $jabatanTable->jabatan,
            'permitDetail' => $permitDetail
        ]);
    }
}
