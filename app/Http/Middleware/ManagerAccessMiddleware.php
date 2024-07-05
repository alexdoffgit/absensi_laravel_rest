<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Interfaces\Karyawan;
use App\Exceptions\EmployeeNotFoundException;

class ManagerAccessMiddleware
{
    public function __construct(private Karyawan $employee) {}
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userId = session()->get('userId');
        if (empty($userId)) {
            return redirect('/');
        }

        try {
            $roles = $this->employee->getRoles($userId);

            if ($roles == 'manager') {
                return $next($request);
            } else {
                return back();
            }
        } catch(\Throwable $th) {
            if ($th instanceof EmployeeNotFoundException) {
                return redirect();
            } else {
                abort(500, $th->getMessage());
            }
        }
    }
}
