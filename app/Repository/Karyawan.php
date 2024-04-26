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
}