<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

use App\Interfaces\Karyawan as KI;
use App\Repository\Karyawan as KR;

use App\Interfaces\PengajuanIzin as PI;
use App\Repository\PengajuanIzin as PR;

use App\Interfaces\PersetujuanIzin as PRIZI;
use App\Repository\PersetujuanIzin as PRIZR;

use App\Interfaces\Authentication as AUI;
use App\Repository\Authentication as AUR;

use App\Interfaces\PermitTracking as PTI;
use App\Repository\PermitTracking as PTR;

use App\Interfaces\TimeHelper as ITH;
use App\Repository\TimeHelper as RTH;

use App\Interfaces\Kehadiran as IKE;
use App\Repository\Kehadiran as RKE;

use App\Interfaces\Schedule as ISchedule;
use App\Repository\Schedule as ScheduleRepo;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(KI::class, KR::class);
        $this->app->bind(PI::class, PR::class);
        $this->app->bind(PRIZI::class, PRIZR::class);
        $this->app->bind(AUI::class, AUR::class);
        $this->app->bind(PTI::class, PTR::class);
        $this->app->bind(ITH::class, RTH::class);
        $this->app->bind(IKE::class, RKE::class);
        $this->app->bind(ISchedule::class, ScheduleRepo::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
