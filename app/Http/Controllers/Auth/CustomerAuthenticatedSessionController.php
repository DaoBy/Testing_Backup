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

class CustomerAuthenticatedSessionController extends Controller
{
    /**
     * Display the customer login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/CustomerLogin', [
            'canResetPassword' => Route::has('customer.password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming customer authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        if (!Auth::guard('web')->attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            return back()->withErrors(['email' => __('Invalid email or password.')]);
        }

        $request->session()->regenerate();
        return redirect()->route('customer.dashboard'); // Redirect customers to customer dashboard
    }

    /**
     * Destroy an authenticated customer session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
