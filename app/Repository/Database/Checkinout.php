<?php

namespace App\Repository\Database;

use App\Models\Checkinout as CheckinoutModel;
use App\Options\CheckinoutOption;

class Checkinout {
    public function getCheckinoutDataByOption(CheckinoutOption $option)
    {
        return CheckinoutModel::whereDate('CHECKTIME', '>=', $option->period['start'])
            ->whereDate('CHECKTIME', '<=', $option->period['end'])
            ->where('USERID', '=', $option->employeeId)
            ->get()
            ->toArray();
    }
}