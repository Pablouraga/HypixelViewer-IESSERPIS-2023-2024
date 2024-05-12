@extends('contentlayout')

@section('title', session('username') . ' - HypixelViewer')

@section('content')
    <h1 class="text-center">{{ session('username') }}</h1>
    <div class="container">
        {{-- Profile name --}}
        <div class="profile-name">
            Profile: {{ $stats['cute_name'] }}
        </div>
        {{-- Bank balance formatting --}}
        <div class="bank-balance">
            Bank: {{ number_format(round((float) $stats['banking']['balance'], 2), 2, '.', ',') }}
        </div>
        <div class="members">
            Members:
            @foreach ($stats['members'] as $key => $member)
                @php
                    $url = 'https://playerdb.co/api/player/minecraft/' . $key;
                    $json = file_get_contents($url);
                    $data = json_decode($json, true);
                @endphp
                <div class="card mb-3">
                    <div class="card-header">
                        {{ $data['data']['player']['username'] }} {{-- - {{ $key }} --}}
                    </div>
                    <div class="card-body">
                        @if (isset($member['leveling']))
                            {{-- Player level --}}
                            <div class="skyblock-level">Level: {{ $member['leveling']['experience'] / 100 }}</div>
                        @endif
                        {{-- Purse formatting --}}
                        <div class="player-purse">
                            Purse:
                            {{ number_format(round((float) $member['currencies']['coin_purse'], 2), 2, '.', ',') }}
                        </div>

                        {{-- Total fairy souls --}}
                        <div class="player-fairysouls">
                            Fairy souls collected: {{ $member['fairy_soul']['total_collected'] }}
                        </div>
                        @php
                            $skillLevelingCumulativeCost = [
                                0 => 0,
                                1 => 50,
                                2 => 175,
                                3 => 375,
                                4 => 675,
                                5 => 1175,
                                6 => 1925,
                                7 => 2925,
                                8 => 4425,
                                9 => 6425,
                                10 => 9925,
                                11 => 14925,
                                12 => 22425,
                                13 => 32425,
                                14 => 47425,
                                15 => 67425,
                                16 => 97425,
                                17 => 147425,
                                18 => 222425,
                                19 => 322425,
                                20 => 522425,
                                21 => 822425,
                                22 => 1222425,
                                23 => 1722425,
                                24 => 2322425,
                                25 => 3022425,
                                26 => 3822425,
                                27 => 4722425,
                                28 => 5722425,
                                29 => 6822425,
                                30 => 8022425,
                                31 => 9322425,
                                32 => 10722425,
                                33 => 12222425,
                                34 => 13822425,
                                35 => 15522425,
                                36 => 17322425,
                                37 => 19222425,
                                38 => 21222425,
                                39 => 23322425,
                                40 => 25522425,
                                41 => 27822425,
                                42 => 30222425,
                                43 => 32722425,
                                44 => 35322425,
                                45 => 38072425,
                                46 => 40972425,
                                47 => 44072425,
                                48 => 47472425,
                                49 => 51172425,
                                50 => 55172425,
                                51 => 59472425,
                                52 => 64072425,
                                53 => 68972425,
                                54 => 74172425,
                                55 => 79672425,
                                56 => 85472425,
                                57 => 91572425,
                                58 => 97972425,
                                59 => 104672425,
                                60 => 111672425,
                            ];

                            $runecraftingLevelingCumulativeCost = [
                                0 => 0,
                                1 => 50,
                                2 => 150,
                                3 => 275,
                                4 => 435,
                                5 => 635,
                                6 => 885,
                                7 => 1200,
                                8 => 1600,
                                9 => 2100,
                                10 => 2725,
                                11 => 3510,
                                12 => 4510,
                                13 => 5760,
                                14 => 7325,
                                15 => 9325,
                                16 => 11825,
                                17 => 14950,
                                18 => 18950,
                                19 => 23950,
                                20 => 30200,
                                21 => 38050,
                                22 => 47850,
                                23 => 60100,
                                24 => 75400,
                                25 => 94450,
                            ];

                            $socialLevelingCumulativeCost = [
                                0 => 0,
                                1 => 50,
                                2 => 150,
                                3 => 300,
                                4 => 550,
                                5 => 1050,
                                6 => 1800,
                                7 => 2800,
                                8 => 4050,
                                9 => 5550,
                                10 => 7550,
                                11 => 10050,
                                12 => 13050,
                                13 => 16800,
                                14 => 21300,
                                15 => 27300,
                                16 => 35300,
                                17 => 45300,
                                18 => 57800,
                                19 => 72800,
                                20 => 92800,
                                21 => 117800,
                                22 => 147800,
                                23 => 182800,
                                24 => 222800,
                                25 => 272800,
                            ];

                            // $skillLevelingCumulativeCost = array_flip($skillLevelingCumulativeCost);

                        @endphp
                        {{-- Skills --}}
                        @if (isset($member['player_data']['experience']))
                            <div class="player-skills">
                                @foreach ($member['player_data']['experience'] as $key => $item)
                                    {{-- Find level --}}
                                    @if ($key != 'SKILL_SOCIAL')
                                        @php
                                            $level = 0;

                                            if ($key == 'SKILL_RUNECRAFTING') {
                                                foreach ($runecraftingLevelingCumulativeCost as $skillLevel => $cost) {
                                                    if ($item >= $cost) {
                                                        $level = $skillLevel;
                                                    }
                                                }
                                            } else {
                                                foreach ($skillLevelingCumulativeCost as $skillLevel => $cost) {
                                                    if ($item >= $cost) {
                                                        $level = $skillLevel;
                                                    }
                                                }
                                            }
                                        @endphp
                                        <p> <img src="{{ asset('icons/' . $key . '.png') }}"
                                                alt="{{ ucfirst(strtolower(substr($key, 6))) }} Skill" class="skill-icon">
                                            {{ ucfirst(strtolower(substr($key, 6))) }} -
                                            {{ $level }}</p>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="card-footer">
                        {{-- First join --}}
                        First join:
                        {{ \Carbon\Carbon::createFromTimestamp($member['profile']['first_join'] / 1000)->format('d-m-y h:i:s') }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{-- @dd($stats['members']['96323cab537e4a50ad62d02e0612e707']['player_data']['experience']) --}}
    //Stone pickaxe image

    {{-- @dd($skillLevelingCumulativeCost) --}}
@endsection
