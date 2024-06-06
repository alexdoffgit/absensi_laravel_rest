<?php

namespace App\Repository;
use App\Interfaces\PermitTracking as IPT;
use Illuminate\Support\Facades\DB;

class PermitTracking implements IPT
{
    public function summary($uid)
    {
        $permitSummaryTable = DB::table('absensi')
            ->join('leaveclass', 'absensi.leaveclass_id', '=', 'leaveclass.LEAVEID')
            ->where('user_id', '=', $uid)
            ->select(['absensi.id', 'absensi.tanggal_pengajuan', 'leaveclass.LEAVENAME'])
            ->get();
        
        $result = [];
        foreach ($permitSummaryTable as $data) {
            $temp = [];
            $temp['tipe_izin'] = $data->LEAVENAME;
            $temp['id'] = $data->id;
            $temp['tanggal_pengajuan'] = $data->tanggal_pengajuan;
            $result[] = $temp;
        }

        return $result;
    }
}
