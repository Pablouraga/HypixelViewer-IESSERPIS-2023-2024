@extends('layouts.general')

@section('title', session('username') . ' - HypixelViewer')

@section('content')
    <h1 class="text-center">{{ session('username') }}</h1>
    <img src="https://crafatar.com/avatars/{{ str_replace('-', '', session('uuid')) }}?size=90&overlay" alt="Avatar">

@endsection
