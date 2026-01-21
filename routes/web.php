<?php

use Illuminate\Support\Facades\Route;

// Frontend Controllers
use App\Http\Controllers\MS_Front\MS_EventController as FrontEventController;

// User Controllers
use App\Http\Controllers\MS_User\MS_RegistrationController;

// Admin Controllers
use App\Http\Controllers\MS_Admin\MS_DashboardController;
use App\Http\Controllers\MS_Admin\MS_CategoryController;
use App\Http\Controllers\MS_Admin\MS_EventController;

// Profile (Laravel default)
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Public / Frontend Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [FrontEventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [FrontEventController::class, 'show'])->name('events.show');

/*
|--------------------------------------------------------------------------
| Authentication Routes (Laravel Breeze / default)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Dashboard (user dashboard)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile routes (Breeze default)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User's own registrations
    Route::get('/my-registrations', [MS_RegistrationController::class, 'index'])
        ->name('user.registrations.index');

    // Book / register for an event
    Route::post('/events/{event}/register', [MS_RegistrationController::class, 'store'])
        ->name('registrations.store');
});

/*
|--------------------------------------------------------------------------
| Admin Routes – Protected by 'auth' + 'ms_admin' middleware
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'ms_admin'])->group(function () {

    // Admin Dashboard
   Route::prefix('admin')->name('admin.')->middleware(['auth', 'ms_admin'])->group(function () {
    Route::get('/dashboard', [MS_DashboardController::class, 'index'])->name('dashboard');
});

    // Events CRUD
    Route::resource('events', MS_EventController::class)->names([
        'index'   => 'events.index',
        'create'  => 'events.create',
        'store'   => 'events.store',
        'show'    => 'events.show',
        'edit'    => 'events.edit',
        'update'  => 'events.update',
        'destroy' => 'events.destroy',
    ]);

    // Categories CRUD
    Route::resource('categories', MS_CategoryController::class)->names([
        'index'   => 'categories.index',
        'create'  => 'categories.create',
        'store'   => 'categories.store',
        'show'    => 'categories.show',
        'edit'    => 'categories.edit',
        'update'  => 'categories.update',
        'destroy' => 'categories.destroy',
    ]);
    // ... inside Route::prefix('admin')->name('admin.')... group

// Events – full CRUD
Route::resource('events', MS_EventController::class);

// Archive route
Route::post('events/{event}/archive', [MS_EventController::class, 'archive'])->name('events.archive');
});

