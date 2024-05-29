@extends('layouts.general')

@section('title', session('username') . ' - HypixelViewer')

@section('content')
    <h1 class="text-center">{{ session('username') }}</h1>
    @auth
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
        {{-- Jugador que tiene la cuenta enlazada --}}
        @isset($linked_account->linked_account)
            @if ($linked_account->username != Auth::user()->username)
                {{-- Enviar solicitud de amistad / enviar mensaje --}}
                <div>
                    <form action="{{ route('addUser') }}" method="post">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="friend" value="0">
                        <button type="submit" class="btn btn-warning">Add as friend</button>
                    </form>
                </div>
            @endisset
        @endif
    @endauth
    @isset($request)
        @dd($request)
    @endisset
    <img src="https://crafatar.com/avatars/{{ str_replace('-', '', session('uuid')) }}?size=90&overlay" alt="Avatar">

@endsection
