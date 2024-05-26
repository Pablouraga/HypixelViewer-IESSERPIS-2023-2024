{{-- @dd($serverStats) --}}
@extends('layouts.general')

@section('title', session('username') . ' - HypixelViewer')

@section('content')
    {{-- @dd($serverStats) --}}
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-4">
                <div class="card playerInfo mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Player Information</h5>
                        <div class="card-text">
                            {{-- {{ \Carbon\Carbon::createFromTimestamp( / 1000)->format('d-m-Y h:i:s') }} --}}
                            First login:
                            {{ \Carbon\Carbon::createFromTimestamp($serverStats['firstLogin'] / 1000)->format('d-m-Y h:i:s') }}
                            <br>
                            Last login:
                            {{ \Carbon\Carbon::createFromTimestamp($serverStats['lastLogin'] / 1000)->format('d-m-Y h:i:s') }}
                            <br>
                            Last logout:
                            {{ \Carbon\Carbon::createFromTimestamp($serverStats['lastLogout'] / 1000)->format('d-m-Y h:i:s') }}
                            <br>
                            @php
                                $online = $serverStats['lastLogout'] < $serverStats['lastLogin'];
                                $ranks = [
                                    'NONE' => 'Default',
                                    'VIP' => 'VIP',
                                    'VIP_PLUS' => 'VIP+',
                                    'MVP' => 'MVP',
                                    'MVP_PLUS' => 'MVP+',
                                    'SUPERSTAR' => 'MVP++',
                                ];
                            @endphp
                            Status: {{ $online ? 'Online' : 'Offline' }}<br>
                            Rank: @if (isset($serverStats['monthlyPackageRank']) && $serverStats['monthlyPackageRank'] == 'SUPERSTAR')
                                MVP++
                            @else
                                {{ $ranks[$serverStats['newPackageRank']] }}
                            @endif
                            <br>
                            Discord: {{ $serverStats['socialMedia']['links']['DISCORD'] }}<br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card gamemodeStats">
                    <div class="card-body">
                        <h5 class="card-title">Gamemode stats</h5>
                        <div class="card-body"></div>
                    </div>

                </div>
            </div>
        </div>

    @endsection
