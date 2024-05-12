@extends('homelayout')

@section('title', 'Home - HypixelViewer')

@section('content')
    <form action="{{ route('player.show') }}" method="get">
        @csrf
        <label for="username"></label>
        <input type="text" name="username" placeholder="Enter player name">
        <button type="submit">Submit</button>
    </form>

    @if (session('error'))
        <p>{{ session('error') }}</p>
    @endif
@endsection
