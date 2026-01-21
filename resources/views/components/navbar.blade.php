<div class="content-container">
    <nav>
        <div class="logo">Event <span>Planner</span></div>

        <div class="nav-links">
            @guest
                <!-- Not logged in -->
                <a href="{{ route('login') }}" class="nav-link">Login</a>
                <a href="{{ route('register') }}" class="btn-signup">Signup</a>
            @else
                <!-- Logged in -->
                <div class="user-profile">
                    <div class="user-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <span class="user-name">{{ auth()->user()->name }}</span>

                    <!-- Logout button / link -->
                    <form method="POST" action="{{ route('logout') }}" class="inline-block">
                        @csrf
                        <button type="submit" class="logout-btn">
                            Logout
                        </button>
                    </form>
                </div>
            @endguest
        </div>
    </nav>
</div>