@extends('layouts.admin')

@section('title', 'All Registrations')

@section('content')
    <h1>All Registrations</h1>

    <div class="events-table">
        <header>
            <h3>Total registrations: {{ $registrations->total() }}</h3>
        </header>

        <div class="table-header registrations-header">
            <div>Event Title</div>
            <div>Start Date</div>
            <div>User Name</div>
            <div>User Email</div>
            <div>Registered At</div>
        </div>

        @forelse ($registrations as $registration)
            <div class="table-row registrations-row">
                <div>{{ $registration->event?->title ?? '—' }}</div>
                <div>
                    {{ $registration->event?->start_date 
                        ? $registration->event->start_date->format('M j, Y – g:ia') 
                        : '—' }}
                </div>
                <div>{{ $registration->user?->name ?? '—' }}</div>
                <div>{{ $registration->user?->email ?? '—' }}</div>
                <div>{{ $registration->created_at?->format('M j, Y H:i') ?? '—' }}</div>
            </div>
        @empty
            <div style="padding: 40px; text-align: center; color: #777;">
                No registrations found.
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $registrations->links() }}
    </div>
@endsection