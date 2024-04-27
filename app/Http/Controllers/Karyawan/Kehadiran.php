<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\Karyawan;

class Kehadiran extends Controller
{
    public function __construct(private Karyawan $karyawan) {}

    public function getPresensi(Request $request, $id)
    {
        $resp = [
            'data' => $this->karyawan->getPresensi($id)
        ];

        return response()->json($resp);
    }

    public function getAbsensi(Request $request, $id)
    {
        $resp = [
            'data' => $this->karyawan->getAbsensi($id)
        ];

        return response()->json($resp);
    }
}
