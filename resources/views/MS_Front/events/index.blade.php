@extends('layouts.app')

@section('title', 'Event Planner - Home')

@section('content')

@php
    use Illuminate\Support\Facades\Storage;
@endphp

<section class="hero">
    <div class="hero-overlay">
        <h1 class="hero-title">MADE FOR THOSE<br>WHO DO</h1>
    </div>
    <div class="hero-arrows">
        <div class="hero-arrow">&lt;</div>
        <div class="hero-arrow">&gt;</div>
    </div>
</section>

<div class="content-container">
    <section class="events-section">
        <h2 class="events-title">Upcoming <span>Events</span></h2>

        <form method="GET" action="{{ route('events.index') }}" class="events-filters">
            <input type="text" class="search-bar" name="search" placeholder="Search..."
                   value="{{ request('search') }}">

            <select class="filter-select" name="weekday">
                <option value="">Weekdays</option>
                <option value="monday" {{ request('weekday') === 'monday' ? 'selected' : '' }}>Monday</option>
                <option value="sunday" {{ request('weekday') === 'sunday' ? 'selected' : '' }}>Sunday</option>
            </select>

            <select class="filter-select" name="category">
                <option value="">Any category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </form>

        @if($events->isEmpty())
            <div class="no-events">
                <div class="no-events-icon">📅</div>
                <h3>No events for the moment</h3>
            </div>
        @else
            <div class="events-grid">
                @foreach($events as $event)
                    <a href="{{ route('events.show', $event) }}" class="event-link">
                        <div class="event-card">

                            {{-- ✅ IMAGE HANDLING (SOLUTION 1) --}}
                            @if($event->image && Storage::disk('public')->exists($event->image))
                                <img src="{{ asset('storage/' . $event->image) }}"
                                     alt="{{ $event->title }}"
                                     class="event-image">
                            @else
                                <img src="https://via.placeholder.com/400x225?text=No+Image"
                                     alt="Default event image"
                                     class="event-image">
                            @endif

                            <div class="event-content">
                                <span class="event-badge">
                                    {{ $event->is_free ? 'FREE' : 'PAID' }}
                                </span>

                                <h3 class="event-title">{{ $event->title }}</h3>

                                <p class="event-date">
                                    {{ $event->start_date?->format('l, F j, g:i A') ?? 'Date TBA' }}
                                </p>

                                <p class="event-type">
                                    {{ $event->place ?? 'ONLINE EVENT - Attend anywhere' }}
                                </p>
                            </div>

                        </div>
                    </a>
                @endforeach
            </div>

            @if($events->hasMorePages())
                <button class="load-more">Load more...</button>
            @endif
        @endif
    </section>
</div>

@endsection