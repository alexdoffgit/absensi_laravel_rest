<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Atasan\Perizinan as AtasanIzin;
use App\Http\Controllers\HR\Perizinan as HRIzin;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PengajuanIzin;
use App\Http\Controllers\Kehadiran;
use App\Http\Controllers\PermitTracking;
use App\Http\Controllers\PermitTrackingController;

Route::get('/', [AuthController::class, 'loginView']);

Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerView']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/{uid}', [Dashboard::class, 'dashboardView']);

Route::get('/{uid}/kehadiran', [Kehadiran::class, 'index']);

Route::get('/{uid}/pengajuan-izin', [PengajuanIzin::class, 'createView']);
Route::post('/{uid}/pengajuan-izin', [PengajuanIzin::class, 'createWeb']);

Route::get('/{atasanid}/atasan/permit-summaries', [AtasanIzin::class, 'permitSummaries']);
Route::get('/{id}/atasan/{absensiid}/{penanggungjawabid}', [AtasanIzin::class, 'permitDetail']);
Route::get('/{atasanid}/atasan/{id}/{option}', [AtasanIzin::class, 'acceptOrReject']);

Route::get('/{hrid}/hr/permit-summaries', [HRIzin::class, 'permitSummaries']);
Route::get('/{id}/hr/{absensiid}/{penanggungjawabid}', [HRIzin::class, 'permitDetail']);
Route::get('/{hrid}/hr/{id}/{option}', [HRIzin::class, 'acceptOrReject']);

Route::get('/{uid}/permit-tracking', [PermitTrackingController::class, 'index']);