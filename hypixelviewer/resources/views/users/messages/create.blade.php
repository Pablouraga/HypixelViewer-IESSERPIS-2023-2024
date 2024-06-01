@extends('layouts.general')

@section('title', 'New message - HypixelViewer')

@section('content')
    <div class="container mt-3">
        <h1 class="text-center">New message</h1>
        <form action="{{ route('messageStore', $receiver->id) }}" method="post" class="mb-3">
            @csrf
            <div class="form-group mb-3">
                <label for="receiver">Receiver</label>
                <input type="text" class="form-control" id="receiver" name="receiver" value="{{ $receiver->email }}"
                    required readonly>
            </div>
            <div class="form-group mb-3">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>
@endsection
