<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Interfaces\Authentication;

class AuthController extends Controller
{
    public function __construct(private Authentication $au) {}

    public function loginView() {
        return view('login');
    }

    public function login(Request $request) 
    {
        $formdata = $request->validate([
            'username' => 'required',
            'passwd' => 'required'
        ]);

        $uid = $this->au->verifyUser($formdata['username'], $formdata['passwd']);

        if (empty($uid)) {
            return back()->with('invalid', true);
        } else {
            return redirect(url("/{$uid}/kehadiran"));
        }
    }

    public function registerView() 
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $formdata = $request->validate([
            'username' => 'required',
            'passwd' => 'required'
        ]);

        $uid = $this->au->register($formdata['username'], $formdata['passwd']);

        return redirect(url("/{$uid}/kehadiran"));
    }
}
