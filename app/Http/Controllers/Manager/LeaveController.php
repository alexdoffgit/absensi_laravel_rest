<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Interfaces\LeaveApproval;

class LeaveController extends Controller
{
    public function __construct(private LeaveApproval $store) {}

    public function permitSummaries(Request $request, $atasanid)
    {
        $data = $this->store->permitSummaries(intval($atasanid));

        return view('manager.permit-summaries', ['semuaIzin' => $data, 'atasanId' => $atasanid]);
    }

    public function permitDetail(Request $request, $id, $absensiid, $penanggungjawabid)
    {
        $data = $this->store->permitDetail($id, $absensiid, $penanggungjawabid);

        return view('manager.permit-detail', [
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
