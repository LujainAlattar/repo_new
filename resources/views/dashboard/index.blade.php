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
            <h2>Users Dashboard</h2>
        </div>
        <div class="pull-right">
            <a href="{{ route('dashboard.create') }}" class="btn btn-success">Add New User</a>
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
        <th>Image</th>
        <th width="280px">Action</th>
    </tr>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>
                @if ($user->image)
                <img src="{{ asset('public/images/' . $user->image) }}" alt="User Image" width="100">
                @else
                    No Image
                @endif
            </td>
            <td>
                <form action="{{ route('dashboard.destroy',$user->id) }}" method="post">
                    <a href="{{ route('dashboard.show',$user->id) }}" class="btn btn-info">Show</a>
                    <a href="{{ route('dashboard.edit',$user->id) }}" class="btn btn-primary">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                </form>
            </td>
        @endforeach
    </tr>

</table>
{{ $users->links() }}
@endsection
