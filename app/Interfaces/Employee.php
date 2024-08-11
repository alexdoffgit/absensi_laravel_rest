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

    /**
     * @param array{
     *   badgenumber: string,
     *   ssn: string,
     *   fullname: string,
     *   text_password: string,
     *   department_id: int
     * } $employeeData
     * @return \App\Models\User
     * @throws \Illuminate\Database\QueryException
     */
    public function insertEmployee($employeeData);

    /**
     * @param array{
     *   id: int,
     *   badgenumber: string|null,
     *   ssn: string|null,
     *   fullname: string|null,
     *   text_password: string|null,
     *   department_id: int|null
     * } $employeeData
     * @return \App\Models\User
     * @throws \Illuminate\Database\QueryException
     * @throws \App\Exceptions\InvalidPasswordException
     */
    public function updateEmployee($employeeData);

    /**
     * @param int @id
     * @return void
     * @throws \Illuminate\Database\QueryException
     */
    public function deleteEmployee($id);
}