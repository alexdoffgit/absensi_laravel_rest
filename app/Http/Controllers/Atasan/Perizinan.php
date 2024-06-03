<?php

namespace App\Http\Controllers\Atasan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Interfaces\PersetujuanIzin;

class Perizinan extends Controller
{
    public function __construct(private PersetujuanIzin $store) {}

    public function permitSummaries(Request $request, $atasanid)
    {
        $data = $this->store->permitSummaries(intval($atasanid));

        return view('atasan.permit-summaries', ['semuaIzin' => $data, 'atasanId' => $atasanid]);
    }

    public function permitDetail(Request $request, $id, $absensiid, $penanggungjawabid)
    {
        $data = $this->store->permitDetail($id, $absensiid, $penanggungjawabid);

        return view('atasan.permit-detail', [
            'permit' => $data, 
            'penanggungJawabId' => $penanggungjawabid,
            'id' => $id
        ]);
    }

    public function acceptOrReject(Request $request, $atasanid, $id, $option)
    {
        $this->store->acceptOrReject(intval($id), intval($atasanid), $option);

        return redirect()->back();
    }
}
