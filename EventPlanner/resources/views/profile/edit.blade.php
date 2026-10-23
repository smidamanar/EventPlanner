@extends( auth()->user()->is_admin ? 'layouts.admin' : 'layouts.app' )

@section('title', 'My Profile')

@section('content')
    <div class="profile-container">
        <p>My Profile</p>

        @if (session('status') === 'profile-updated')
            <div class="alert success">
                Profile updated successfully.
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" class="profile-form">
            @csrf
            @method('PATCH')

           
            <div class="form-group">
                <label for="name">Full Name</label>
                <input 
                    id="name" 
                    name="name" 
                    type="text" 
                    value="{{ old('name', $user->name) }}" 
                    required 
                    autocomplete="name"
                    autofocus
                >
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

           
            <div class="form-group">
                <label for="email">Email Address</label>
                <input 
                    id="email" 
                    name="email" 
                    type="email" 
                    value="{{ old('email', $user->email) }}" 
                    required 
                    autocomplete="username"
                >
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">New Password <small>(leave blank if not changing)</small></label>
                <input 
                    id="password" 
                    name="password" 
                    type="password" 
                    autocomplete="new-password"
                >
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            
            <div class="form-group">
                <label for="password_confirmation">Confirm New Password</label>
                <input 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    type="password" 
                    autocomplete="new-password"
                >
            </div>

          
            <div class="form-actions">
                <button type="submit" class="btn save">Save Changes</button>
            </div>
        </form>
    </div>
@endsection