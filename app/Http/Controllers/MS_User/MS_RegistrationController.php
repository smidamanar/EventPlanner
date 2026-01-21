<?php

namespace App\Http\Controllers\MS_User;

use App\Http\Controllers\Controller;
use App\Models\MS_Registration;
use Illuminate\Support\Facades\Auth;
use App\Models\MS_Event;

class MS_RegistrationController extends Controller
{
    /**
     * My registrations page
     * URL: /my-registrations
     */
    public function index()
    {
        $registrations = MS_Registration::where('user_id', Auth::id())
            ->with(['event' => function ($q) {
                $q->select('id', 'title', 'start_date');
            }])
            ->latest('created_at')
            ->paginate(15);

        return view('MS_User.registrations.index', compact('registrations'));
    }

    /**
     * Register to event
     * POST: /events/{event}/register
     */
    public function store(MS_Event $event)
    {
        if ($event->remainingPlaces() <= 0) {
            return back()->withErrors(['error' => 'No places available']);
        }

        if ($event->registrations()->where('user_id', Auth::id())->exists()) {
            return back()->withErrors(['error' => 'You are already registered']);
        }

        MS_Registration::create([
            'user_id' => Auth::id(),
            'event_id' => $event->id,
        ]);

        return back()->with('success', 'Registration successful');
    }
}