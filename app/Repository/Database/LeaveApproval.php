<?php

namespace App\Repository\Database;

use App\Interfaces\LeaveApproval as ILeaveApproval;
use Illuminate\Support\Facades\DB;
use DateTimeImmutable;


class LeaveApproval implements ILeaveApproval
{
    public function daftarIzin($userid)
    {
        $absensiTable = DB::table('absensi')
            ->join('userinfo', 'absensi.user_id', '=', 'userinfo.USERID')
            ->join('departments', 'userinfo.DEFAULTDEPTID', '=', 'departments.DEPTID')
            ->join('leaveclass', 'absensi.leaveclass_id', '=', 'leaveclass.LEAVEID')
            ->join('penyetuju_absensi', 'penyetuju_absensi.absensi_id', '=', 'absensi.id')
            ->select([
                'penyetuju_absensi.id',
                'userinfo.Name',
                'departments.DEPTNAME',
                'leaveclass.LEAVENAME',
                'absensi.tanggal_pengajuan',
                'absensi.tanggal_mulai',
                'absensi.tanggal_selesai',
                'absensi.alasan'
            ])
            ->where('penyetuju_absensi.penanggungjawab_id', '=', $userid)
            ->get();

        $absensi = [];

        foreach ($absensiTable as $absensiRow) {
            $temp = [];
            $temp['id'] = $absensiRow->id;
            $temp['nama_karyawan'] = $absensiRow->Name;
            $temp['department'] = $absensiRow->DEPTNAME;
            $temp['jabatan'] = $absensiRow->DEPTNAME;
            $temp['tipe_izin'] = $absensiRow->LEAVENAME;
            $temp['tanggal_pengajuan'] = $absensiRow->tanggal_pengajuan;
            $temp['tanggal_mulai'] = $absensiRow->tanggal_mulai;
            $temp['tanggal_selesai'] = $absensiRow->tanggal_selesai;
            $temp['alasan'] = $absensiRow->alasan;

            $absensi[] = $temp;
        }
        return $absensi;
    }

    public function permitSummaries($userId)
    {
        $absensiTable = DB::table('absensi')
            ->join('userinfo', 'absensi.user_id', '=', 'userinfo.USERID')
            ->join('departments', 'userinfo.DEFAULTDEPTID', '=', 'departments.DEPTID')
            ->join('leaveclass', 'absensi.leaveclass_id', '=', 'leaveclass.LEAVEID')
            ->join('penyetuju_absensi', 'penyetuju_absensi.absensi_id', '=', 'absensi.id')
            ->select([
                'penyetuju_absensi.id',
                'userinfo.Name',
                'leaveclass.LEAVENAME',
                'penyetuju_absensi.absensi_id',
                'absensi.tanggal_mulai',
                'absensi.tanggal_selesai',
                'penyetuju_absensi.penanggungjawab_id',
                'penyetuju_absensi.status'
            ])
            ->where('penyetuju_absensi.penanggungjawab_id', '=', $userId)
            ->get();

        $absensi = [];

        foreach ($absensiTable as $absensiRow) {
            $temp = [];
            $temp['id'] = $absensiRow->id;
            $temp['nama_karyawan'] = $absensiRow->Name;
            $temp['tipe_izin'] = $absensiRow->LEAVENAME;
            $temp['tanggal_mulai'] = $absensiRow->tanggal_mulai;
            $temp['tanggal_selesai'] = $absensiRow->tanggal_selesai;
            $temp['absensi_id'] = $absensiRow->absensi_id;
            $temp['penanggungjawab_id'] = $absensiRow->penanggungjawab_id;
            $temp['status'] = $absensiRow->status;

            $absensi[] = $temp;
        }
        return $absensi;
    }

    public function permitDetail($penyetujuAbsensiId, $absensiId, $penanggungJawabId)
    {
        $absensiTable = DB::table('absensi')
            ->join('userinfo', 'absensi.user_id', '=', 'userinfo.USERID')
            ->join('departments', 'userinfo.DEFAULTDEPTID', '=', 'departments.DEPTID')
            ->join('leaveclass', 'absensi.leaveclass_id', '=', 'leaveclass.LEAVEID')
            ->join('penyetuju_absensi', 'penyetuju_absensi.absensi_id', '=', 'absensi.id')
            ->select([
                'penyetuju_absensi.id',
                'userinfo.Name',
                'departments.DEPTNAME',
                'leaveclass.LEAVENAME',
                'absensi.tanggal_pengajuan',
                'absensi.tanggal_mulai',
                'absensi.tanggal_selesai',
                'absensi.alasan'
            ])
            ->where('penyetuju_absensi.id', '=', $penyetujuAbsensiId)
            ->where('penyetuju_absensi.penanggungjawab_id', '=', $penanggungJawabId)
            ->where('penyetuju_absensi.absensi_id', '=', $absensiId)
            ->first();

            $absensi = [];
            if(empty($absensiTable)) {
                throw new \Exception("invalid id: {$penyetujuAbsensiId}, absensi_id: {$absensiId}, penanggungjawab_id: {$penanggungJawabId}");
            } 
            $absensi['id'] = $absensiTable->id;
            $absensi['nama_karyawan'] = $absensiTable->Name;
            $absensi['department'] = $absensiTable->DEPTNAME;
            $absensi['jabatan'] = $absensiTable->DEPTNAME;
            $absensi['tipe_izin'] = $absensiTable->LEAVENAME;
            $absensi['tanggal_pengajuan'] = $absensiTable->tanggal_pengajuan;
            $absensi['tanggal_mulai'] = $absensiTable->tanggal_mulai;
            $absensi['tanggal_selesai'] = $absensiTable->tanggal_selesai;
            $absensi['alasan'] = $absensiTable->alasan;

            return $absensi;
    }

    public function acceptOrReject($persetujuanId, $penanggungJawabId, $option)
    {
        $tanggalUpdate = new DateTimeImmutable();

        DB::table('penyetuju_absensi')
            ->where('id', '=', $persetujuanId)
            ->where('penanggungjawab_id', '=', $penanggungJawabId)
            ->update([
                'status' => $option,
                'tanggal_update' => $tanggalUpdate
            ]);


        // cek cuti
        DB::transaction(function() use ($persetujuanId, $penanggungJawabId) {
            $penyetujuAbsensiTable = DB::table('penyetuju_absensi')
                ->where('id', '=', $persetujuanId)
                ->select(['absensi_id'])
                ->first();
            
            $nonPendingStatus = DB::table('penyetuju_absensi')
                ->where('absensi_id', '=', $penyetujuAbsensiTable->absensi_id)
                ->where('status', '!=', 'pending')
                ->count();
    
            if ($nonPendingStatus == 0) {
                $penyetujuAbsensiTable2 = DB::table('penyetuju_absensi as p')
                    ->join('absensi as a', 'a.id', '=', 'p.absensi_id')
                    ->where('p.id', '=', $persetujuanId)
                    ->where('p.penanggungjawab_id', '=', $penanggungJawabId)
                    ->select(['a.user_id', 'a.tanggal_pengajuan'])
                    ->first();
                
                $year = explode(' ', $penyetujuAbsensiTable2->tanggal_pengajuan)[0];
                $year = explode('-', $year)[0];
    
    
                DB::table('leave_allowance')
                    ->where('user_id', '=', $penyetujuAbsensiTable2->user_id)
                    ->where('year', '=', intval($year))
                    ->decrement('allowance');
            }
        });
    }
}
