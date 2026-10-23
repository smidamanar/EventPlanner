@extends('layouts.auth')

@section('title', 'Sign Up - Event Planner')

@section('left-bg-image', 'https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?auto=format&fit=crop&q=80')

@section('left-content')
    <h1>Welcome<br>Back</h1>
    <p>To keep connected with us provide us with your information</p>
    <a href="{{ route('login') }}" class="btn-switch">Sign In</a>
@endsection

@section('form-content')
    <div class="logo">Event <span>Planner</span></div>
    <h2 class="title">Sign Up to Event Planner</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label>YOUR NAME</label>
            <input type="text" 
                   name="name" 
                   value="{{ old('name') }}" 
                   required 
                   autofocus 
                   autocomplete="name"
                   placeholder="Enter your name">
            @error('name')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>YOUR EMAIL</label>
            <input type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autocomplete="username"
                   placeholder="Enter your email">
            @error('email')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>PASSWORD</label>
            <input type="password" 
                   name="password" 
                   required 
                   autocomplete="new-password"
                   placeholder="Enter your password">
            @error('password')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>CONFIRM PASSWORD</label>
            <input type="password" 
                   name="password_confirmation" 
                   required 
                   autocomplete="new-password"
                   placeholder="Confirm your password">
        </div>

        <button type="submit" class="btn-primary">Sign Up</button>
    </form>
@endsection