@extends('layouts.general')

@section('title', 'Dashboard - HypixelViewer')

@section('content')

    <div class="container mt-3 mb-3">
        <h1 class="text-center">Dashboard</h1>
        <div class="row">
            <div class="col-md-6 mt-3">
                <a href="{{ route('tickets.index') }}" class="btn btn-primary btn-lg btn-block w-100">Tickets</a>
            </div>
            <div class="col-md-6 mt-3">
                <a href="{{ route('users.index') }}" class="btn btn-primary btn-lg btn-block w-100">Users</a>
            </div>
        </div>
    </div>

@endsection
