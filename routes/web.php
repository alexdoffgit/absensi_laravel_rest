<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Atasan\Perizinan as AtasanIzin;
use App\Http\Controllers\HR\Perizinan as HRIzin;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PengajuanIzin;
use App\Http\Controllers\Kehadiran;

Route::get('/', [AuthController::class, 'loginView']);

Route::post('/login', [AuthController::class, 'login']);

Route::get('/{uid}', [Dashboard::class, 'dashboardView']);

Route::get('/{uid}/kehadiran', [Kehadiran::class, 'index']);

Route::get('/{uid}/pengajuan-izin', [PengajuanIzin::class, 'createView']);
Route::post('/{uid}/pengajuan-izin', [PengajuanIzin::class, 'createWeb']);

Route::get('/{atasanid}/atasan/daftar-izin', [AtasanIzin::class, 'daftarIzin']);
Route::get('/{atasanid}/atasan/{id}/{option}', [AtasanIzin::class, 'acceptOrReject']);

Route::get('/{hrid}/hr/daftar-izin', [HRIzin::class, 'daftarIzin']);
Route::get('/{hrid}/hr/{id}/{option}', [HRIzin::class, 'acceptOrReject']);
