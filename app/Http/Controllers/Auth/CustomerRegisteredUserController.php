<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class CustomerRegisteredUserController extends Controller
{
    /**
     * Display the customer registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/CustomerRegister');
    }

    /**
     * Handle the customer registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:customers',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $customer = Customer::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'remember_token' => \Str::random(60), // Ensure session security
        ]);

        event(new Registered($customer));

        // Use the correct authentication guard
        Auth::guard('customer')->login($customer);

        return redirect()->intended(route('customer.dashboard'));
    }
}
