<?php

namespace App\Providers;

use App\Database\Query\Grammars\MariaDBGrammar;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

use App\Interfaces\Employee as IEmployee;
use App\Repository\Employee as EmployeeRepo;

use App\Interfaces\LeaveSubmission as ILeaveSubmission;
use App\Repository\LeaveSubmission as LeaveSubmissionRepo;

use App\Interfaces\LeaveApproval as ILeaveApproval;
use App\Repository\LeaveApproval as LeaveApprovalRepo;

use App\Interfaces\Authentication as IAuthentication;
use App\Repository\Authentication as AuthenticationRepo;

use App\Interfaces\PermitTracking as IPermitTracking;
use App\Repository\PermitTracking as PermitTrackingRepo;

use App\Interfaces\TimeHelper as ITimeHelper;
use App\Repository\TimeHelper as TimeHelperRepo;

use App\Interfaces\Attendance as IAttendance;
use App\Repository\Attendance as AttendanceRepo;

use App\Interfaces\Schedule as ISchedule;
use App\Repository\Schedule as ScheduleRepo;

use App\Interfaces\Menu as IMenu;
use App\Repository\Menu as MenuRepo;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IAttendance::class, AttendanceRepo::class);
        $this->app->bind(IEmployee::class, EmployeeRepo::class);
        $this->app->bind(ILeaveSubmission::class, LeaveSubmissionRepo::class);
        $this->app->bind(IAuthentication::class, AuthenticationRepo::class);
        $this->app->bind(ILeaveApproval::class, LeaveApprovalRepo::class);
        $this->app->bind(ITimeHelper::class, TimeHelperRepo::class);
        $this->app->bind(IPermitTracking::class, PermitTrackingRepo::class);
        $this->app->bind(ISchedule::class, ScheduleRepo::class);
        $this->app->bind(IMenu::class, MenuRepo::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        DB::connection()->setQueryGrammar(new MariaDBGrammar);
    }
}
