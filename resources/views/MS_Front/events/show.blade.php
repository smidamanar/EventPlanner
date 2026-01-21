@extends('layouts.app')

@section('title', $event->title . ' - Event Planner')

@section('content')
    <!-- Hero Section – matches the screenshot style -->
    <div class="event-hero-section">
        @if($event->image)
            <img 
                src="{{ asset('storage/' . $event->image) }}" 
                alt="{{ $event->title }}" 
                class="event-hero-bg"
            >
        @else
            <div class="event-hero-bg event-no-image">
                EVENT
            </div>
        @endif

        <div class="event-hero-overlay"></div>

        <div class="event-hero-content">
            <div>
                <a href="{{ route('events.index') }}" class="event-back-btn">
                    ← Back
                </a>
            </div>

            <div>
                <a class="event-title-hero">{{ $event->title }}</a>
                <div class="event-place-hero">
                    {{ $event->place ?? 'Online Event' }}
                </div>
                <a class="event-teaser-hero">
                    {{ \Illuminate\Support\Str::limit($event->description ?? 'No description available.', 320, '...') }}
                </a> <br><br><br>

                @if(auth()->check() && $event->registrations()->where('user_id', auth()->id())->exists())
    <span class="event-btn-booked">Already Booked</span>
@elseif($event->remainingPlaces() > 0)
    <button 
        onclick="openBookingPopup()"
        class="event-btn-book"
    >
        Book now
    </button>
@else
    <span class="event-btn-booked">Fully Booked</span>
@endif
            </div>
        </div>
    </div>

    <!-- Description + Hours + Capacity – two-column layout -->
    <div class="event-info-grid">
        <div>
            <h2 class="event-section-title">Description</h2>
            <div class="prose prose-lg text-gray-700 leading-relaxed max-w-prose">
                {!! nl2br(e($event->description ?? 'No description available.')) !!}
            </div>
        </div>

        <div>
            <h2 class="event-section-title">Hours</h2>
            <div class="space-y-3 text-gray-700 text-lg">
                <a>Weekdays hour: <span class="event-capacity-highlight">{{ $event->weekday_hours ?? 'Not specified' }}</span></a><br><br>
                <a>Sunday hour: <span class="event-capacity-highlight">{{ $event->sunday_hours ?? 'Not specified' }}</span></a>
            </div>

            <h2 class="event-section-title mt-10">Capacity</h2>
            <a class="text-xl text-gray-700">
                Seats number : <span class="event-capacity-highlight">{{ $event->capacity }} persons</span>
            </a>
        </div>
    </div>

    <!-- Related Events – styled like your event-grid / event-card -->
    @if($relatedEvents->isNotEmpty())
        <section class="events-section py-16 bg-gray-50">
            <div class="content-container">
                <h2 class="events-title text-center mb-10">
                    Other events you may like
                </h2>

                <div class="events-grid">
                    @foreach($relatedEvents as $related)
                        <a href="{{ route('events.show', $related->id) }}" class="event-card">
                            <div class="relative">
                                @if($related->image)
                                    <img 
                                        src="{{ asset('storage/' . $related->image)  }}" 
                                        alt="{{ $related->title }}" 
                                        class="event-image"
                                    >
                                @else
                                    <div class="event-image bg-gray-200 flex items-center justify-center text-gray-500">
                                        No image
                                    </div>
                                @endif

                                <span class="event-badge">
                                    {{ $related->is_free ? 'FREE' : 'PAID' }}
                                </span>
                            </div>

                            <div class="event-content">
                                <h3 class="event-title">{{ $related->title }}</h3>
                                <p class="event-date">
                                    {{ $related->start_date->format('l, F j, g:i A') }}
                                </p>
                                <p class="event-type">
                                    {{ $related->place ?? 'ONLINE EVENT - Attend anywhere' }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

<!-- Booking Popup -->
<div id="bookingPopup" class="booking-popup">
    <div class="popup-content">
        <!-- Close button (X) -->
        <button class="popup-close" onclick="closeBookingPopup()">&times;</button>

        <h2>Book Event</h2>

        <div class="popup-buttons">
            <button onclick="closeBookingPopup()" class="btn-cancel">Cancel</button>

            @if(auth()->check())
                <!-- Logged in: direct POST to store registration -->
                <form method="POST" action="{{ route('registrations.store', $event->id) }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-book">Book now</button>
                </form>
            @else
                <!-- Not logged in: redirect to login with return URL -->
                <a href="{{ route('login') }}?intended={{ urlencode(url()->current()) }}" class="btn-book">
                    Book now
                </a>
            @endif
        </div>
    </div>
</div>


@endsection