<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HR\EmployeesAttendanceController as HREmployeeAttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Test;

Route::get('/', [AuthController::class, 'loginView']);

Route::prefix('test')->group(function () {
    Route::get('/', [Test::class, 'index']);
});

Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerView']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/hr/attendance/analysis', [HREmployeeAttendanceController::class, 'index']);


