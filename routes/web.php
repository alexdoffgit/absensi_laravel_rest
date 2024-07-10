<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Http\Middleware\HRMenuAccessMiddleware;
use App\Http\Middleware\ManagerAccessMiddleware;

use App\Http\Controllers\HR\EmployeesAttendanceController as HREmployeeAttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Test;
use App\Http\Controllers\Manager\EmployeesAttendanceController as ManagerEmployeeAttendanceController;

Route::get('/', [AuthController::class, 'loginView']);

Route::prefix('test')->group(function () {
    Route::get('/', [Test::class, 'index']);
});

Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerView']);
Route::post('/register', [AuthController::class, 'register']);

// Route::get('/hr/attendance/analysis', [HREmployeeAttendanceController::class, 'index'])
//     ->middleware(HRMenuAccessMiddleware::class);

// Route::get('/manager/attendance/analysis', [ManagerEmployeeAttendanceController::class, 'index'])
//     ->middleware(ManagerAccessMiddleware::class);

$menuTable = DB::table('menu_links')
    ->whereNotNull('laravel_controller_class')
    ->whereNotNull('laravel_controller_method')
    ->whereNotNull('http_method')
    ->select([
        'menu_path', 
        'laravel_controller_class', 
        'laravel_controller_method', 
        'laravel_middleware',
        'http_method'
    ])
    ->get();

foreach ($menuTable as $menuRow) {
    if (!empty($menuRow->laravel_middleware)) {
        Route::match(
            [$menuRow->http_method], 
            $menuRow->menu_path, 
            [$menuRow->laravel_controller_class, $menuRow->laravel_controller_method]
        )
        ->middleware($menuRow->laravel_middleware);
    } else {
        Route::match(
            [$menuRow->http_method], 
            $menuRow->menu_path, 
            [$menuRow->laravel_controller_class, $menuRow->laravel_controller_method]
        );
    }
}

Route::get('/attendance/analysis', function() {
    return view('welcome', ['userId' => session()->get('userId')]);
});