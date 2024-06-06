<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Interfaces\PermitTracking;

class PermitTrackingController extends Controller
{
    public function __construct(private PermitTracking $store) {}

    public function index(Request $request, $uid)
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
}
