@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="pull-left">
                <h2>Ticket Details</h2>
            </div>
            <div class="pull-right">
                <a href="{{ route('ticket.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <strong>ID:</strong>
                {{ $ticket->id }}
            </div>
            <div class="form-group">
                <strong>Title:</strong>
                {{ $ticket->title }}
            </div>
            <div class="form-group">
                <strong>Message:</strong>
                {{ $ticket->message }}
            </div>
            <div class="form-group">
                <strong>Priority:</strong>
                {{ $ticket->priority }}
            </div>
            <div class="form-group">
                <strong>Status:</strong>
                {{ $ticket->status }}
            </div>
            <div class="form-group">
                <strong>Agent ID:</strong>
                {{ $ticket->agent_id }}
            </div>
        </div>
    </div>
@endsection
