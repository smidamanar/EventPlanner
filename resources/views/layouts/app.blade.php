<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title') - Event Planner</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Fixed path: use forward slashes (Laravel normalizes them on Windows anyway) -->
    <link rel="stylesheet" href="{{ asset('MS_assets/css/app.css') }}">
</head>
<body>

    <!-- Navbar -->
    <x-navbar />



    <!-- Page content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <x-footer />

    <!-- Booking Popup (only on event show page) -->
    @yield('booking-popup')

    <!-- Fixed path: forward slashes only -->
    <script src="{{ asset('MS_assets/js/app.js') }}" defer></script>
</body>
</html>