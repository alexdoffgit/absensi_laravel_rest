<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Test;

Route::prefix('test')->group(function () {
    Route::get('/', [Test::class, 'index']);
});


// Route::get('/hr/attendance/analysis', [HREmployeeAttendanceController::class, 'index'])
//     ->middleware(HRMenuAccessMiddleware::class);

// Route::get('/manager/attendance/analysis', [ManagerEmployeeAttendanceController::class, 'index'])
//     ->middleware(ManagerAccessMiddleware::class);


$menuTable = $menuTable = DB::table('menu_links as ml')
    ->whereNotNull('ml.laravel_controller_class')
    ->whereNotNull('ml.laravel_controller_method')
    ->whereNotNull('ml.http_method')
    ->select([
        'ml.id',
        'ml.menu_path',
        'ml.laravel_controller_class',
        'ml.laravel_controller_method',
        'ml.laravel_middleware',
        'ml.http_method'
    ])
    ->get();

foreach ($menuTable as $menuRow) {
    if (!empty($menuRow->laravel_middleware)) {
        Route::match(
            $menuRow->http_method, 
            $menuRow->menu_path, 
            [$menuRow->laravel_controller_class, $menuRow->laravel_controller_method]
        )
        ->middleware($menuRow->laravel_middleware);
    } else {
        Route::match(
            $menuRow->http_method, 
            $menuRow->menu_path, 
            [$menuRow->laravel_controller_class, $menuRow->laravel_controller_method]
        );
    }
}