@extends('layouts.general')

@section('title', session('username') . ' - HypixelViewer')

@section('content')
    <h1 class="text-center mt-3">{{ session('username') }}</h1>
    <div class="container mb-3 mt-3">
        {{-- Profile name --}}
        @if (isset($skyblockStats['cute_name']))
            <div class="profile-name">
                Profile: {{ $skyblockStats['cute_name'] }}
            </div>
            {{-- Bank balance formatting --}}
            @if (isset($skyblockStats['banking']))
                <div class="bank-balance">
                    Bank: {{ number_format(round((float) $skyblockStats['banking']['balance'], 2), 2, '.', ',') }}
                </div>
            @endif
            <div class="members">
                Members:
                @foreach ($skyblockStats['members'] as $key => $member)
                    @php
                        $url = 'https://playerdb.co/api/player/minecraft/' . $key;
                        $json = file_get_contents($url);
                        $data = json_decode($json, true);
                    @endphp
                    <div class="card mb-3">
                        <div class="card-header">
                            {{ $data['data']['player']['username'] }}
                        </div>
                        @if ($data['data']['player']['username'] == session('username'))
                            <div class="card-body">
                                <div class="skyblock-level">
                                    @if (isset($member['leveling']))
                                        {{-- Player level --}}
                                        Level: {{ $member['leveling']['experience'] / 100 }}
                                    @else
                                        No level found
                                    @endif
                                </div>

                                <div class="player-purse">
                                    Purse:
                                    {{ number_format(round((float) $member['currencies']['coin_purse'], 2), 2, '.', ',') }}
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-danger mt-3" role="alert">
                <h4 class="alert-heading">Error!</h4>
                <p>This player has never played skyblock!</p>
            </div>
        @endif
    </div>
@endsection
