@extends('layouts.general')

@section('title', 'Login - HypixelViewer')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title">Log in!</h5>
                        <form method="POST" action="{{ route('signup') }}">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                {{-- Username --}}
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>

                                {{-- Email --}}
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>

                                {{-- Password --}}
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>

                                {{-- Errors --}}
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger mt-2">{{ $error }}</div>
                                    @endforeach
                                @endif

                                <div class="mt-2">
                                    <a href="{{ route('login') }}">Already have an account? Log in now!</a>
                                </div>
                                <div class="mt-2">
                                    <input type="submit" value="Sign up" class="btn btn-primary">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
