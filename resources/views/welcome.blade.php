@extends('layouts.app')

@section('title', 'Event Planner - Home')

@section('content')

    <!-- Navbar with extra space -->
    <div class="content-container">
        <nav>
            <div class="logo">Event <span>Planner</span></div>
            <div class="nav-links">
                @guest
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}" class="btn-signup">Signup</a>
                @else
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" style="background:none;border:none;color:#333;font-weight:500;cursor:pointer;">
                            Logout
                        </button>
                    </form>
                @endguest
            </div>
        </nav>
    </div>

    <!-- Hero stays full-width like Figma -->
    <section class="hero">
        <div class="hero-overlay">
            <h1 class="hero-title">MADE FOR THOSE<br>WHO DO</h1>
        </div>
        <div class="hero-arrows">
            <div class="hero-arrow">&lt;</div>
            <div class="hero-arrow">&gt;</div>
        </div>
    </section>

    <!-- Events section with extra space -->
    <div class="content-container">
        <section class="events-section">
            <h2 class="events-title">Upcoming <span>Events</span></h2>

            <!-- Filters - now with weekdays and real categories from DB -->
            <form method="GET" action="{{ route('events.index') }}" class="events-filters">
                <input type="text" class="search-bar" name="search" placeholder="Search..." value="{{ request('search') }}">

                <select class="filter-select" name="weekday">
                    <option value="">Weekdays</option>
                    <option value="monday" {{ request('weekday') === 'monday' ? 'selected' : '' }}>Monday</option>
                    <option value="tuesday" {{ request('weekday') === 'tuesday' ? 'selected' : '' }}>Tuesday</option>
                    <option value="wednesday" {{ request('weekday') === 'wednesday' ? 'selected' : '' }}>Wednesday</option>
                    <option value="thursday" {{ request('weekday') === 'thursday' ? 'selected' : '' }}>Thursday</option>
                    <option value="friday" {{ request('weekday') === 'friday' ? 'selected' : '' }}>Friday</option>
                    <option value="saturday" {{ request('weekday') === 'saturday' ? 'selected' : '' }}>Saturday</option>
                    <option value="sunday" {{ request('weekday') === 'sunday' ? 'selected' : '' }}>Sunday</option>
                </select>

                <select class="filter-select" name="category">
                    <option value="">Any category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </form>

            @if($events->isEmpty())
                <div style="
                    text-align: center;
                    padding: 80px 20px;
                    background: white;
                    border-radius: 10px;
                    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                ">
                    <div style="font-size: 4.5rem; margin-bottom: 20px; color: #7848F4;">📅</div>
                    <h3>No events for the moment</h3>
                    <p style="color: #666; margin: 15px 0;">
                        There are currently no upcoming events.<br>
                        Check back later or <a href="{{ route('register') }}" style="color:#7848F4;">create your own event</a>!
                    </p>
                </div>
            @else
                <div class="events-grid">
                    @foreach($events as $event)
                        <div class="event-card">
                            @if($event->image)
                                <img src="{{ asset($event->image) }}" alt="{{ $event->title }}" class="event-image">
                            @else
                                <img src="https://thumbs.dreamstime.com/b/crowd-people-holding-flags-concert-large-goers-waving-air-live-music-performance-ai-generative-319204504.jpg" 
                                     alt="Event" class="event-image">
                            @endif

                            <div class="event-content">
                                <span class="event-badge">
                                    {{ $event->price == 0 ? 'FREE' : 'PAID' }}
                                </span>
                                <h3 class="event-title">{{ $event->title }}</h3>
                                <p class="event-date">
                                    {{ $event->start_date->format('l, F j, g:i A') }}
                                </p>
                                <p class="event-type">
                                    {{ $event->is_online ? 'ONLINE EVENT - Attend anywhere' : ($event->location ?? 'In-person') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Load more only appears when there are more than 6 events -->
                @if($events->hasMorePages())
                    <button class="load-more">Load more...</button>
                @endif
            @endif

        </section>
    </div>

    <!-- Footer stays full-width like Figma -->
    <footer>
        <div class="container">
            <div class="footer-logo">Event <span>Planner</span></div>

            <form class="subscribe-form">
                <input type="email" class="subscribe-input" placeholder="Enter your mail">
                <button type="submit" class="subscribe-btn">Subscribe</button>
            </form>

            <div class="footer-links">
                <a href="/">Home</a>
                <a href="{{ route('register') }}">Sign UP</a>
                <a href="{{ route('login') }}">Sign in</a>
            </div>

            <p class="copyright">Non Copyrighted © {{ date('Y') }} Event Planner</p>
        </div>
    </footer>

@endsection