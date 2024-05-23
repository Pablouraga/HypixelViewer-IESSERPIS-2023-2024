@extends('layouts.general')

@section('title', 'Create a ticket - HypixelViewer')

@section('content')
    <div class="container">
        <h1 class="text-center">Create a ticket</h1>
        <form action="{{ route('storeTicket') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="sender_email">Email</label>
                <input type="text" name="sender_email" class="form-control"
                    @auth value="{{ Auth::user()->email }}" readonly @endauth required>
            </div>
            @error('sender_email')
                <div class="alert alert-danger mt-2">{{ $message }} <br> {{ old('sender_email') }}</div>
            @enderror
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" name="subject" class="form-control" required>
            </div>
            @error('subject')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label for="text">Message</label>
                <textarea name="text" class="form-control" required></textarea>
            </div>
            @error('text')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
@endsection
