<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\Karyawan as KI;
use App\Repository\Karyawan as KR;

use App\Interfaces\PengajuanIzin as PI;
use App\Repository\PengajuanIzin as PR;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(KI::class, KR::class);
        $this->app->bind(PI::class, PR::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
