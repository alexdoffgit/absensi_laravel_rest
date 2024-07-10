<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Interfaces\Karyawan;

class ITAdminMiddleware
{
    public function __construct(private Karyawan $karyawan) {}

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userId = session()->get('userId');

        if(empty($userId)) {
            return redirect('/');
        }

        $roles = $this->karyawan->getRoles($userId);

        if($roles != 'IT') {
            return back();
        }

        return $next($request);
    }
}
