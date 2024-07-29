<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\LeaveSubmission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LeaveSubmissionController extends Controller
{
    public function __construct(private LeaveSubmission $store) { }

    public function createView(Request $request) {
        $karyawanid = Auth::user()->USERID;

        return view('leave-submission', [
            'karyawanId' => $karyawanid,
            'semuaIzin' => $this->store->tipeIzin(),
            'semuaAtasan' => $this->store->getAtasanByKaryawanId($karyawanid)
        ]);
    }

    public function createWeb(Request $request, $karyawanid) {
        $data = $request->validate([
            'tanggal_pengajuan' => 'required|date_format:Y-m-d',
            'daterange' => 'required|date_format:Y-m-d',
            'selesai_izin' => 'required|date_format:Y-m-d',
            'atasan' => 'numeric',
            'izin' => 'numeric',
            'alasan' => 'nullable',
            'dokumen' => 'nullable|file|mimes:pdf|max:10240'
        ]);

        if($request->hasFile('dokumen')) {
            $filePath = null;
            $filePath = $request->file('dokumen')->store('uploads', 'public');
            $inDatabase = [
                'tanggal_pengajuan' => $data['tanggal_pengajuan'],
                'tanggal_mulai' => $data['mulai_izin'],
                'tanggal_selesai' => $data['selesai_izin'],
                'atasan_id' => $data['atasan'],
                'tipe_izin' => $data['izin'],
                'alasan' => $data['alasan'],
                'dokumen_pendukung' => $filePath
            ];
        } else {
            $inDatabase = [
                'tanggal_pengajuan' => $data['tanggal_pengajuan'],
                'tanggal_mulai' => $data['mulai_izin'],
                'tanggal_selesai' => $data['selesai_izin'],
                'atasan_id' => $data['atasan'],
                'tipe_izin' => $data['izin'],
                'alasan' => $data['alasan'],
            ];
        }
        
        $this->store->create(intval($karyawanid), $inDatabase);

        return redirect()->back();
    }

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
