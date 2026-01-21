<?php

namespace App\Http\Controllers\MS_Front;

use App\Http\Controllers\Controller;
use App\Models\MS_Event;
use App\Models\MS_Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MS_EventController extends Controller
{
    /**
     * Show list of active events
     * URL: /
     */
public function index(Request $request)
{
    $query = MS_Event::query()
        ->where('status', 'active')
        ->whereDate('start_date', '>=', now()); // only upcoming events

    // Search (safe trim)
    if ($request->filled('search') && trim($request->search) !== '') {
        $query->where('title', 'like', '%' . trim($request->search) . '%');
    }

    // Category - only apply if it's a valid positive integer
    if ($request->filled('category') && is_numeric($request->category) && $request->category > 0) {
        $query->where('category_id', (int) $request->category);
    }

    // Weekday filter (optional - if you use it)
    if ($request->filled('weekday') && in_array(strtolower($request->weekday), ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'])) {
        $query->whereRaw('LOWER(DAYNAME(start_date)) = ?', [strtolower($request->weekday)]);
    }

    // Execute + paginate (this preserves filters in pagination links)
    $events = $query->orderBy('start_date', 'asc')->paginate(6)->appends($request->query());

    $categories = MS_Category::all();

    return view('MS_Front.events.index', compact('events', 'categories'));
}

    /**
     * Show single event
     * URL: /events/{event}
     */
public function show(MS_Event $event)
{
    $relatedEvents = MS_Event::where('status', 'active')
        ->where('category_id', $event->category_id)
        ->where('id', '!=', $event->id)
        ->whereDate('start_date', '>=', now())
        ->orderBy('start_date')
        ->limit(6)
        ->get();

    return view('MS_Front.events.show', compact('event', 'relatedEvents'));
}

    public function destroy(Request $request)
{
    Auth::guard('web')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
}
}
