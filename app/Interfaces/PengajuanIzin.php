<?php

namespace App\Interfaces;

interface PengajuanIzin
{
    public function create($karyawanId, $requestData);
    public function persetujuanIzin($status, $atasanid, $listizinid);
}
