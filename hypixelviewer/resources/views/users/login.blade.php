@extends('layouts.general')

@section('title', 'Login - HypixelViewer')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title">Log in!</h5>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                {{-- Username --}}
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>

                                {{-- Password --}}
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>

                                {{-- Errors --}}
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger mt-2">{{ $error }}</div>
                                    @endforeach
                                @endif

                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                    <label class="form-check-label" for="remember">Remember me</label>
                                </div>
                                <div class="mt-2">
                                    <a href="{{ route('signup') }}">Don't have an account? Sign up now!</a>
                                </div>
                                <div class="mt-2">
                                    <a href="#">Forgot your password?</a>
                                </div>
                                <div class="mt-2">
                                    <input type="submit" value="Log in" class="btn btn-primary">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
