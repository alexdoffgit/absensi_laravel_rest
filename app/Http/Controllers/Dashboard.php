<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

// TODO: remove this, it's a temp class
class Dashboard extends Controller
{
    public function dashboardView(Request $request, $uid) 
    {
        $jabatanTable = DB::table('temp_user_jabatan')
            ->select('jabatan')
            ->where('userid', '=', intval($uid))
            ->first();

        return view('welcome', ['jabatan' => $jabatanTable->jabatan, 'karyawanId' => $uid]);
    }
}
