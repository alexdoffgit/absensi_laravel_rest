<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\PersetujuanIzin;

class Perizinan extends Controller
{
    public function __construct(private PersetujuanIzin $store) {}

    public function daftarIzin(Request $request, $hrid)
    {
        $semuaIzin = $this->store->daftarIzin(intval($hrid));

        return view('hr.daftar-izin', ['semuaIzin' => $semuaIzin, 'hrId' => $hrid]);
    }

    public function acceptOrReject(Request $request, $hrid, $id, $option) {
        $this->store->acceptOrReject(intval($id), intval($hrid), $option);

        return redirect()->back();
    }
}
