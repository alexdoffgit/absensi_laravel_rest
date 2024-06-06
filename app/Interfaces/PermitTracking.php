<?php

namespace App\Interfaces;

interface PermitTracking
{
    public function summary($uid);
    public function detail($absensiId);
}
