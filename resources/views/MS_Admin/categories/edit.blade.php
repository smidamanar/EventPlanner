@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')
    <h1>Edit Category</h1>

    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Category Name</label>
            <input type="text" name="name" placeholder="Enter category name" value="{{ old('name', $category->name) }}" required>
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="modal-actions" style="margin-top: 30px; display: flex; gap: 15px; justify-content: flex-end;">
            <a href="{{ route('admin.categories.index') }}" class="cancel-btn">Cancel</a>
            <button type="submit" class="create-btn">Update</button>
        </div>
    </form>
@endsection