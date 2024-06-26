<?php

namespace App\Interfaces;

interface Kehadiran
{
    /**
     * @param int $uid
     * @param \DateTimeImmutable $date
     * @return array<int, array{
     *   start: string,
     *   end: string,
     *   color: 'red'|'green',
     *   display: 'background'
     * }>
     * @throws App\Exceptions\EmployeeNotFoundException
     */
    public function getScheduleByEmployeeIdAndDate($uid, $date);
    
    /**
     * @param int $deptId
     * @param array{
     *   time: 'week'|'month',
     *   page: int
     * }|null $options
     * @return list<object{
     *   id: int,
     *   work_date_start: string,
     *   work_date_end: string,
     *   checkin: string,
     *   checkout: string,
     *   istirahat_start: string|null,
     *   istirahat_end: string|null,
     *   istirahat_start_schedule: string|null,
     *   istirahat_end_schedule: string|null,
     *   username: string,
     *   user_id: int
     * }>
     * @throws App\Exceptions\DepartmentNotFoundException
     */
    public function getPresenceFiltered($deptId, $options);

    /**
     * @param \DateTimeImmutable $date
     * @param array{
     *   deptId: int,
     *   userId?: int
     * } $options
     * @return list<object{
     *   id: int,
     *   work_date_start: string,
     *   work_date_end: string,
     *   checkin: string,
     *   checkout: string,
     *   istirahat_start: string|null,
     *   istirahat_end: string|null,
     *   istirahat_start_schedule: string|null,
     *   istirahat_end_schedule: string|null,
     *   username: string,
     *   user_id: int
     * }>
     */
    public function getPresencePerDay($date, $options);

    /**
     * @param \DateTimeImmutable $date
     * @param int $deptId
     * @param array{userId?: int} $options
     * @return list<array{
     *   id: int,
     *   user_id: int,
     *   tanggal_pengajuan: string,
     *   tanggal_mulai: string,
     *   tanggal_selesai: string,
     *   alasan: string,
     *   dokumen_pendukung: string,
     *   tipe_absen: string
     * }>
     */
    public function getAbsencePerDay($date, $deptId, $options);
}