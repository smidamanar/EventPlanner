@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="dashboard-container">
        <!-- Title -->
        <h1>List of Events</h1>

        <!-- Table Container -->
        <div class="events-table">
            <div class="table-header">
                <h3>Events</h3>
                <a href="{{ route('admin.events.create') }}" class="create-event-btn">Create event</a>
            </div>

            <div class="table-grid">
                <!-- Table Head -->
                <div class="table-head">
                    <div>Event name</div>
                    <div>Start date</div>
                    <div>End date</div>
                    <div>Pricing</div>
                    <div>Capacity</div>
                    <div>Place</div>
                    <div></div>
                </div>

                <!-- Rows -->
                @forelse ($events as $event)
                    <div class="table-row">
                        <div class="event-name">{{ $event->title }}</div>
                        <div>{{ $event->start_date?->format('M d, Y, ga') ?? '—' }}</div>
                        <div>{{ $event->end_date?->format('M d, Y, ga') ?? '—' }}</div>
                        <div class="pricing">{{ $event->is_free ? 'Free' : ($event->price ? $event->price . '$' : '—') }}</div>
                        <div>{{ $event->capacity ?? '—' }}</div>
                        <div>{{ $event->place ?? '—' }}</div>
                        <div class="actions">
                            <button class="actions-btn" onclick="toggleDropdown({{ $loop->index }})">⋯</button>
                            <div class="actions-dropdown" id="dropdown-{{ $loop->index }}">
                                <ul>
                                    <li><a href="{{ route('admin.events.edit', $event) }}">Edit</a></li>
                                    <li>
                                        <form action="{{ route('admin.events.archive', $event) }}" method="POST" onsubmit="return confirm('Archive this event?');">
                                            @csrf
                                            <button type="submit">Archive</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="table-row empty">
                        <div colspan="7">No events found.</div>
                    </div>
                @endforelse
            </div>

            <div class="pagination">
                {{ $events->links() }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function toggleDropdown(index) {
            // Close all other dropdowns
            document.querySelectorAll('.actions-dropdown').forEach(el => {
                if (el.id !== `dropdown-${index}`) el.style.display = 'none';
            });

            // Toggle clicked one
            const dropdown = document.getElementById(`dropdown-${index}`);
            if (dropdown) {
                dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
            }
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.actions')) {
                document.querySelectorAll('.actions-dropdown').forEach(menu => {
                    menu.style.display = 'none';
                });
            }
        });
    </script>
@endsection