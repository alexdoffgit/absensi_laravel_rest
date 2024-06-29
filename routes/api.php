<?php

use App\Http\Controllers\Kehadiran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/{uid}/kehadiran', [Kehadiran::class, 'getEventObjects']);