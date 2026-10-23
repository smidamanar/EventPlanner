@extends('layouts.admin')

@section('title', 'Create Category')

@section('content')
    <h1>Create Category</h1>

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Category Name</label>
            <input type="text" name="name" placeholder="Enter category name" value="{{ old('name') }}" required>
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="modal-actions" style="margin-top: 30px; display: flex; gap: 15px; justify-content: flex-end;">
            <a href="{{ route('admin.categories.index') }}" class="cancel-btn">Cancel</a>
            <button type="submit" class="create-btn">Create</button>
        </div>
    </form>
@endsection