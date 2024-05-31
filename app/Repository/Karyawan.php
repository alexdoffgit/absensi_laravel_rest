<?php

namespace App\Repository;

use App\Interfaces\Karyawan as KI;
use Illuminate\Support\Facades\DB;
use DateTimeImmutable;
use DateInterval;

class Karyawan implements KI
{
    // TODO: tambahkan filter berapa banyak yang harus aku ambil, gimana kalau take(1000) untuk pengambilan data awal dan belum di filter?
    public function getPresensi($userId)
    {
        // // ambil data dari database
        $queryResult = DB::table('checkinout')
                        ->where('USERID', $userId)
                        ->get(['CHECKTIME', 'CHECKTYPE'])
                        ->take(50)
                        ->toArray();

        // // ubah CHECKTIME dari string ke DateTimeImmutable
        $presensi = [];
        for ($i = 0; $i < count($queryResult); $i++) {
            $singlePresensi = [];
            $checkdatetime = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $queryResult[$i]->CHECKTIME);
            $checkdate = $checkdatetime->format('Y-m-d');
            $checktime = $checkdatetime->format('H:i:s');
            
            $singlePresensi['type'] = $queryResult[$i]->CHECKTYPE;
            $singlePresensi['datetime'] = $checkdatetime;
            $singlePresensi['date'] = $checkdate;
            $singlePresensi['time'] = $checktime;
            $presensi[] = $singlePresensi; 
        }

        // // pisahkan antara jam datang dan jam pulang
        $datang = [];
        $pulang = [];
        for($i = 0; $i < count($presensi); $i++) {
            if($presensi[$i]['type'] == 'I') {
                $datang[] = $presensi[$i];
            }

            if($presensi[$i]['type'] == 'O') {
                $pulang[] = $presensi[$i];
            }
        }

        // // kelompokkan berdasarkan datang, pulang, hari
        $result = [];
        for($i = 0; $i < count($datang); $i++) {
            $tempResult = [];
            for($j = 0; $j < count($pulang); $j++) {
                if($datang[$i]['date'] == $pulang[$j]['date']) {
                    $tempResult['tanggal'] = $datang[$i]['date'];
                    $tempResult['jam_masuk'] = $datang[$i]['time'];
                    $tempResult['jam_pulang'] = $pulang[$j]['time'];
                    $result[] = $tempResult;
                    break;
                }
            }
        }

        // return $queryResult;
        // return $presensi;
        // return ['datang' => $datang, 'pulang' => $pulang];
        return $result;
    }

    // TODO: tambahkan filter berapa banyak yang aku ambil
    // take(1000) untuk default, aku ngga tahu, maksudnya aku pingin paginasi tapi aku belum tahu implementasinya gimana
    public function getAbsensi($userId) {
        $queryResult = DB::table('user_speday')
                    ->join('leaveclass', 'user_speday.DATEID', '=', 'leaveclass.LEAVEID')
                    ->where('user_speday.USERID', '=', $userId)
                    ->select(['user_speday.STARTSPECDAY', 'user_speday.ENDSPECDAY', 'leaveclass.LEAVENAME', 'user_speday.date'])
                    ->take(50)
                    ->get();


        $transfomedQueryResults = [];
        foreach ($queryResult as $qr) {
            $temp = [];
            $datetimeMasuk = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $qr->STARTSPECDAY);
            $datetimePulang = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $qr->ENDSPECDAY);
            if(!empty($qr->date)) {
                $date = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $qr->date);
            }
            
            $temp['jam_masuk'] = $datetimeMasuk->format('H:i');
            $temp['jam_pulang'] = $datetimePulang->format('H:i');
            $temp['tanggal'] = isset($date) ? $date->format('Y-m-d') : null;
            
            $temp['tipe_absen'] = $qr->LEAVENAME;
            $transfomedQueryResults[] = $temp;
        }



        return $transfomedQueryResults;
    }

    public function getAtasanByKaryawanId($karyawanId)
    {
        $jabatan = DB::table('jabatan')->select('atasan_id')->where('user_id', '=', $karyawanId)->first();
        return $jabatan->atasan_id;
    }
}