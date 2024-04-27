<?php

namespace App\Interfaces;

interface Karyawan 
{
    public function getPresensi($userId);
    public function getAbsensi($userId);
}