<?php

namespace App\Interfaces;

interface Schedule
{
    /**
     * @return list<array{
     *   id: int,
     *   schedule_name: string,
     *   time_start: string,
     *   time_end: string
     * }>
     */
    public function listSummary();
    /**
     * @param array{
     *   schedule_name: string,
     *   time_start: string,
     *   time_end: string
     * } $data
     */
    public function create($data);
}
