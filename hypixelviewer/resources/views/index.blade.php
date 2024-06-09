@extends('layouts.general')

@section('title', 'Home - HypixelViewer')

@section('content')
    <div class="container mt-5">
        <form class="form-inline" action="{{ route('playerFind') }}" method="POST">
            @csrf
            <div class="input-group">
                <label for="username"></label>
                <input type="text" name="username" placeholder="Enter player name" class="form-control">
                <button type="submit" class="btn btn-outline-secondary">Search</button>
            </div>
        </form>
    </div>

    @auth
        @isset($favourites)
            <div class="container">
                <div class="row mt-5">
                    @foreach ($favourites as $player)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <img src="https://crafatar.com/avatars/{{ str_replace('-', '', $player->uuid) }}?size=96&overlay"
                                            alt="Avatar" class="mr-3">
                                        <h5 class="card-title" style="margin-left: 10px;">{{ $player->username }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endisset
    @endauth
@endsection
