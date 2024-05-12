@extends('homelayout')

@section('title', session('username') . ' - HypixelViewer')

@section('content')
    <h1 class="text-center">{{ session('username') }}</h1>
    <div class="container">
        <a class="btn btn-outline-primary" href="{{ route('serverStats', session('username')) }}">Server Stats</a>
        <a class="btn btn-outline-primary">Auction history</a>
        <a class="btn btn-outline-primary" href="{{ route('skyblockStats', session('username')) }}">Skyblock profile</a>
        <a class="btn btn-outline-primary">Guild details</a>
    </div>
@endsection
