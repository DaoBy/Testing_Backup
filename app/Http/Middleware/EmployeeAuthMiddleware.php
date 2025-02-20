<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeAuthMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('employee')->check()) {
            return redirect()->route('employee.login')->with('error', 'You must be logged in as an employee to access this page.');
        }

        return $next($request);
    }
}
