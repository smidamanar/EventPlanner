<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Planner - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('MS_assets/css/admin.css') }}">
</head>
<body>
    <header>
        <div class="logo">Event <span>Planner</span></div>

        <nav>
            <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">Categories</a>
            <a href="{{ route('admin.events.index') }}" class="{{ request()->routeIs('admin.events.*') ? 'active' : '' }}">Events</a>
        </nav>

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
    </header>

    <main>
        @yield('content')
    </main>

    @yield('scripts')

    <script>
        const toggle = document.getElementById('user-toggle');
        const menu = document.getElementById('user-dropdown');

        toggle?.addEventListener('click', e => {
            e.stopPropagation();
            menu?.classList.toggle('show');
        });

        document.addEventListener('click', e => {
            if (!toggle?.contains(e.target)) {
                menu?.classList.remove('show');
            }
        });
    </script>
</body>
</html>