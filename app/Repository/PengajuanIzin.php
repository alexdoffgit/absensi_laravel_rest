<?php

namespace App\Repository;

use App\Interfaces\PengajuanIzin as PI;
use Illuminate\Support\Facades\DB;

class PengajuanIzin implements PI
{
    public function create($karyawanId, $requestData)
    {
        DB::transaction(function() use ($karyawanId, $requestData) {
            $tableData = [
                'user_id' => $karyawanId,
                'alasan' => $requestData['alasan'],
                'leaveclass_id' => $requestData['tipe_izin'],
                'tanggal_pengajuan' => $requestData['tanggal_pengajuan'],
                'tanggal_mulai' => $requestData['tanggal_mulai'],
                'tanggal_selesai' => $requestData['tanggal_selesai']
            ];
    
            $absensiId = DB::table('absensi')->insertGetId($tableData);
    
            $listAtasan = $this->getListAtasanId($karyawanId, $requestData['atasan_id']);
    
            $dataPenyetujuAbsen = [];
    
            foreach ($listAtasan as $value) {
                $satuPenyetuju = [
                    'absensi_id' => $absensiId,
                    'karyawan_id' => $karyawanId,
                    'penanggungjawab_id' => $value,
                    'tanggal_pembuatan' => $tableData['tanggal_pengajuan']
                ];
    
                $dataPenyetujuAbsen[] = $satuPenyetuju;
            }
    
            DB::table('penyetuju_absensi')->insert($dataPenyetujuAbsen);
        });

    }

    private function getListAtasanId($karyawanId, $firstAtasan)
    {
        $karyawanDepartment = DB::table('userinfo')->select(['DEFAULTDEPTID'])->where('USERID', '=', $karyawanId)->first();
        $listAtasanId = [$firstAtasan];

        if(!empty($karyawanDepartment)) {
            $listDepartment = $this->getDepartmentChain($karyawanDepartment->DEFAULTDEPTID);
        }

        if(isset($listDepartment)) {
            if(count($listDepartment) > 1) {
                for($i = 1; $i < count($listDepartment) - 1; $i++) {
                    $userInfoAtasan = DB::table('userinfo')
                        ->select(['USERID'])
                        ->where('DEFAULTDEPTID', '=', $listDepartment[$i])
                        ->first();
                    
                    if(!empty($userInfoAtasan)) {
                        $listAtasanId[] = $userInfoAtasan->USERID;
                    }
                }
            }
        }
        return $listAtasanId;
    }

    private function getDepartmentChain($id)
    {
        $departmentParentList = [];
        $currDept = $id;
        while($currDept != 1) {
            $dbTable = DB::table('departments')
            ->select(['SUPDEPTID'])
            ->where('DEPTID', '=', $currDept)
            ->first();
            
            $currDept = $dbTable->SUPDEPTID;
            $departmentParentList[] = $currDept;
        }
        array_pop($departmentParentList);
        return $departmentParentList;
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

    public function tipeIzin()
    {
        $tabelLeaveClass = DB::table('leaveclass')
            ->select(['LEAVEID', 'LEAVENAME'])
            ->get();
        return $tabelLeaveClass;
    }

    public function getAtasanByKaryawanId($id)
    {
        // TODO: cari siapa yang akan setuju kalau user tidak ada
        $userinfoTable = DB::table('userinfo')
            ->select('DEFAULTDEPTID')
            ->where('USERID', '=', $id)
            ->first();
        $departmentTable = DB::table('departments')
            ->select('SUPDEPTID')
            ->where('DEPTID', '=', $userinfoTable->DEFAULTDEPTID)
            ->first();
        $userinfoAtasanTable = DB::table('userinfo')
            ->select('USERID', 'Name')
            ->where('DEFAULTDEPTID', '=', $departmentTable->SUPDEPTID)
            ->get();

        return $userinfoAtasanTable;
    }
}
