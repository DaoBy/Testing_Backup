<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class CustomerHomeController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Home');
    }
}
