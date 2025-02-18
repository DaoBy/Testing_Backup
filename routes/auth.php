<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\CustomerRegisteredUserController;
use App\Http\Controllers\Auth\EmployeeRegisteredUserController;
use App\Http\Controllers\Auth\CustomerAuthenticatedSessionController;
use App\Http\Controllers\Auth\EmployeeAuthenticatedSessionController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CUSTOMER AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('customer')->name('customer.')->group(function () {
    Route::middleware('guest:customer')->group(function () {
        Route::get('register', [CustomerRegisteredUserController::class, 'create'])->name('register');
        Route::post('register', [CustomerRegisteredUserController::class, 'store']);

        Route::get('login', [CustomerAuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('login', [CustomerAuthenticatedSessionController::class, 'storeCustomer']);

        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
        Route::post('forgot-password', [PasswordResetLinkController::class, 'storeCustomer'])->name('password.email');

        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
        Route::post('reset-password', [NewPasswordController::class, 'storeCustomer'])->name('password.store');
    });

    Route::middleware('auth:customer')->group(function () {
        Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');
        Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
            ->middleware(['signed', 'throttle:6,1'])
            ->name('verification.verify');
        Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
            ->middleware('throttle:6,1')
            ->name('verification.send');

        Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
        Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

        Route::put('password', [PasswordController::class, 'update'])->name('password.update');
        Route::post('logout', [CustomerAuthenticatedSessionController::class, 'destroyCustomer'])->name('logout');
    });
});

/*
|--------------------------------------------------------------------------
| EMPLOYEE AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('employee')->name('employee.')->group(function () {
    Route::middleware('guest:employee')->group(function () {
        Route::get('register', [EmployeeRegisteredUserController::class, 'create'])->name('register');
        Route::post('register', [EmployeeRegisteredUserController::class, 'store']);

        Route::get('login', [EmployeeAuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('login', [EmployeeAuthenticatedSessionController::class, 'storeEmployee']);

        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
        Route::post('forgot-password', [PasswordResetLinkController::class, 'storeEmployee'])->name('password.email');

        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
        Route::post('reset-password', [NewPasswordController::class, 'storeEmployee'])->name('password.store');
    });

    Route::middleware('auth:employee')->group(function () {
        Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');
        Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
            ->middleware(['signed', 'throttle:6,1'])
            ->name('verification.verify');
        Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
            ->middleware('throttle:6,1')
            ->name('verification.send');

        Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
        Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

        Route::put('password', [PasswordController::class, 'update'])->name('password.update');
        Route::post('logout', [EmployeeAuthenticatedSessionController::class, 'destroyEmployee'])->name('logout');
    });
});
