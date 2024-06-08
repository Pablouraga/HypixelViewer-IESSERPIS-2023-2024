@extends('layouts.general')

@section('title', session('username') . ' - HypixelViewer')

@section('content')
    <h1 class="text-center mt-3">{{ session('username') }}</h1>
    <div class="container mb-3 mt-3">
        <img src="https://crafatar.com/avatars/{{ str_replace('-', '', session('uuid')) }}?size=90&overlay" alt="Avatar">
        @auth
            {{-- Jugador que tiene la cuenta enlazada --}}
            @isset($linked_account->linked_account)
                @if ($linked_account->username != Auth::user()->username)
                    {{-- Enviar solicitud de amistad / enviar mensaje --}}
                    <div>
                        @if ($friendshipStatus == 'Accepted')
                            <form action="{{ route('messageCreate', ['receiver' => $linked_account->username]) }}" method="get">
                                <button type="submit" class="btn btn-primary">Send message</button>
                            </form>
                        @elseif ($friendshipStatus == 'Pending')
                            <button class="btn btn-secondary">Pending friend request</button>
                        @else
                            <form action="{{ route('addUser') }}" method="post">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="friend" value="0">
                                <button type="submit" class="btn btn-warning">Add as friend</button>
                            </form>
                        @endif
                    </div>
                @endisset
            @endif
            {{-- Icono que al pulsar ejecute la funcion toggleFavourite() dentro de PlayerController --}}
            <div>
                <form action="{{ route('toggleFavourite', $player) }}" method="post">
                    @csrf
                    @method('PATCH')
                    @if ($favourites)
                        <input type="hidden" name="favourite" value="0">
                        <button type="submit" class="btn btn-danger">Remove from favourites</button>
                    @else
                        <input type="hidden" name="favourite" value="1">
                        <button type="submit" class="btn btn-success">Add to favourites</button>
                    @endif
                </form>
            </div>
        @endauth
        <div class="row mt-3">
            <a href="{{ route('serverStats', session('username')) }}" class="btn btn-primary btn-block col mx-3">Server
                Stats</a>
            <a href="{{ route('auctionHistory', session('username')) }}" class="btn btn-primary btn-block col mx-3">Auction
                History</a>
        </div>
        <div class="row mt-3">
            <a href="{{ route('skyblockStats', session('username')) }}" class="btn btn-primary btn-block col mx-3">Skyblock
                Profile</a>
            <a href="{{ route('guildDetails', session('username')) }}" class="btn btn-primary btn-block col mx-3">Guild
                Details</a>
        </div>
    </div>
@endsection
