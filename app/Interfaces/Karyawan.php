<?php

namespace App\Interfaces;

interface Karyawan 
{
    public function getPresensi($userId, $week);
    public function getAbsensi($userId);
    public function getAtasanByKaryawanId($karyawanId);
    public function isLowestDepartment($deptId);
    public function isHighestDepartment($deptId);
}