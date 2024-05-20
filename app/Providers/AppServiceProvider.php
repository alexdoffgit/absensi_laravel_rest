<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\Karyawan as KI;
use App\Repository\Karyawan as KR;

use App\Interfaces\PengajuanIzin as PI;
use App\Repository\PengajuanIzin as PR;

use App\Interfaces\PersetujuanIzin as PRIZI;
use App\Repository\PersetujuanIzin as PRIZR;

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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
