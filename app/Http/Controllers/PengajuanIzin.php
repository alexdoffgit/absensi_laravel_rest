<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\PengajuanIzin as IPengajuanIzin;
use Illuminate\Support\Facades\DB;

class PengajuanIzin extends Controller
{
    public function __construct(private IPengajuanIzin $store) { }

    public function create(Request $request, string $karyawanname) {
        $tanggalPengajuan = $request->input("tanggal_pengajuan");
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalSelesai = $request->input('tanggal_selesai');
        $atasanId = intval($request->input('atasan_id'));
        $tipeIzin = intval($request->input('tipe_izin'));
        $alasan = $request->input('alasan');

        $karyawan = DB::table('userinfo')->select('USERID')->where('Name', '=', $karyawanname)->first();

        $internalData = [
            'tanggal_pengajuan' => $tanggalPengajuan,
            'tanggal_mulai' => $tanggalMulai,
            'tanggal_selesai' => $tanggalSelesai,
            'atasan_id' => $atasanId,
            'tipe_izin' => $tipeIzin,
            'alasan' => $alasan
        ];

        $isSuccess = $this->store->create($karyawan->USERID, $internalData);
    }

    public function persetujuanIzin(Request $request, string $atasanid, string $listizinid)
    {
        $status = intval($request->input('accrej'));
        $this->store->persetujuanIzin($status, intval($atasanid), intval($listizinid));
    }
}
