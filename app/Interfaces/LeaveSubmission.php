<?php

namespace App\Interfaces;

interface LeaveSubmission
{
    public function create($leaveSubmissionFormData);
    public function persetujuanIzin($status, $atasanid, $listizinid);
    public function getLeaveIdsAndTypes();
    public function getManagerIdAndName($employeeId);
}
