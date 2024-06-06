<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Interfaces\PermitTracking;

class PermitTrackingController extends Controller
{
    public function __construct(private PermitTracking $store) {}

    public function permitSummary(Request $request, $uid)
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

    public function permitDetail(Request $request, $absentid, $uid)
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
