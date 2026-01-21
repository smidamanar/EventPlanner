@extends('layouts.admin')

@section('title', 'List of registrations')

@section('content')
    <h1>List of registrations</h1>

    <div class="table-header">
        <div>Event title</div>
        <div>Start date</div>
        <div>User's email</div>
    </div>

    @forelse ($registrations as $registration)
        <div class="table-row">
            <div>{{ $registration->event->title ?? '—' }}</div>
            <div>{{ $registration->event->start_date?->format('M j, Y, ga') ?? '—' }}</div>
            <div>{{ $registration->user->email ?? auth()->user()->email }}</div>
        </div>
    @empty
        <div style="padding: 40px; text-align: center; color: #777;">
            No registrations found.
        </div>
    @endforelse
@endsection