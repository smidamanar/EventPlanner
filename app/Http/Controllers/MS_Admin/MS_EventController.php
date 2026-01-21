<?php

namespace App\Http\Controllers\MS_Admin;

use App\Http\Controllers\Controller;
use App\Models\MS_Event;
use App\Models\MS_Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MS_EventController extends Controller
{
    public function index()
    {
        $events = MS_Event::with('category')->latest()->paginate(10);
        return view('MS_Admin.events.index', compact('events'));
    }

    public function create()
    {
        $categories = MS_Category::orderBy('name')->get();
        return view('MS_Admin.events.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
            'place'       => 'required|string|max:255',
            'capacity'    => 'required|integer|min:1',
            'price'       => 'nullable|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $validated['is_free']    = empty($validated['price']) || $validated['price'] == 0;
        $validated['price']      = $validated['is_free'] ? null : $validated['price'];
        $validated['created_by'] = Auth::id();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        MS_Event::create($validated);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event created successfully.');
    }

    public function edit(MS_Event $event)
    {
        $categories = MS_Category::orderBy('name')->get();
        return view('MS_Admin.events.edit', compact('event', 'categories'));
    }

    public function update(Request $request, MS_Event $event)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
            'place'       => 'required|string|max:255',
            'capacity'    => 'required|integer|min:1',
            'price'       => 'nullable|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'status'      => 'sometimes|in:active,archived',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $validated['is_free'] = empty($validated['price']) || $validated['price'] == 0;
        $validated['price']   = $validated['is_free'] ? null : $validated['price'];

        if ($request->hasFile('image')) {
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        $event->update($validated);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event updated successfully.');
    }

    public function destroy(MS_Event $event)
    {
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', 'Event deleted successfully.');
    }

    public function archive(MS_Event $event)
    {
        $event->update(['status' => 'archived']);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event archived successfully.');
    }
}