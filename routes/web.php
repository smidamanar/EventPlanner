<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MS_Front\MS_EventController as FrontEventController;
use App\Http\Controllers\MS_User\MS_RegistrationController;
use App\Http\Controllers\MS_Admin\MS_DashboardController;
use App\Http\Controllers\MS_Admin\MS_CategoryController;
use App\Http\Controllers\MS_Admin\MS_EventController;
use App\Http\Controllers\ProfileController;

use App\Models\MS_Event;
use App\Models\MS_Category;


Route::get('/', function () {
    $events = MS_Event::latest()->paginate(10);
    $categories = MS_Category::orderBy('name')->get();
    return view('welcome', compact('events', 'categories'));
})->name('welcome');


Route::get('/events', [FrontEventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [FrontEventController::class, 'show'])->name('events.show');


require __DIR__.'/auth.php';


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
    Route::get('/my-registrations', [MS_RegistrationController::class, 'index'])
        ->name('user.registrations.index');

    Route::post('/events/{event}/register', [MS_RegistrationController::class, 'store'])
        ->name('registrations.store');

 
    Route::delete('/registrations/{registration}', [MS_RegistrationController::class, 'destroy'])
        ->name('registrations.destroy');
});


Route::prefix('admin')->name('admin.')->middleware(['auth', 'ms_admin'])->group(function () {

    Route::get('/dashboard', [MS_DashboardController::class, 'index'])->name('dashboard');

    Route::resource('events', MS_EventController::class);
    Route::post('events/{event}/archive', [MS_EventController::class, 'archive'])->name('events.archive');

    Route::resource('categories', MS_CategoryController::class);

    Route::get('events/{event}/details', [MS_EventController::class, 'showDetails'])
         ->name('events.details');

 
    Route::get('/registrations', [MS_RegistrationController::class, 'adminIndex'])
        ->name('registrations.all');
});