<?php

namespace App\Http\Controllers\Atasan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Interfaces\PersetujuanIzin;

class Perizinan extends Controller
{
    public function __construct(private PersetujuanIzin $store) {}

    public function daftarIzin(Request $request, $atasanid)
    {
        $data = $this->store->daftarIzin(intval($atasanid));

        return view('atasan.daftar-izin', ['semuaIzin' => $data, 'atasanId' => $atasanid]);
    }

    public function acceptOrReject(Request $request, $atasanid, $id, $option)
    {
        $this->store->acceptOrReject(intval($id), intval($atasanid), $option);

        return redirect()->back();
    }
}
