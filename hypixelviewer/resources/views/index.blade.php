@extends('layouts.general')

@section('title', 'Home - HypixelViewer')

@section('content')
    <form class="form-inline" action="{{ route('playerFind') }}" method="POST">
        @csrf
        <div class="container">
            <div class="input-group">
                <label for="username"></label>
                <input type="text" name="username" placeholder="Enter player name" class="form-control">
                <button type="submit" class="btn btn-outline-secondary">Search</button>
            </div>
        </div>
    </form>

    {{-- @if (session('error'))
        <p>{{ session('error') }}</p>
    @endif --}}
@endsection
