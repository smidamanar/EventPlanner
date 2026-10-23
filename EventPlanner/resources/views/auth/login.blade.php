@extends('layouts.auth')

@section('title', 'Sign In - Event Planner')

@section('left-bg-image', 'https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?auto=format&fit=crop&q=80')

@section('left-content')
    <h1>Hello<br>Friend</h1>
    <p>To keep connected with us please provide us with your information</p>
    <a href="{{ route('register') }}" class="btn-switch">Sign Up</a>
@endsection

@section('form-content')
    <div class="logo">Event <span>Planner</span></div>
    <h2 class="title">Sign In to Event Planner</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label>YOUR EMAIL</label>
            <input type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autofocus 
                   autocomplete="email"
                   placeholder="Enter your mail">
            @error('email')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>PASSWORD</label>
            <input type="password" 
                   name="password" 
                   required 
                   autocomplete="current-password"
                   placeholder="Enter your password">
            @error('password')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="forgot">
            <a href="{{ route('password.request') }}">Forgot your password?</a>
        </div>

        <div class="remember-me" style="margin: 1rem 0; font-size: 0.9rem;">
            <label>
                <input type="checkbox" name="remember" id="remember">
                Remember me
            </label>
        </div>

        <button type="submit" class="btn-primary">Sign In</button>
    </form>
@endsection