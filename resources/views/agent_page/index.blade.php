@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Agent Page</h1>

        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>User</th>
                    <th>Close the Ticket</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->id }}</td>
                        <td>{{ $ticket->title }}</td>
                        <td>{{ $ticket->message }}</td>
                        <td>{{ $ticket->priority }}</td>
                        <td>{{ $ticket->status }}</td>
                        <td>{{ $ticket->created_at }}</td>
                        <td>{{ $ticket->updated_at }}</td>
                        <td>{{ $ticket->user->name }}</td>
                        <td>
                            <a href="{{ route('agent_page.edit', $ticket->id) }}"
                                class="btn btn-primary"
                                onclick="return confirm('Are you sure you want to close this ticket?')">Close</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
