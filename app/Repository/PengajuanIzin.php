<?php

namespace App\Repository;

use App\Interfaces\PengajuanIzin as PI;
use Illuminate\Support\Facades\DB;

class PengajuanIzin implements PI
{
    public function create($karyawanId, $requestData)
    {
        $tableData = [
            'user_id' => $karyawanId,
            'keterangan' => $requestData['alasan'],
            'leaveclass_id' => $requestData['tipe_izin'],
            'tanggal' => $requestData['tanggal_pengajuan'],
            'tanggal_awal' => $requestData['tanggal_mulai'],
            'tanggal_akhir' => $requestData['tanggal_selesai']
        ];

        return DB::table('absensi')->insert($tableData);
    }

    public function persetujuanIzin($status, $atasanid, $listizinid)
    {
        DB::table('list_atasan_pengajuan_izin')
            ->where('id', '=', $listizinid)
            ->where('atasan_id', '=', $atasanid)
            ->update([
                'status_izin' => $status
            ]);
    }
}
