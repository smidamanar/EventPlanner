@extends('layouts.admin')

@section('title', 'List of categories')

@section('content')
    <h1>List of categories</h1>

    <div class="events-table">
        <header>
            <h3>Categories</h3>
            <a href="{{ route('admin.categories.create') }}" class="create-event-btn">Create category</a>
        </header>

        <div class="table-header categories-header">
            <div>Category</div>
            <div></div>
        </div>

        @forelse ($categories as $category)
            <div class="table-row categories-row">
                <div class="event-name">{{ $category->name }}</div>

                <div class="actions">
                    <button class="actions-btn" onclick="event.stopPropagation(); toggleDropdown({{ $loop->index }})">...</button>

                    <div class="actions-dropdown" id="dropdown-{{ $loop->index }}">
                        <ul>
                            <li>
                                <a href="{{ route('admin.categories.edit', $category) }}">Edit</a>
                            </li>

                            <li>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-danger"
                                            onclick="return confirm('Delete this category permanently? This cannot be undone.')">
                                        Delete
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        @empty
            <div style="padding: 40px; text-align: center; color: #777;">
                No categories found.
            </div>
        @endforelse
    </div>

    {{ $categories->links() }}
@endsection

@section('scripts')
    <script>
        function toggleDropdown(index) {
            document.querySelectorAll('.actions-dropdown').forEach(el => {
                if (el.id !== `dropdown-${index}`) el.style.display = 'none';
            });
            const dropdown = document.getElementById(`dropdown-${index}`);
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        }

        document.addEventListener('click', e => {
            if (!e.target.closest('.actions')) {
                document.querySelectorAll('.actions-dropdown').forEach(menu => menu.style.display = 'none');
            }
        });
    </script>
@endsection