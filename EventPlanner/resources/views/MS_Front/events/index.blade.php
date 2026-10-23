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
</section>

<div class="content-container">
    <section class="events-section">
        <h2 class="events-title">Upcoming <span>Events</span></h2>

        {{-- EVENTS GRID --}}
        <div class="events-grid">
            @foreach($events as $event)
                <a href="{{ route('events.show', $event) }}"
                   class="event-link"
                   data-id="{{ $event->id }}">

                    <div class="event-card">
                        @if($event->image && Storage::disk('public')->exists($event->image))
                            <img src="{{ asset('storage/'.$event->image) }}" class="event-image">
                        @else
                            <img src="https://via.placeholder.com/400x225" class="event-image">
                        @endif

                        <div class="event-content">
                            <span class="event-badge">
                                {{ $event->is_free ? 'FREE' : 'PAID' }}
                            </span>

                            <h3 class="event-title">{{ $event->title }}</h3>
                            <p class="event-date">
                                {{ $event->start_date?->format('l, F j, g:i A') }}
                            </p>
                            <p class="event-type">{{ $event->place }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        
        @if($events->hasMorePages())
            <button id="load-more" class="load-more" 
                    data-next-page="{{ $events->currentPage() + 1 }}">
                Load more...
            </button>
        @endif

    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const loadBtn = document.getElementById('load-more');
    if (!loadBtn) return;

    let loading = false;

    loadBtn.addEventListener('click', function () {

        if (loading) return;
        loading = true;

        const nextPage = loadBtn.dataset.nextPage;
        const url = new URL(window.location.href);
        url.searchParams.set('page', nextPage);

        fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.text())
        .then(html => {
            const doc = new DOMParser().parseFromString(html, 'text/html');

            const newEvents = doc.querySelectorAll('.event-link');

            if (!newEvents.length) {
                loadBtn.remove();
                return;
            }

            const grid = document.querySelector('.events-grid');

            newEvents.forEach(event => {
                const id = event.dataset.id;
                if (!document.querySelector(`.event-link[data-id="${id}"]`)) {
                    grid.appendChild(event);
                }
            });

            loadBtn.dataset.nextPage = parseInt(nextPage) + 1;
            loading = false;
        })
        .catch(() => loading = false);
    });
});
</script>

@endsection
