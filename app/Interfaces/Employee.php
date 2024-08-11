<?php

namespace App\Interfaces;

interface Employee 
{
    public function getPresensi($userId, $week);
    public function getAbsensi($userId);
    public function getAtasanByKaryawanId($karyawanId);
    
    /**
     * @param int $uid
     * @return 'hr'|'manager'|'staff'|'IT'
     * @throws App\Exceptions\EmployeeNotFoundException
     */
    public function getRoles($uid);


    /**
     * @return list<array{
     *   user_id: int,
     *   badgenumber: string,
     *   fullname: string,
     *   ssn: string,
     *   department_name: string
     * }>
     */
    public function findAllForHR();
}