<!-- u_tickets.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Your Tickets</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>message</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->title }}</td>
                        <td>{{ $ticket->message }}</td>
                        <td>{{ $ticket->status }}</td>
                        <td>{{ $ticket->priority }}</td>
                        <td>{{ $ticket->created_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No tickets found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
