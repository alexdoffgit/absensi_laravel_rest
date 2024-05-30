<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengajuanIzin;
use App\Http\Controllers\Atasan\Perizinan as AtasanIzin;
use App\Http\Controllers\HR\Perizinan as HRIzin;


Route::get('/{karyawanid}', [PengajuanIzin::class, 'createView']);
Route::post('/{karyawanid}', [PengajuanIzin::class, 'createWeb']);

Route::get('/{atasanid}/atasan/daftar-izin', [AtasanIzin::class, 'daftarIzin']);
Route::get('/{atasanid}/atasan/{id}/{option}', [AtasanIzin::class, 'acceptOrReject']);

Route::get('/{hrid}/hr/daftar-izin', [HRIzin::class, 'daftarIzin']);
Route::get('/{hrid}/hr/{id}/{option}', [HRIzin::class, 'acceptOrReject']);
