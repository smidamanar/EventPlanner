@extends('layouts.app')

@section('title', 'My Registrations')

@section('content')
    <h1>My Registrations</h1>

    <div class="events-table">
        <div class="table-header">
            <div>Event Title</div>
            <div>Start Date</div>
            <div>Registered At</div>
            <div>Actions</div>
        </div>

        @forelse ($registrations as $registration)
            <div class="table-row">
                <div>{{ $registration->event?->title ?? '—' }}</div>
                <div>
                    {{ $registration->event?->start_date 
                        ? $registration->event->start_date->format('M j, Y – g:ia') 
                        : '—' }}
                </div>
                <div>{{ $registration->created_at?->format('M j, Y H:i') ?? '—' }}</div>
                
                <div class="actions">
                    <button class="actions-btn" 
                            type="button"
                            data-registration-id="{{ $registration->id }}"
                            aria-label="More options">…</button>

                    <div class="actions-dropdown" 
                         id="dropdown-{{ $registration->id }}">
                        <ul>
                            <li>
                                <form action="{{ route('registrations.destroy', $registration) }}" 
                                      method="POST" 
                                      style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-danger delete-btn"
                                            onclick="return confirm('Delete this registration permanently? This cannot be undone.')">
                                        Delete
                                    </button>
                                </form>
                            </li>
                           
                        </ul>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <p>No registrations found.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $registrations->links() }}
    </div>

    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
           
            document.querySelectorAll('.actions-btn').forEach(button => {
                button.addEventListener('click', function (e) {
                    e.stopPropagation();
                    e.preventDefault();

                    const dropdownId = 'dropdown-' + this.dataset.registrationId;
                    const dropdown = document.getElementById(dropdownId);

                    if (!dropdown) return;

                    
                    document.querySelectorAll('.actions-dropdown.show').forEach(el => {
                        if (el !== dropdown) {
                            el.classList.remove('show');
                        }
                    });

                    
                    dropdown.classList.toggle('show');
                });
            });

           
            document.addEventListener('click', function (e) {
                if (!e.target.closest('.actions')) {
                    document.querySelectorAll('.actions-dropdown.show').forEach(el => {
                        el.classList.remove('show');
                    });
                }
            });

           
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    document.querySelectorAll('.actions-dropdown.show').forEach(el => {
                        el.classList.remove('show');
                    });
                }
            });
        });
    </script>
@endsection