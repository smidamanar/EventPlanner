<?php

namespace App\Http\Controllers\MS_Admin;

use App\Http\Controllers\Controller;
use App\Models\MS_Registration;

class MS_DashboardController extends Controller
{
    public function index()
    {
        $registrations = MS_Registration::with('user', 'event')->latest()->paginate(10);
        return view('MS_Admin.dashboard', compact('registrations'));
    }
}
