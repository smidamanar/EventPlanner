<?php

namespace App\Http\Controllers\MS_Admin;

use App\Http\Controllers\Controller;
use App\Models\MS_Registration;
use App\Models\MS_Event;
use App\Models\MS_Category;
use App\Models\User;

class MS_DashboardController extends Controller
{
    public function index()
    {
        return view('MS_Admin.dashboard', [
            'totalEvents'        => MS_Event::count(),
            'totalRegistrations' => MS_Registration::count(),
            'totalCategories'    => MS_Category::count(),
            'totalUsers'         => User::count(),
            'events'             => MS_Event::latest('created_at')
                ->take(5)
                ->get(),
        ]);
    }
}