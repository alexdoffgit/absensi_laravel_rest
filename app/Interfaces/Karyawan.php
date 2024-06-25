<?php

namespace App\Interfaces;

interface Karyawan 
{
    public function getPresensi($userId, $week);
    public function getAbsensi($userId);
    public function getAtasanByKaryawanId($karyawanId);
    
    /**
     * @param int $uid
     * @return 'hr'|'manager'|'staff'
     * @throws App\Exceptions\EmployeeNotFoundException
     */
    public function getRoles($uid);
}