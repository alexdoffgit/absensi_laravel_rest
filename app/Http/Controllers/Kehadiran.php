<?php

namespace App\Http\Controllers;

use App\Interfaces\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Kehadiran extends Controller
{
    public function __construct(private Karyawan $store) {}

    public function index(Request $request, $uid) 
    {
        $positionTableData = DB::table('temp_user_jabatan')
            ->select('jabatan')
            ->where('userid', '=', intval($uid))
            ->first();
        $presenceTableData = $this->store->getPresensi(intval($uid), false);
        $absenceTableData = $this->store->getAbsensi(intval($uid));


        return view('kehadiran', [
            'presenceTableData' => $presenceTableData,
            'absenceTableData' => $absenceTableData,
            'position' => $positionTableData->jabatan,
            'karyawanId' => $uid
        ]);
    }
}
