@extends('layouts.general')

@section('title', session('username') . ' - HypixelViewer')

@section('content')
    <h1 class="text-center mt-3">{{ session('username') }}</h1>
    @if ($guildDetails['success'] == true)
        @if ($guildDetails['guild'] == null)
            <div class="container mt-3 mb-3">
                <div class="alert alert-danger mt-3" role="alert">
                    <h4 class="alert-heading">Error!</h4>
                    <p>Player is not in a guild!</p>
                </div>
            </div>
        @else
            <div class="container mt-3 mb-3">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mt-3">
                            <div class="card-header">
                                <h5 class="card-title">{{ $guildDetails['guild']['name'] }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="card-text">
                                    <p>Created:
                                        {{ \Carbon\Carbon::createFromTimestamp($guildDetails['guild']['created'] / 1000)->format('d-m-Y h:i:s') }}
                                    </p>
                                    <p>Description: {{ $guildDetails['guild']['description'] }}</p>
                                    <p>Members: {{ count($guildDetails['guild']['members']) }}</p>
                                    <p>Tag: {{ $guildDetails['guild']['tag'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card mt-3">
                            <div class="card-header">
                                <h5 class="card-title">Guild Ranks</h5>
                            </div>
                            <div class="card-body">
                                @foreach ($guildDetails['guild']['ranks'] as $item)
                                    <div class="card mt-3">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                {{ $item['name'] }}
                                            </h5>
                                            <p class="card-text">Tag: {{ $item['tag'] }}</p>
                                            <p class="card-text">Creation date:
                                                {{ \Carbon\Carbon::createFromTimestamp($item['created'] / 1000)->format('d-m-Y h:i:s') }}
                                            </p>
                                            {{-- <p class="card-text">Priority: {{ $item['priority'] }}</p> --}}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif
@endsection
