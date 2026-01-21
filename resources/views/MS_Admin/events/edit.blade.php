@extends('layouts.admin')

@section('title', 'Edit Event')

@section('content')
    <h1>Edit Event</h1>

    <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Event Title</label>
            <input type="text" name="title" placeholder="Title" value="{{ old('title', $event->title) }}" required>
            @error('title') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Category</label>
            <select name="category_id" required>
                <option value="">Select category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $event->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="date-group">
            <div class="form-group">
                <label>Start date</label>
                <input type="date" name="start_date" value="{{ old('start_date', $event->start_date?->format('Y-m-d')) }}" required>
                @error('start_date') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label>End date</label>
                <input type="date" name="end_date" value="{{ old('end_date', $event->end_date?->format('Y-m-d')) }}" required>
                @error('end_date') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="place-capacity">
            <div class="form-group">
                <label>Place</label>
                <input type="text" name="place" placeholder="Place" value="{{ old('place', $event->place) }}" required>
                @error('place') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label>Capacity</label>
                <input type="number" name="capacity" placeholder="Capacity" value="{{ old('capacity', $event->capacity) }}" min="1" required>
                @error('capacity') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="pricing-group">
            <div class="form-group">
                <label>Pricing</label>
                <select name="is_free" id="pricing-type" required>
                    <option value="1" {{ old('is_free', $event->is_free ? 1 : 0) == 1 ? 'selected' : '' }}>Free Access</option>
                    <option value="0" {{ old('is_free', $event->is_free ? 1 : 0) == 0 ? 'selected' : '' }}>Paid</option>
                </select>
            </div>
            <div class="form-group">
                <label>Amount</label>
                <input type="number" name="price" id="price-amount" step="0.01" min="0" 
                       placeholder="Amount" value="{{ old('price', $event->price) }}"
                       {{ old('is_free', $event->is_free ? 1 : 0) == 1 ? 'disabled' : '' }}>
                @error('price') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>

        <h2 class="section-title">Event Description</h2>

        <div class="form-group">
            <label>Event Image</label>
            <div class="image-upload">
                @if ($event->image)
                    <img src="{{ asset('storage/' . $event->image) }}" alt="Current" style="max-width:100%; height:auto; margin-bottom:10px;">
                @endif
                <input type="file" name="image" accept="image/*">
                <span class="camera-icon">📷</span>
            </div>
            @error('image') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Event Description</label>
            <textarea name="description" rows="6" placeholder="Type here.." required>{{ old('description', $event->description) }}</textarea>
            @error('description') <span class="error">{{ $message }}</span> @enderror
        </div>

        <button class="create-button" type="submit">Update event</button>
    </form>
@endsection

@section('scripts')
    <script>
        document.getElementById('pricing-type').addEventListener('change', function() {
            const price = document.getElementById('price-amount');
            price.disabled = this.value === '1';
            if (price.disabled) price.value = '';
        });
    </script>
@endsection