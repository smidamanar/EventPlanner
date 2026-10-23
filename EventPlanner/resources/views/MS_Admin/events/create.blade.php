@extends('layouts.admin')

@section('title', 'Create Event')

@section('content')
<div class="form-container">
    <p class="form-title">Create Event</p>

    @if ($errors->any())
        <div class="error-message">
            <strong>Whoops! Something went wrong:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Event Title</label>
            <input type="text" name="title" value="{{ old('title') }}" placeholder="Title" required>
            @error('title') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Category</label>
            <select name="category_id" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="date-group">
            <div class="form-group">
                <label>Start date</label>
                <input type="date" name="start_date" value="{{ old('start_date') }}" required>
                @error('start_date') <span class="error-text">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label>End date</label>
                <input type="date" name="end_date" value="{{ old('end_date') }}" required>
                @error('end_date') <span class="error-text">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="place-capacity">
            <div class="form-group">
                <label>Place</label>
                <input type="text" name="place" value="{{ old('place') }}" placeholder="Place" required>
                @error('place') <span class="error-text">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label>Capacity</label>
                <input type="number" name="capacity" value="{{ old('capacity') }}" placeholder="Capacity" required min="1">
                @error('capacity') <span class="error-text">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="pricing-group">
            <div class="form-group">
                <label>Pricing</label>
                <select name="pricing" id="pricing" required>
                    <option value="free" {{ old('pricing') == 'free' ? 'selected' : '' }}>Free Access</option>
                    <option value="paid" {{ old('pricing') == 'paid' ? 'selected' : '' }}>Paid</option>
                </select>
                @error('pricing') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Amount</label>
                <input type="number" name="price" id="price" value="{{ old('price') }}" 
                       placeholder="Amount" step="0.01" min="0" disabled>
                @error('price') <span class="error-text">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-group">
            <label>Event Image</label>
            <div class="image-upload">
                <input type="file" name="image" accept="image/*">
            </div>
            @error('image') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Event Description</label>
            <textarea name="description" placeholder="Type here.." rows="6" required>{{ old('description') }}</textarea>
            @error('description') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <button class="create-button" type="submit">Create event</button>
    </form>
</div>

<script>
    const pricingSelect = document.getElementById('pricing');
    const priceInput = document.getElementById('price');

    function togglePriceField() {
        if (pricingSelect.value === 'paid') {
            priceInput.disabled = false;
            priceInput.required = true;
            priceInput.min = 0.01;
        } else {
            priceInput.disabled = true;
            priceInput.required = false;
            priceInput.value = 0;
        }
    }

    togglePriceField();
    pricingSelect.addEventListener('change', togglePriceField);
</script>
@endsection