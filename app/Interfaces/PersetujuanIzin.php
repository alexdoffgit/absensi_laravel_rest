<?php

namespace App\Interfaces;

interface PersetujuanIzin
{
    public function daftarIzin($userid);
    public function acceptOrReject($persetujuanId, $atasanId, $option);
}
