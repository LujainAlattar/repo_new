@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="pull-left">
            <h2>Agent Details</h2>
        </div>
        <div class="pull-right">
            <a href="{{ route('agent.index') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="form-group">
            <strong>ID:</strong>
            {{ $agent->id }}
        </div>
        <div class="form-group">
            <strong>Name:</strong>
            {{ $agent->name }}
        </div>
        <div class="form-group">
            <strong>Salary:</strong>
            {{ $agent->salary }}
        </div>
        <div class="form-group">
            <strong>Position:</strong>
            {{ $agent->position }}
        </div>
        <div class="form-group">
            <strong>Email:</strong>
            {{ $agent->email }}
        </div>
        <div class="form-group">
            <strong>Role ID:</strong>
            {{ $agent->role_id }}
        </div>
    </div>
</div>
@endsection
