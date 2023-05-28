@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="text-center">
            <h3>Choose Dashboard:</h3>
            <div class="btn-group" role="group" aria-label="Dashboards">
                <a href="{{ route('dashboard.index') }}" class="btn btn-primary m-2">User Dashboard</a>
                <a href="{{ route('agent.index') }}" class="btn btn-primary m-2">Agent Dashboard</a>
                <a href="{{ route('ticket.index') }}" class="btn btn-primary m-2">Ticket Dashboard</a>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-12">
        <div class="pull-left">
            <h2>Ticket Dashboard</h2>
        </div>
        <div class="pull-right">
            <a href="{{ route('ticket.create') }}" class="btn btn-success mb-3">Add New Ticket</a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>

@endif

<div class="row">
    <div class="col-12">
        <form action="{{ route('ticket.store') }}" method="GET" class="form-inline mb-3">
            @csrf
            <label for="status">Status:</label>
            <select name="status" id="status" class="form-control mx-2">
                <option value="">All</option>
                <option value="open" {{ Request::get('status') === 'open' ? 'selected' : '' }}>Open</option>
                <option value="closed" {{ Request::get('status') === 'closed' ? 'selected' : '' }}>Closed</option>
            </select>

            <label for="priority">Priority:</label>
            <select name="priority" id="priority" class="form-control mx-2">
                <option value="">All</option>
                <option value="high" {{ Request::get('priority') === 'high' ? 'selected' : '' }}>High</option>
                <option value="medium" {{ Request::get('priority') === 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="low" {{ Request::get('priority') === 'low' ? 'selected' : '' }}>Low</option>
            </select>

            <button type="submit" class="btn btn-primary">Apply Filters</button>
        </form>
    </div>
</div>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Message</th>
        <th>Priority</th>
        <th>Status</th>
        <th>Agent Name</th>
        <th>User name</th>
        <th width="280px">Action</th>
    </tr>
        @foreach ($tickets as $ticket)
        <tr>
            <td>{{ $ticket->id }}</td>
            <td>{{ $ticket->title }}</td>
            <td>{{ $ticket->message }}</td>
            <td>{{ $ticket->priority }}</td>
            <td>{{ $ticket->status }}</td>
            <td>{{ $ticket->agent ? $ticket->agent->name : 'N/A' }}</td>
            <td>{{ $ticket->user ? $ticket->user->name : 'N/A' }}</td>

            <td>
                <form action="{{ route('ticket.destroy',$ticket->id) }}" method="post">
                    <a href="{{ route('ticket.show',$ticket->id) }}" class="btn btn-info">Show</a>
                    <a href="{{ route('ticket.edit',$ticket->id) }}" class="btn btn-primary">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                </form>
            </td>
        @endforeach
    </tr>

</table>
{{ $tickets->links() }}
@endsection
