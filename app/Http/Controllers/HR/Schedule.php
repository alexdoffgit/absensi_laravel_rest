<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\Schedule as ISchedule;

class Schedule extends Controller
{
    public function __construct(private ISchedule $scheduleStore) {}

    // public function
}
