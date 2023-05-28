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
            <h2>Agent Dashboard</h2>
        </div>
        <div class="pull-right">
            <a href="{{ route('agent.create') }}" class="btn btn-success">Add New Agent</a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>

@endif

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Salary</th>
        <th>Email</th>
        <th>Position</th>
        <th width="280px">Action</th>
    </tr>
        @foreach ($agents as $agent)
        <tr>
            <td>{{ $agent->id }}</td>
            <td>{{ $agent->name }}</td>
            <td>{{ $agent->salary }}</td>
            <td>{{ $agent->email }}</td>
            <td>{{ $agent->position }}</td>

            <td>
                <form action="{{ route('agent.destroy',$agent->id) }}" method="post">
                    <a href="{{ route('agent.show',$agent->id) }}" class="btn btn-info">Show</a>
                    <a href="{{ route('agent.edit',$agent->id) }}" class="btn btn-primary">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                </form>
            </td>
        @endforeach
    </tr>

</table>
{{ $agents->links() }}
@endsection
