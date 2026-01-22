@extends('layouts.admin')

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
                <a href="{{ route('admin.dashboard') }}" class="event-back-btn">
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
                <div >
                <a href="{{ route('admin.events.edit', $event->id) }}" class="event-edit-btn" >
                    Edit
                </a>
            </div>

    <!-- Related Events – styled like your event-grid / event-card -->
@endsection

