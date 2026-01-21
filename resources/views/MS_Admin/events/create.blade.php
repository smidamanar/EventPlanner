@extends('layouts.admin')

@section('title', 'Create Event')

@section('content')
<div class="form-container">
    <p>Create Event</p>
    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Event Title</label>
            <input type="text" name="title" placeholder="Title" required>
        </div>
        <div class="form-group">
            <label>Category</label>
            <select name="category_id" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="date-group">
            <div class="form-group">
                <label>Start date</label>
                <input type="date" placeholder="date" name="start_date" required>
            </div>
            <div class="form-group">
                <label>End date</label>
                <input type="date" placeholder="date" name="end_date" required>
            </div>
        </div>
        <div class="place-capacity">
            <div class="form-group">
                <label>Place</label>
                <input type="text" name="place" placeholder="Place" required>
            </div>
            <div class="form-group">
                <label>Capacity</label>
                <input type="number" name="capacity" placeholder="Capacity" required>
            </div>
        </div>
        <div class="pricing-group">
            <div class="form-group">
                <label>Pricing</label>
                <select name="pricing" required>
                    <option value="free">Free Access</option>
                    <option value="paid">Paid</option>
                </select>
            </div>
            <div class="form-group">
                <label>Amount</label>
                <input type="number" name="amount" placeholder="Amount" step="0.01">
            </div>
        </div>
        <p>Event Description</p>
        <div class="form-group">
            <label>Event Image</label>
            <div class="image-upload">
                <input type="file" name="image" accept="image/*">
            </div>
        </div>
        <div class="form-group">
            <label>Event Description</label>
            <textarea name="description" placeholder="Type here.." rows="6" required></textarea>
        </div>
        <button class="create-button" type="submit">Create event</button>
    </form>
</div>
@endsection