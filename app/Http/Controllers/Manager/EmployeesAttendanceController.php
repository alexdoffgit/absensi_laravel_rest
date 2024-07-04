<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeesAttendanceController extends Controller
{
    public function index(Request $request)
    {
        $loggedInUser = session()->get('userId');
        return view('manager.employees-attendance', ['loggedInUser' => $loggedInUser]);
    }
}
