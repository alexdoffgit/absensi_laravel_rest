<?php

use App\Http\Controllers\Karyawan\Kehadiran;
use App\Http\Controllers\PengajuanIzin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(Kehadiran::class)->prefix('karyawan')
    ->group(function() {
        Route::get('/kehadiran/presensi/{id}', 'getPresensi');
        Route::get('/kehadiran/absensi/{id}', 'getAbsensi');
    });

Route::post('/{karyawanName}/pengajuan-izin', [PengajuanIzin::class, 'create']);