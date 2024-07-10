<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccessManagementController extends Controller
{
    public function index()
    {
        return view('access-management');
    }
}
