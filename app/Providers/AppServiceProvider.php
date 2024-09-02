<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

// use App\Interfaces\Employee as IEmployee;
// use App\Repository\Employee as EmployeeRepo;

// use App\Interfaces\LeaveSubmission as ILeaveSubmission;
// use App\Repository\LeaveSubmission as LeaveSubmissionRepo;

// use App\Interfaces\LeaveApproval as ILeaveApproval;
// use App\Repository\LeaveApproval as LeaveApprovalRepo;

use App\Interfaces\Authentication as IAuthentication;
use App\Services\Authentication as AuthenticationService;

// use App\Interfaces\LeaveTracking as ILeaveTracking;
// use App\Repository\LeaveTracking as LeaveTrackingRepo;

// use App\Interfaces\TimeHelper as ITimeHelper;
// use App\Repository\TimeHelper as TimeHelperRepo;

// use App\Interfaces\Attendance as IAttendance;
// use App\Repository\Attendance as AttendanceRepo;

// use App\Interfaces\Schedule as ISchedule;
// use App\Repository\Schedule as ScheduleRepo;

use App\Interfaces\Menu as IMenu;
use App\Repository\Menu as MenuRepo;
use App\Repository\Json\Menu as MenuMemoryRepo;

use App\Interfaces\AccessManagement as IAccessManagement;
use App\Repository\AccessManagement as AccessManagementRepo;
use App\Repository\Json\AccessManagement as AccessManagementMemory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    //     $this->app->bind(IAttendance::class, AttendanceRepo::class);
    //     $this->app->bind(IEmployee::class, EmployeeRepo::class);
    //     $this->app->bind(ILeaveSubmission::class, LeaveSubmissionRepo::class);
        $this->app->bind(IAuthentication::class, AuthenticationService::class);
        // $this->app->bind(ILeaveApproval::class, LeaveApprovalRepo::class);
        // $this->app->bind(ITimeHelper::class, TimeHelperRepo::class);
        // $this->app->bind(ILeaveTracking::class, LeaveTrackingRepo::class);
        // $this->app->bind(ISchedule::class, ScheduleRepo::class);
        $this->app->bind(IMenu::class, MenuMemoryRepo::class);
        $this->app->bind(IAccessManagement::class, AccessManagementMemory::class);

        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {}
}
