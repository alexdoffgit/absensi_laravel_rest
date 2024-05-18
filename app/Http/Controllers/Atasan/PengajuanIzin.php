<?php

namespace App\Http\Controllers\Atasan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengajuanIzin extends Controller
{
    public function daftarIzin()
    {
        return view('atasan.daftar-izin');
    }
}
