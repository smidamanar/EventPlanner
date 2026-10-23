<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') - Event Planner</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Main application CSS (if you still have one) -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Separated auth layout styles -->
    <link rel="stylesheet" href="{{ asset('MS_assets/css/auth.css') }}">

</head>
<body>

<div class="split">

    <div class="left" 
         style="background-image: linear-gradient(rgba(0,0,0,0.55), rgba(0,60,120,0.4)), url('@yield('left-bg-image', 'https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?auto=format&fit=crop&q=80&w=2070')');">
        @yield('left-content')
    </div>

    <div class="right">
        @yield('form-content')
    </div>

</div>

</body>
</html>