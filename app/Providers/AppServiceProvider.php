<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\Karyawan as KI;
use App\Repository\Karyawan as KR;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(KI::class, KR::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
