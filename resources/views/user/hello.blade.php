@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add Ticket') }}</div>

                    <div class="card-body">
                        <form action="{{ route('user.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea name="message" class="form-control" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Add Ticket</button>
                        </form>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header">{{ __('My Ticket') }}</div>

                    <div class="card-body">
                        <a href="{{ route('user.index') }}" class="btn btn-primary">View My Ticket</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
