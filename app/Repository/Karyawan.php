<?php

namespace App\Repository;

use App\Interfaces\Karyawan as KI;
use Illuminate\Support\Facades\DB;

class Karyawan implements KI
{
    public function getAbsensi($userId)
    {
        return DB::table('checkinout')
            ->where('USERID', $userId)
            ->get(['CHECKTIME', 'CHECKTYPE']);
    }
}