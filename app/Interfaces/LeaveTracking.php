<?php

namespace App\Interfaces;

interface LeaveTracking
{
    public function summary($uid);
    public function detail($absensiId);
}
