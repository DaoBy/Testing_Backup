<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (Auth::guard('employee')->check() && Auth::guard('employee')->user()->role === $role) {
            return $next($request);
        }

        abort(403, 'Unauthorized'); // Prevent access if role doesn't match
    }
}