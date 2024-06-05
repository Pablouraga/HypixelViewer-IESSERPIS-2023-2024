{{-- @dd($serverStats) --}}
@extends('layouts.general')

@section('title', session('username') . ' - HypixelViewer')

@section('content')
    {{-- @dd($serverStats) --}}
    <div class="container">
        @if ($serverStats != null)
            <div class="row mt-3">
                <div class="col-md-4">
                    <div class="card playerInfo mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Player Information</h5>
                            <div class="card-text">
                                {{-- {{ \Carbon\Carbon::createFromTimestamp( / 1000)->format('d-m-Y h:i:s') }} --}}
                                <div class="first-login">
                                    First login:
                                    {{ \Carbon\Carbon::createFromTimestamp($serverStats['firstLogin'] / 1000)->format('d-m-Y h:i:s') }}
                                </div>

                                <div class="last-login">
                                    Last login:
                                    {{ \Carbon\Carbon::createFromTimestamp($serverStats['lastLogin'] / 1000)->format('d-m-Y h:i:s') }}
                                </div>

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
                                @if ($online != true)
                                    <div class="last-logout">
                                        Last logout:
                                        {{ \Carbon\Carbon::createFromTimestamp($serverStats['lastLogout'] / 1000)->format('d-m-Y h:i:s') }}
                                    </div>
                                @endif

                                <div class=""player-status>Status: {{ $online ? 'Online' : 'Offline' }}</div>
                                <div class="player-rank">
                                    Rank: @if (isset($serverStats['monthlyPackageRank']) && $serverStats['monthlyPackageRank'] == 'SUPERSTAR')
                                        MVP++
                                    @elseif(isset($serverStats['newPackageRank']))
                                        {{ $ranks[$serverStats['newPackageRank']] }}
                                    @else
                                        Default
                                    @endif
                                </div>
                                <div class="player-discord">
                                    {{ isset($serverStats['socialMedia']['links']['DISCORD'])
                                        ? 'Discord: ' . $serverStats['socialMedia']['links']['DISCORD']
                                        : '' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <button class="btn btn-link toggle-button">Skywars</button>
                        </div>
                        <div class="card-body content d-none">

                            <div class="coins">
                                <span class="stat-name">Coins: </span>
                                <span class="stat-value">{{ $serverStats['stats']['SkyWars']['coins'] }}</span>
                            </div>

                            <div class="played-games">
                                <span class="stat-name">Played games: </span>
                                <span
                                    class="stat-value">{{ $serverStats['stats']['SkyWars']['games_played_skywars'] }}</span>
                            </div>

                            <div class="won-games">
                                <span class="stat-name">Won games: </span>
                                <span class="stat-value">{{ $serverStats['stats']['SkyWars']['wins'] }}</span>
                            </div>

                            <div class="lost-games">
                                <span class="stat-name">Lost games: </span>
                                <span class="stat-value">{{ $serverStats['stats']['SkyWars']['losses'] }}</span>
                            </div>

                            <div class="total-kills">
                                <span class="stat-name">Total kills: </span>
                                <span class="stat-value">{{ $serverStats['stats']['SkyWars']['kills'] }}</span>
                            </div>
                        </div>

                        <div class="card-header">
                            <button class="btn btn-link toggle-button">Bedwars</button>
                        </div>
                        <div class="card-body content d-none">

                            <div class="coins">
                                <span class="stat-name">Coins: </span>
                                <span class="stat-value">{{ $serverStats['stats']['Bedwars']['coins'] }}</span>
                            </div>

                            <div class="played-games">
                                <span class="stat-name">Played games: </span>
                                <span
                                    class="stat-value">{{ $serverStats['stats']['Bedwars']['games_played_bedwars'] }}</span>
                            </div>

                            <div class="won-games">
                                <span class="stat-name">Won games: </span>
                                <span class="stat-value">{{ $serverStats['stats']['Bedwars']['wins_bedwars'] }}</span>
                            </div>

                            <div class="lost-games">
                                <span class="stat-name">Lost games: </span>
                                <span class="stat-value">{{ $serverStats['stats']['Bedwars']['losses_bedwars'] }}</span>
                            </div>

                            <div class="total-kills">
                                <span class="stat-name">Total kills: </span>
                                <span class="stat-value">{{ $serverStats['stats']['Bedwars']['kills_bedwars'] }}</span>
                            </div>
                        </div>

                        <div class="card-header">
                            <button class="btn btn-link toggle-button">Duels</button>
                        </div>
                        <div class="card-body content d-none">

                            <div class="coins">
                                <span class="stat-name">Coins: </span>
                                <span class="stat-value">{{ $serverStats['stats']['Duels']['coins'] }}</span>
                            </div>

                            <div class="played-games">
                                <span class="stat-name">Played games: </span>
                                <span class="stat-value">{{ $serverStats['stats']['Duels']['games_played_duels'] }}</span>
                            </div>

                            <div class="won-games">
                                <span class="stat-name">Won games: </span>
                                <span class="stat-value">{{ $serverStats['stats']['Duels']['wins'] }}</span>
                            </div>

                            <div class="lost-games">
                                <span class="stat-name">Lost games: </span>
                                <span class="stat-value">{{ $serverStats['stats']['Duels']['losses'] }}</span>
                            </div>

                            <div class="total-kills">
                                <span class="stat-name">Total kills: </span>
                                <span class="stat-value">{{ $serverStats['stats']['Duels']['kills'] }}</span>
                            </div>
                        </div>

                        <div class="card-header">
                            <button class="btn btn-link toggle-button">Arena</button>
                        </div>
                        <div class="card-body content d-none">

                            <div class="coins">
                                <span class="stat-name">Coins: </span>
                                <span class="stat-value">{{ $serverStats['stats']['Arena']['coins'] }}</span>
                            </div>

                            <div class="win-streaks-1v1">
                                <span class="stat-name">1v1 win streak: </span>
                                <span class="stat-value">{{ $serverStats['stats']['Arena']['win_streaks_1v1'] }}</span>
                            </div>

                            <div class="deaths-1v1">
                                <span class="stat-name">1v1 deaths: </span>
                                <span class="stat-value">{{ $serverStats['stats']['Arena']['deaths_1v1'] }}</span>
                            </div>

                            <div class="damage-1v1">
                                <span class="stat-name">1v1 damage: </span>
                                <span class="stat-value">{{ $serverStats['stats']['Arena']['damage_1v1'] }}</span>
                            </div>

                            <div class="played-1v1">
                                <span class="stat-name">1v1 games played: </span>
                                <span class="stat-value">{{ $serverStats['stats']['Arena']['games_1v1'] }}</span>
                            </div>

                            <div class="lost-1v1">
                                <span class="stat-name">1v1 games lost: </span>
                                <span class="stat-value">{{ $serverStats['stats']['Arena']['losses_1v1'] }}</span>
                            </div>
                        </div>

                        <div class="card-header">
                            <button class="btn btn-link toggle-button">Quake</button>
                        </div>
                        <div class="card-body content d-none">

                            <div class="coins">
                                <span class="stat-name">Coins: </span>
                                <span class="stat-value">{{ $serverStats['stats']['Quake']['coins'] }}</span>
                            </div>

                            <div class="kills">
                                <span class="stat-name">Kills: </span>
                                <span class="stat-value">{{ $serverStats['stats']['Quake']['kills'] }}</span>
                            </div>

                            <div class="highest-killstreak">
                                <span class="stat-name">Highest killstreak: </span>
                                <span class="stat-value">{{ $serverStats['stats']['Quake']['highest_killstreak'] }}</span>
                            </div>

                            <div class="deaths">
                                <span class="stat-name">Deaths: </span>
                                <span class="stat-value">{{ $serverStats['stats']['Quake']['deaths'] }}</span>
                            </div>
                        </div>

                        <div class="card-header">
                            <button class="btn btn-link toggle-button">UHC</button>
                        </div>
                        <div class="card-body content d-none">

                            <div class="coins">
                                <span class="stat-name">Coins: </span>
                                <span class="stat-value">{{ $serverStats['stats']['UHC']['coins'] }}</span>
                            </div>

                            <div class="kills">
                                <span class="stat-name">Kills: </span>
                                <span class="stat-value">{{ $serverStats['stats']['UHC']['kills'] }}</span>
                            </div>

                            <div class="deaths">
                                <span class="stat-name">Deaths: </span>
                                <span class="stat-value">{{ $serverStats['stats']['UHC']['deaths'] }}</span>
                            </div>

                            <div class="score">
                                <span class="stat-name">Score: </span>
                                <span class="stat-value">{{ $serverStats['stats']['UHC']['score'] }}</span>
                            </div>

                            <div class="heads-eaten">
                                <span class="stat-name">Heads eaten: </span>
                                <span class="stat-value">{{ $serverStats['stats']['UHC']['heads_eaten'] }}</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @else
            <div class="alert alert-danger mt-3" role="alert">
                <h4 class="alert-heading">Error!</h4>
                <p>Player has never joined Hypixel!</p>
            </div>
        @endif
    </div>
    <script>
        //Open and eclose containers
        var toggleButtons = document.querySelectorAll('.toggle-button');
        var contents = document.querySelectorAll('.content');

        toggleButtons.forEach(function(button, index) {
            button.addEventListener('click', function() {
                var content = contents[index];
                content.classList.toggle('d-none');
            });
        });
    </script>

@endsection
