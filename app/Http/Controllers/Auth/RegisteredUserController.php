<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;  // Assuming you have a Customer model
use App\Models\Employee;  // Assuming you have an Employee model
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view for customers and employees.
     */
    public function create(Request $request): Response
    {
        if ($request->has('role') && $request->role == 'employee') {
            return Inertia::render('Auth/RegisterEmployee');  // A different page for employee registration
        }

        return Inertia::render('Auth/Register');  // Default is customer registration
    }

    /**
     * Handle an incoming registration request for customers.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeCustomer(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . Customer::class,
            'phone_number' => 'required|string|max:15|unique:' . Customer::class,  // New field for phone number
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Create the customer record
        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($customer));

        Auth::login($customer);

        return redirect(route('dashboard', absolute: false));
    }

    /**
     * Handle an incoming registration request for employees.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeEmployee(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . Employee::class,
            'role' => 'required|string|in:admin,staff,driver,collector',  // Role validation
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Create the employee record
        $employee = Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($employee));

        Auth::login($employee);

        return redirect(route('dashboard', absolute: false));
    }
}
