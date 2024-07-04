<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class HRMenuAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $HRDeptId = 54;

        if (empty(session()->get('userId'))) {
            return redirect('/');
        }

        $userinfoTable = DB::table('userinfo')
            ->where('USERID', '=', session()->get('userId'))
            ->first();

        if (empty($userinfoTable)) {
            return redirect('/');
        }

        if ($userinfoTable->DEFAULTDEPTID != $HRDeptId) {
            return back();
        }

        return $next($request);
    }
}
