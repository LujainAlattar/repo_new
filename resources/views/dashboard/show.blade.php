@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="pull-left">
                <h2>User Details</h2>
            </div>
            <div class="pull-right">
                <a href="{{ route('dashboard.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <strong>ID:</strong>
                {{ $user->id }}
            </div>
            <div class="form-group">
                <strong>Name:</strong>
                {{ $user->name }}
            </div>
            <div class="form-group">
                <strong>Password:</strong>
                {{ $user->password }}
            </div>
            <div class="form-group">
                <strong>Image:</strong>
                @if ($user->image)
                    <img src="{{ asset('public/images/' . $user->image) }}" alt="User Image" width="100">
                @else
                    No Image
                @endif
            </div>
        </div>
    </div>
@endsection
