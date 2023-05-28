@extends('layouts.app')

@section('content')
<div class="col-lg-12 margin-tb">
    <div class="pull-left">
        <h2>Edit Ticket</h2>
    </div>
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('ticket.index') }}"> Back</a>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('ticket.update', $ticket->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Title:</strong>
                <input type="text" name="title" value="{{ $ticket->title }}" class="form-control" placeholder="Title">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Message:</strong>
                <textarea name="message" class="form-control" placeholder="Message">{{ $ticket->message }}</textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Priority:</strong>
                <select name="priority" class="form-control">
                    <option value="low" {{ $ticket->priority == 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ $ticket->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ $ticket->priority == 'high' ? 'selected' : '' }}>High</option>
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Status:</strong>
                <select name="status" class="form-control">
                    <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>Open</option>
                    <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>User:</strong>
                <select name="user_id" class="form-control">
                    <option value="">Select User</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $ticket->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Agent ID:</strong>
                <select name="agent_id" class="form-control">
                    <option value="">Select Agent</option>
                    @foreach($agents as $agent)
                    <option value="{{ $agent->id }}" {{ $ticket->agent_id == $agent->id ? 'selected' : '' }}>
                        {{ $agent->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="text-center col-xs-12 col-sm-12 col-md-12">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
@endsection
