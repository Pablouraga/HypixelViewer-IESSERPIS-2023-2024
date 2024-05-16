@extends('layouts.general')

@section('title', session('username') . ' - HypixelViewer')

@section('content')
    @dd($guildDetails)
    @if ($guildDetails['success'] == true)
        @if ($guildDetails['guild'] == null)
            <div class="container">
                <div class="alert alert-danger mt-3" role="alert">
                    <h4 class="alert-heading">Error!</h4>
                    <p>Player is not in a guild!</p>
                </div>
            </div>
        @else
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mt-3">
                            <div class="card-header">
                                <h5 class="card-title">{{ $guildDetails['guild']['name'] }}</h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card mt-3">
                            <div class="card-header">
                                <h5 class="card-title">Guild Members</h5>
                            </div>
                            <div class="card-body">
                                @foreach ($guildDetails['guild']['members'] as $item)
                                    <div class="card mt-3">
                                        <div class="card-body">
                                            <h5
                                                class="card-title
                                    @if ($item['rank'] == 'Guild Master') text-danger @endif">
                                                {{ $item['username'] }} - {{ $item['rank'] }}
                                            </h5>
                                            <p class="card-text">Joined:
                                                {{ \Carbon\Carbon::createFromTimestamp($item['joined'] / 1000)->format('d-m-Y h:i:s') }}
                                            </p>
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
