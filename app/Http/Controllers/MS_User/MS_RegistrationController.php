<?php

namespace App\Http\Controllers\MS_User;

use App\Http\Controllers\Controller;
use App\Models\MS_Registration;
use Illuminate\Support\Facades\Auth;
use App\Models\MS_Event;


class MS_RegistrationController extends Controller
{

    public function index()
    {
        $registrations = MS_Registration::query()
            ->where('user_id', Auth::id())
            ->with(['event' => function ($q) {
                $q->select('id', 'title', 'start_date');
            }])
            ->latest('created_at')
            ->paginate(15);

        return view('MS_User.registrations.index', compact('registrations'));
    }


    public function adminIndex()
    {
        $registrations = MS_Registration::query()
            ->with([
                'event' => function ($q) {
                    $q->select('id', 'title', 'start_date');
                },
                'user' => function ($q) {
                    $q->select('id', 'name', 'email');
                }
            ])
            ->latest('created_at')
            ->paginate(15);

        return view('MS_Admin.registrations.index', compact('registrations'));
    }


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


    public function destroy(MS_Registration $registration)
    {
        $registration->delete();

        return redirect()->route('user.registrations.index')
            ->with('success', 'Category deleted successfully.');
    }
}