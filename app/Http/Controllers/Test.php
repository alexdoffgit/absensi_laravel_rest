<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Test extends Controller
{
    public function index(Request $request)
    {
        // select checktime, checktype, userid dalam  5 tahun dari hari ini
        // pisahkan menjadi format date, time start, time end
        

        return view('test', ['jabatan' => 'hr', 'uid' => 3]);
    }
}
