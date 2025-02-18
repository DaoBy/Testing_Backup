<?php

return [

    'defaults' => [
        'guard' => 'web', // Default guard
        'passwords' => 'users', // Default password broker
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        // Customer Guard
        'customer' => [
            'driver' => 'session',
            'provider' => 'customers',
        ],

        // Employee Guard
        'employee' => [
            'driver' => 'session',
            'provider' => 'employees',
        ],

        // API Guards (if needed in the future)
        'api' => [
            'driver' => 'token',
            'provider' => 'users',
            'hash' => false,
        ],

        'customer_api' => [
            'driver' => 'token',
            'provider' => 'customers',
            'hash' => false,
        ],

        'employee_api' => [
            'driver' => 'token',
            'provider' => 'employees',
            'hash' => false,
        ],
    ],

    'providers' => [
        // Default User Provider
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        // Customer Provider
        'customers' => [
            'driver' => 'eloquent',
            'model' => App\Models\Customer::class,
        ],

        // Employee Provider
        'employees' => [
            'driver' => 'eloquent',
            'model' => App\Models\Employee::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'customers' => [
            'provider' => 'customers',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'employees' => [
            'provider' => 'employees',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
