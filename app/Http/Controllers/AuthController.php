<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Interfaces\Authentication;
use App\Interfaces\Employee;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct(
        private Authentication $au,
        private Employee $employee
    ) {
    }

    public function loginView()
    {
        return view('login');
    }

    public function loginApi(Request $request)
    {
        $formdata = $request->validate([
            'username' => 'required',
            'passwd' => 'required'
        ]);

        if (
            Auth::attempt([
                'Name' => $formdata['username'],
                'PASSWORD' => $formdata['passwd']
            ])
        ) {
            $request->session()->regenerate();
            return response();
        } else {
            abort(401, 'invalid credential');
        }
    }

    public function login(Request $request)
    {
        $formdata = $request->validate([
            'username' => 'required',
            'passwd' => 'required'
        ]);

        if (
            Auth::attempt([
                'fullname' => $formdata['username'],
                'password' => $formdata['passwd']
            ])
        ) {
            $uid = User::where('fullname', '=', $formdata['username'])
                ->select(['USERID'])
                ->first()
                ->USERID;
            $request->session()->regenerate();
            session(['userId' => $uid]);
            return redirect('/attendance/analysis');
        } else {
            return back()->with('invalid', true);
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

    public function logout()
    {
        session()->forget('userId');
        session()->invalidate();
        return redirect('/');
    }
}
