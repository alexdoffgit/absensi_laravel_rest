<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\LeaveApproval;

class LeaveController extends Controller
{
    public function __construct(private LeaveApproval $store) {}

    public function permitSummaries(Request $request)
    {
        $hrid = session()->get('userId');
        $semuaIzin = $this->store->permitSummaries(intval($hrid));

        return view('hr.permit-summaries', ['semuaIzin' => $semuaIzin, 'hrId' => $hrid]);
    }

    public function permitDetail(Request $request, $id, $absensiid)
    {
        $penanggungjawabid = session()->get('userId');
        $data = $this->store->permitDetail($id, $absensiid, $penanggungjawabid);

        return view('hr.permit-detail', [
            'permit' => $data, 
            'penanggungJawabId' => $penanggungjawabid,
            'id' => $id
        ]);
    }

    public function acceptOrReject(Request $request, $id, $option) {
        $hrid = session()->get('userId');
        $this->store->acceptOrReject(intval($id), intval($hrid), $option);

        return redirect()->back();
    }
}
