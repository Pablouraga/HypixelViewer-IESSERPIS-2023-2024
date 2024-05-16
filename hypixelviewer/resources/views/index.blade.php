@extends('layouts.general')

@section('title', 'Home - HypixelViewer')

@section('content')
    <form action="{{ route('generalView') }}" method="get">
        @csrf
        <label for="username"></label>
        <input type="text" name="username" placeholder="Enter player name">
        <button type="submit">Submit</button>
    </form>

    @if (session('error'))
        <p>{{ session('error') }}</p>
    @endif
@endsection
