<?php

namespace App\Repository\Database;

use App\Exceptions\ManagerNotFoundException;
use App\Interfaces\LeaveSubmission as ILeaveSubmission;
use App\Models\Absence;
use App\Models\AbsenceApproval;
use App\Models\LeaveClass;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\UserManager;

class LeaveSubmission implements ILeaveSubmission
{
    public function create($leaveSubmissionFormData)
    {
        DB::transaction(function() use ($leaveSubmissionFormData) {
    
            $absence = Absence::create($leaveSubmissionFormData);
    
            $manager = $this->getManagerIdAndName($leaveSubmissionFormData['user_id']);

            $absenceApprovalManager = [
                'absence_id' => $absence->id,
                'approver_user_id' => $manager['id'],
            ];
    
            $hrId = 54;

            $userinfoHR = User::where('DEFAULTDEPTID', '=', $hrId)
            ->select(['USERID'])
            ->first();
            
            $absenceApprovalHR = [
                'absence_id' => $absence->id,
                'approver_user_id' => $userinfoHR->USERID,
            ];

            AbsenceApproval::create($absenceApprovalManager);
            AbsenceApproval::create($absenceApprovalHR);
        });

    }

    public function getManagerIdAndName($employeeId)
    {
        // TODO: implement this feature based on date and leave
        $userManager = UserManager::where('user_id', '=', $employeeId)
            ->first();
        if (empty($userManager)) {
            throw new ManagerNotFoundException($employeeId);
        }

        return [
            'id' => $userManager->head_manager->USERID,
            'name' => $userManager->head_manager->fullname
        ];
    }

    public function persetujuanIzin($status, $atasanid, $listizinid)
    {
        DB::table('list_atasan_pengajuan_izin')
            ->where('id', '=', $listizinid)
            ->where('atasan_id', '=', $atasanid)
            ->update([
                'status_izin' => $status
            ]);
    }

    public function getLeaveIdsAndTypes()
    {
        $leaves = LeaveClass::select(['LEAVEID', 'LEAVENAME'])
            ->get()
            ->map(function($item) {
                return [
                    'id' => $item->LEAVEID,
                    'type' => $item->LEAVENAME
                ];
            });
        return $leaves;
    }
}
