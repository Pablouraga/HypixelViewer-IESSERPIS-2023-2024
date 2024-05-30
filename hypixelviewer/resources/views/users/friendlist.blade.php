@extends('layouts.general')

@section('title', Auth::user()->username . ' - HypixelViewer')

@section('content')
    <div class="container">
        <h1 class="text-center">{{ Auth::user()->username }}</h1>

        {{-- Received friends --}}
        @foreach ($friends as $friend)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Sender - {{ $friend->sender }}</h5>
                    <p class="card-text">Receiver - {{ $friend->receiver }}</p>
                    {{-- <p class="card-text">{{ $friend->pivot->status }}</p> --}}
                </div>
            </div>
        @endforeach
    </div>
@endsection
