<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengajuanIzin;
use App\Http\Controllers\Atasan\PengajuanIzin as AtasanIzin;

Route::get('/{karyawanid}', [PengajuanIzin::class, 'createView']);
Route::post('/{karyawanid}', [PengajuanIzin::class, 'createWeb']);
Route::get('/{atasanid}/atasan/daftar-izin', [AtasanIzin::class, 'daftarIzin']);