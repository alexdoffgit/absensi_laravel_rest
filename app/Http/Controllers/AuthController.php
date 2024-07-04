<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Interfaces\Authentication;
use App\Interfaces\Karyawan;

class AuthController extends Controller
{
    public function __construct(
        private Authentication $au,
        private Karyawan $karyawan
    ) {
    }

    public function loginView()
    {
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
            session(['userId' => $uid]);
            $roles = $this->karyawan->getRoles($uid);
            if ($roles == 'hr') {
                return redirect('/hr/attendance/analysis');
            } else if ($roles == 'manager') {
                return redirect('/manager/attendande/analysis');
            } else {
                return redirect('/attendance/analysis');
            }
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
