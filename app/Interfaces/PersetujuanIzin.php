<?php

namespace App\Interfaces;

interface PersetujuanIzin
{
    public function permitSummaries($userId);
    public function permitDetail($penyetujuAbsensiId, $absensiId, $penanggungJawabId);
    public function acceptOrReject($persetujuanId, $atasanId, $option);
}
