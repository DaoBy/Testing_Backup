<?php
use App\Http\Controllers\Auth\CustomerAuthenticatedSessionController;
use App\Http\Controllers\Auth\EmployeeAuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\CustomerRegisteredUserController;
use App\Http\Controllers\Auth\EmployeeRegisteredUserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Customer Routes
Route::get('/register/customer', [CustomerRegisteredUserController::class, 'create'])->name('customer.register');
Route::post('/register/customer', [CustomerRegisteredUserController::class, 'store'])->name('customer.register.store');

// Employee Routes
Route::get('/register/employee', [EmployeeRegisteredUserController::class, 'create'])->name('employee.register');
Route::post('/register/employee', [EmployeeRegisteredUserController::class, 'store'])->name('employee.register.store');



// Customer Login Routes
Route::get('/login/customer', [CustomerAuthenticatedSessionController::class, 'create'])->name('customer.login');
Route::post('/login/customer', [CustomerAuthenticatedSessionController::class, 'store']);
Route::post('/logout/customer', [CustomerAuthenticatedSessionController::class, 'destroy'])->name('customer.logout');

// Employee Login Routes
Route::get('/login/employee', [EmployeeAuthenticatedSessionController::class, 'create'])->name('employee.login');
Route::post('/login/employee', [EmployeeAuthenticatedSessionController::class, 'store']);
Route::post('/logout/employee', [EmployeeAuthenticatedSessionController::class, 'destroy'])->name('employee.logout');



// Customer Dashboard (Protected)
Route::middleware(['auth:customer'])->group(function () {
    Route::get('/customer/dashboard', function () {
        return Inertia::render('Customer/Dashboard');
    })->name('customer.dashboard');
});

// Employee Dashboards Based on Role
Route::middleware(['auth:employee'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return Inertia::render('Employee/AdminDashboard');
    })->middleware('role:admin')->name('admin.dashboard');

    Route::get('/staff/dashboard', function () {
        return Inertia::render('Employee/StaffDashboard');
    })->middleware('role:staff')->name('staff.dashboard');

    Route::get('/driver/dashboard', function () {
        return Inertia::render('Employee/DriverDashboard');
    })->middleware('role:driver')->name('driver.dashboard');

    Route::get('/collector/dashboard', function () {
        return Inertia::render('Employee/CollectorDashboard');
    })->middleware('role:collector')->name('collector.dashboard');
});

// Include auth routes
require __DIR__.'/auth.php';
