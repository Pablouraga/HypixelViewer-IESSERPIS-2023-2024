@extends('layouts.general')

@section('title', session('username') . ' - HypixelViewer')

@section('content')
    <h1 class="text-center">{{ session('username') }}</h1>
    @auth
        @if ($claimed != null)
            @if ($claimed->username != session('username'))
                <div>
                    <form action="#" method="post">
                        @csrf
                        @method('PATCH')
                        {{-- <button type="submit" class="btn btn-warning">Change visibility</button> --}}
                        <input type="image" src="{{ asset('icons/favourited.svg') }}" alt="Add to favourites">
                    </form>
                </div>
            @endif
        @endif
    @endauth
    <img src="https://crafatar.com/avatars/{{ str_replace('-', '', session('uuid')) }}?size=90&overlay" alt="Avatar">

@endsection
