<?php

namespace App\Repository\Database;
use App\Interfaces\LeaveTracking as ILeaveTracking;
use Illuminate\Support\Facades\DB;

class LeaveTracking implements ILeaveTracking
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

    public function detail($absensiId)
    {
        $absensiTable = DB::table('absensi')
            ->join('leaveclass', 'absensi.leaveclass_id', '=', 'leaveclass.LEAVEID')
            ->where('absensi.id', '=', $absensiId)
            ->select(['absensi.id', 'leaveclass.LEAVENAME', 'absensi.tanggal_pengajuan', 'absensi.tanggal_mulai', 'absensi.tanggal_selesai', 'absensi.alasan'])
            ->first();
        
        $penyetujuAbsensiTable = DB::table('penyetuju_absensi')
            ->join('userinfo', 'userinfo.USERID', '=', 'penyetuju_absensi.penanggungjawab_id')
            ->where('penyetuju_absensi.absensi_id', '=', $absensiId)
            ->select(['userinfo.Name', 'penyetuju_absensi.status', 'penyetuju_absensi.penanggungjawab_id'])
            ->get();

        $result = [];
        $result['id'] = $absensiTable->id;
        $result['tipe_absensi'] = $absensiTable->LEAVENAME;
        $result['tanggal_pengajuan'] = $absensiTable->tanggal_pengajuan;
        $result['tanggal_mulai'] = $absensiTable->tanggal_mulai;
        $result['tanggal_selesai'] = $absensiTable->tanggal_selesai;
        $result['alasan'] = $absensiTable->alasan;
        $result['atasan'] = [];
        $result['hr'] = [];


        // TODO: ganti kode setelah bisa membedakan atasan dan hr
        foreach ($penyetujuAbsensiTable as $value) {
            $jabatanTable = DB::table('temp_user_jabatan')
                ->select('jabatan')
                ->where('userid', '=', intval($value->penanggungjawab_id))
                ->first();
            if(!empty($jabatanTable)) {
                if($jabatanTable->jabatan == 'atasan') {
                    $temp = [];
                    $temp['nama'] = $value->Name;
                    $temp['status'] = $value->status;
                    $result['atasan'][] = $temp;
                }
                if($jabatanTable->jabatan == 'hr') {
                    $temp2 = [];
                    $temp2['nama'] = $value->Name;
                    $temp2['status'] = $value->status;
                    $result['hr'][] = $temp2;
                }
            }
        }

        return $result;
    }
}
