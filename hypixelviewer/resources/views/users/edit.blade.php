@extends('layouts.general')

@section('title', Auth::user()->username . ' - HypixelViewer')

@section('content')
    <div class="container">
        <h1 class="text-center">{{ session('username') }}</h1>
        @auth
            {{-- Formulario para cambiar nombre de usuario y contraseña --}}
            <form action="{{ route('updateProfile', Auth::user()) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ Auth::user()->username }}">
                </div>
                @error('username')
                    <div class="error">{{ $message }}</div>
                @enderror

                {{-- Linked_account --}}
                <div class="form-group">
                    <label for="linked_account">Linked account</label>
                    <input type="text" class="form-control" id="linked_account" name="linked_account"
                        value="{{ Auth::user()->linked_account }}">
                </div>
                @error('linked_account')
                    <div class="error">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label for="password">New Password (optional)</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror

                {{-- confirmar contraseña --}}
                <div class="form-group">
                    <label for="password_confirmation">Confirm New password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        @endauth
    </div>
@endsection
