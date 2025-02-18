<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class EmployeeAuthenticatedSessionController extends Controller
{
    /**
     * Display the employee login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/EmployeeLogin', [
            'canResetPassword' => Route::has('employee.password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming employee authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        if (!Auth::guard('employee')->attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            return back()->withErrors(['email' => __('Invalid email or password.')]);
        }

        $request->session()->regenerate();
        return $this->redirectEmployee(Auth::guard('employee')->user()->role);
    }

    /**
     * Redirect employees based on role.
     */
    private function redirectEmployee(?string $role): RedirectResponse
    {
        return match ($role) {
            'admin' => redirect()->route('admin.dashboard'),
            'staff' => redirect()->route('staff.dashboard'),
            'driver' => redirect()->route('driver.dashboard'),
            'collector' => redirect()->route('collector.dashboard'),
            default => redirect()->route('employee.login')->withErrors(['email' => 'Unauthorized role.']),
        };
    }

    /**
     * Destroy an authenticated employee session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('employee')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
