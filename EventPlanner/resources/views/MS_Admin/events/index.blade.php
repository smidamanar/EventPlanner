@extends('layouts.admin')

@section('title', 'List of Events')

@section('content')
    <h1>List of Events</h1>

    <div class="events-table">
        <header>
            <h3>Events</h3>
            <a href="{{ route('admin.events.create') }}" class="create-event-btn">Create event</a>
        </header>

        <div class="table-header">
            <div>Event name</div>
            <div>Start date</div>
            <div>End date</div>
            <div>Pricing</div>
            <div>Capacity</div>
            <div>Place</div>
            <div></div>
        </div>

        @forelse ($events as $event)
            <div class="table-row">
                <div class="event-name">{{ $event->title }}</div>
                <div>{{ $event->start_date?->format('M d, Y, ga') ?? '—' }}</div>
                <div>{{ $event->end_date?->format('M d, Y, ga') ?? '—' }}</div>
                <div class="pricing">{{ $event->is_free ? 'Free' : ($event->price ? $event->price . '$' : '—') }}</div>
                <div>{{ $event->capacity ?? '—' }}</div>
                <div>{{ $event->place ?? '—' }}</div>

                <div class="actions">
                    <button class="actions-btn" onclick="event.stopPropagation(); toggleDropdown({{ $loop->index }})">...</button>

                    <div class="actions-dropdown" id="dropdown-{{ $loop->index }}">
                        <ul>
                            <li>
                                <a href="{{ route('admin.events.edit', $event) }}">Edit</a>
                            </li>

                            <li>
                                <form action="{{ route('admin.events.archive', $event) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="text-warning" 
                                            onclick="return confirm('Archive this event?')">
                                        Archive
                                    </button>
                                </form>
                            </li>

                            <li>
                                <form action="{{ route('admin.events.destroy', $event) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-danger" 
                                            onclick="return confirm('Delete this event permanently? This cannot be undone.')">
                                        Delete
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        @empty
            <div style="padding: 40px; text-align: center; color: #777;">No events found.</div>
        @endforelse
    </div>

    {{ $events->links() }}
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