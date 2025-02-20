<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class EmployeeRegisteredUserController extends Controller
{
    /**
     * Display the employee registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/EmployeeRegister');
    }

    /**
     * Handle the employee registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:employees',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => 'required|string|in:admin,staff,driver,collector',
        ]);

        $employee = Employee::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'remember_token' => \Str::random(60), // Ensure session security
        ]);

        //event(new Registered($employee));

        // Use the correct authentication guard
        Auth::guard('employee')->login($employee);

        return redirect()->intended(route('employee.dashboard'));
    }
}
