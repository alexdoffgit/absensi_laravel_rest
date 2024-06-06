<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
