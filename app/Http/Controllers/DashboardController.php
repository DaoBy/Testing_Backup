<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('admin.dashboard'); // Temporary admin dashboard
    }

    public function staff()
    {
        return view('staff.dashboard'); // Temporary staff dashboard
    }

    public function driver()
    {
        return view('driver.dashboard'); // Temporary driver dashboard
    }

    public function collector()
    {
        return view('collector.dashboard'); // Temporary collector dashboard
    }
}

