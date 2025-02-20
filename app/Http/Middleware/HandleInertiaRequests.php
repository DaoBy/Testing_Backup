<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return null; // Avoid calling parent if it doesn't exist
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request) ?? [], [  // Ensure `parent::share()` exists
            'auth' => [
                'user' => $request->user(),
                'isEmployee' => Auth::guard('employee')->check(), 
                'isCustomer' => Auth::guard('customer')->check(), 
                'role' => Auth::guard('employee')->check() ? Auth::guard('employee')->user()->role : null,
            ],
        ]);
    }
}
