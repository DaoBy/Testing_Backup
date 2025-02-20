<?php
use App\Http\Controllers\Auth\CustomerHomeController;
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
        'canCustomerLogin' => Route::has('customer.login'),
        'canEmployeeLogin' => Route::has('employee.login'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


//Tracking
Route::get('/tracking', function () {
    return Inertia::render('Tracking');
})->name('tracking');

//Delivery Request
Route::get('/request', function () {
    return Inertia::render('RequestDelivery');
})->name('request.delivery');


// ✅ Default login route (Redirects to customer login)
Route::get('/login', function () {
    return redirect()->route('customer.login');
})->name('login');

// ✅ Public Customer Home Page
Route::get('/customer/home', function () {
    return Inertia::render('Home');
})->name('customer.home');


// ✅ Customer Authentication Routes
Route::prefix('customer')->name('customer.')->group(function () {
    Route::middleware('guest:customer')->group(function () {
        Route::get('register', [CustomerRegisteredUserController::class, 'create'])->name('register');
        Route::post('register', [CustomerRegisteredUserController::class, 'store'])->name('register.store');

        Route::get('login', [CustomerAuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('login', [CustomerAuthenticatedSessionController::class, 'store']);
    });

    Route::middleware('auth:customer')->group(function () {
        Route::post('logout', [CustomerAuthenticatedSessionController::class, 'destroy'])->name('logout');

        Route::get('dashboard', function () {
            return Inertia::render('Customer/Dashboard');
        })->name('dashboard');
    });
});


// ✅ Employee Authentication Routes
Route::prefix('employee')->name('employee.')->group(function () {
    Route::middleware('guest:employee')->group(function () {
        Route::get('register', [EmployeeRegisteredUserController::class, 'create'])->name('register');
        Route::post('register', [EmployeeRegisteredUserController::class, 'store'])->name('register.store');

        Route::get('login', [EmployeeAuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('login', [EmployeeAuthenticatedSessionController::class, 'store']);
    });

    Route::middleware('auth:employee')->group(function () {
        Route::post('logout', [EmployeeAuthenticatedSessionController::class, 'destroy'])->name('logout');

        // ✅ Employee Dashboards Based on Role
        Route::middleware('role:admin')->get('/admin/dashboard', function () {
            return Inertia::render('Employee/AdminDashboard');
        })->name('admin.dashboard');

        Route::middleware('role:staff')->get('/staff/dashboard', function () {
            return Inertia::render('Employee/StaffDashboard');
        })->name('staff.dashboard');

        Route::middleware('role:driver')->get('/driver/dashboard', function () {
            return Inertia::render('Employee/DriverDashboard');
        })->name('driver.dashboard');

        Route::middleware('role:collector')->get('/collector/dashboard', function () {
            return Inertia::render('Employee/CollectorDashboard');
        })->name('collector.dashboard');
    });
});

// ✅ General Profile Routes (For both customers & employees)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ✅ Include other authentication routes
require __DIR__.'/auth.php';
