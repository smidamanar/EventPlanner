@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
@endsection

@section('content')

    <div class="admin-container">

        <!-- Greeting -->
        <div class="greeting">
            <h1 class="page-title">Dashboard</h1>
            <p class="welcome-line">
                Hello, <strong>{{ auth()->user()->name }}</strong> • {{ now()->format('d M Y') }}
            </p>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <h3 class="stat-label">Total Events</h3>
                <p class="stat-value">{{ $totalEvents }}</p>
                
            </div>

            <div class="stat-card">
                <h3 class="stat-label">Registrations</h3>
                <p class="stat-value">{{ $totalRegistrations }}</p>
                <!-- <a href="..." class="stat-link">View all →</a> -->
            </div>

            <div class="stat-card">
                <h3 class="stat-label">Categories</h3>
                <p class="stat-value">{{ $totalCategories }}</p>
                
            </div>

            <div class="stat-card">
                <h3 class="stat-label">Users</h3>
                <p class="stat-value">{{ $totalUsers }}</p>
                <!-- <a href="..." class="stat-link">Manage →</a> -->
            </div>
        </div>

        <!-- Recent Events -->
        <section class="recent-section">
            <div class="section-header">
                <h2 class="section-title">Recent Events</h2>
                
            </div>


            <div class="events-grid">
                @foreach($events as $event)
                    <a href="{{ route('admin.events.details', $event) }}" class="event-link">
                        <div class="event-card">
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


        
        </section>

    </div>

@endsection