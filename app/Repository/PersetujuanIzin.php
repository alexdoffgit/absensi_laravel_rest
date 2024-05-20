<?php

namespace App\Repository;

use App\Interfaces\PersetujuanIzin as PI;
use Illuminate\Support\Facades\DB;
use DateTimeImmutable;


class PersetujuanIzin implements PI
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

    public function acceptOrReject($persetujuanId, $atasanId, $option)
    {
        $tanggalUpdate = new DateTimeImmutable();

        DB::table('penyetuju_absensi')
            ->where('id', '=', $persetujuanId)
            ->where('penanggungjawab_id', '=', $atasanId)
            ->update([
                'status' => $option,
                'tanggal_update' => $tanggalUpdate
            ]);
    }
}
