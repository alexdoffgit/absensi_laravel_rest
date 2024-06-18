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
        $this->testing_how_long_i_can_go_back_in_time_before_memory_run_out();

        return view('test', ['jabatan' => 'hr', 'uid' => 3]);
    }

    private function testing_how_long_i_can_go_back_in_time_before_memory_run_out()
    {
        $checkinoutTable = DB::table('checkinout')
            ->whereDate('CHECKTIME', '>=', '2021-12-01')
            ->select(['CHECKTYPE', 'CHECKTIME'])
            ->get();

        dd($checkinoutTable);
    }
}
