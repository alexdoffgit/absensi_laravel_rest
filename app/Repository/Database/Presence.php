<?php

namespace App\Repository\Database;

use App\Options\PresenceOption;
use App\Models\Presence as PresenceModel;
use App\Options\CheckinoutOption;
use Illuminate\Support\Facades\DB;

class Presence {
    public function __construct(private Checkinout $checkinout) {}

    public function getEmployeePresence(PresenceOption $options) {
        return DB::transaction(function() use ($options) {
            $presenceData = PresenceModel::whereDate('work_date_start', '>=', $options->period['start'])
                ->whereDate('work_date_end', '<=', $options->period['end'])
                ->where('user_id', '=', $options->employeeID)
                ->get()
                ->toArray();

            if (empty($presenceData)) {
                return $this->createEmployeePresenceFromCheckinout(new CheckinoutOption(
                    $options->employeeID,
                    $options->period
                ));
            } else {
                return $presenceData;
            }
        });
    }

    private function createEmployeePresenceFromCheckinout(CheckinoutOption $options)
    {

    }
}