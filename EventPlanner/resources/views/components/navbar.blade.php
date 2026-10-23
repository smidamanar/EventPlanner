<nav>
    <div >
       <a href="{{ route('events.index') }}" class="logo">
    Event <span>Planner</span>
</a>
    </div>

    

    <div class="nav-links">
        @guest
            <!-- Not logged in -->
            <a href="{{ route('login') }}" class="nav-link">Login</a>
            <a  href="{{ route('register') }}" class="btn-signup">Sign Up</a>
        @else
            <!-- Logged in -->
        <div class="user-profile" id="user-toggle">
            <img src="{{ auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=6f42c1&color=fff' }}" alt="">
            <div class="user-info">
                <span class="name">{{ auth()->user()->name }}</span><br>
                <span class="email">{{ auth()->user()->email }}</span>
            </div>

            <div class="dropdown-menu" id="user-dropdown">
                <ul>
                    <li><a href="{{ route('profile.edit') }}">View profile</a></li>
                    <li><a href="{{ route('user.registrations.index') }}">Registrations</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        @endguest
    </div>
</nav>