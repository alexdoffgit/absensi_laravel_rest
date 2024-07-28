<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Interfaces\Employee;
use App\Exceptions\EmployeeNotFoundException;
use Illuminate\Support\Facades\Log;

class HRMenuAccessMiddleware
{
    public function __construct(private Employee $employee) {}
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

            if($roles == 'hr') {
                return $next($request);
            } else {
                return back();
            }
        } catch (\Throwable $th) {
            if($th instanceof EmployeeNotFoundException) {
                return redirect('/');
            } else {
                abort(500, 'something went wrong');
            }
        }
    }
}
