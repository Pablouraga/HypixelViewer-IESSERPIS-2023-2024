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

                                {{-- Money/purse --}}
                                <div class="player-purse">
                                    Purse:
                                    {{ number_format(round((float) $member['currencies']['coin_purse'], 2), 2, '.', ',') }}
                                </div>
                                {{-- Fairy souls --}}
                                <div class="player-fairysouls">
                                    Fairy souls collected: {{ $member['fairy_soul']['total_collected'] }}
                                </div>

                                {{-- Skill levels --}}
                                @php
                                    //Skill leveling costs
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
                                    //Runecrafting leveling costs
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
                                    //Social leveling costs
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

                                @endphp

                                <div class="player-skills">
                                    @if (isset($member['player_data']['experience']))
                                        @foreach ($member['player_data']['experience'] as $key => $item)
                                            {{-- Find level --}}
                                            @if ($key != 'SKILL_SOCIAL')
                                                @php
                                                    $level = 0;

                                                    if ($key == 'SKILL_RUNECRAFTING') {
                                                        foreach (
                                                            $runecraftingLevelingCumulativeCost
                                                            as $skillLevel => $cost
                                                        ) {
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
                                                <p><img src="{{ asset('icons/' . $key . '.png') }}"
                                                        alt="{{ ucfirst(strtolower(substr($key, 6))) }} Skill"
                                                        class="skill-icon">
                                                    {{ ucfirst(strtolower(substr($key, 6))) }} -
                                                    {{ $level }}</p>
                                            @endif
                                        @endforeach
                                    @else
                                        No skills found
                                    @endif
                                </div>
                                <div class="dungeons">
                                    <div class="catacombs">
                                        @if (isset($member['dungeons']['dungeon_types']['catacombs']['tier_completions']))
                                            <h3>Catacombs dungeon floor stats</h3>
                                            <div class="row mb-3">
                                                @foreach ($member['dungeons']['dungeon_types']['catacombs']['tier_completions'] as $key => $item)
                                                    @if ($key != 'total')
                                                        <div class="col-md-3 mb-3">
                                                            <div class="card floor-name-container">
                                                                <div class="card-header">
                                                                    @if ($key == 0)
                                                                        Entrance
                                                                    @else
                                                                        Floor {{ $key }}
                                                                    @endif
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="completions-tracking">Completions:
                                                                        {{ $item }}</div>
                                                                    <div class="fastest-run"></div>
                                                                    <div class="most-damage-healer"><img
                                                                            src="{{ asset('minecraft/textures/items/potion_bottle_drinkable.png') }}"
                                                                            alt="">
                                                                        {{ isset($member['dungeons']['dungeon_types']['catacombs']['most_damage_healer'][$key]) ? number_format($member['dungeons']['dungeon_types']['catacombs']['most_damage_healer'][$key], 0, '', ',') : 'N / A' }}
                                                                    </div>
                                                                    <div class="most-damage-tank"><img
                                                                            src="{{ asset('minecraft/textures/items/leather_chestplate.png') }}"
                                                                            alt="">
                                                                        {{ isset($member['dungeons']['dungeon_types']['catacombs']['most_damage_tank'][$key]) ? number_format($member['dungeons']['dungeon_types']['catacombs']['most_damage_tank'][$key], 0, '', ',') : 'N / A' }}
                                                                    </div>
                                                                    <div class="most-damage-berserk"><img
                                                                            src="{{ asset('minecraft/textures/items/iron_sword.png') }}"
                                                                            alt="">
                                                                        {{ isset($member['dungeons']['dungeon_types']['catacombs']['most_damage_berserk'][$key]) ? number_format($member['dungeons']['dungeon_types']['catacombs']['most_damage_berserk'][$key], 0, '', ',') : 'N / A' }}
                                                                    </div>
                                                                    <div class="most-damage-mage"><img
                                                                            src="{{ asset('minecraft/textures/items/blaze_rod.png') }}"
                                                                            alt="">
                                                                        {{ isset($member['dungeons']['dungeon_types']['catacombs']['most_damage_mage'][$key]) ? number_format($member['dungeons']['dungeon_types']['catacombs']['most_damage_mage'][$key], 0, '', ',') : 'N / A' }}
                                                                    </div>
                                                                    <div class="most-damage-archer"><img
                                                                            src="{{ asset('minecraft/textures/items/bow_standby.png') }}"
                                                                            alt="">
                                                                        {{ isset($member['dungeons']['dungeon_types']['catacombs']['most_damage_archer'][$key]) ? number_format($member['dungeons']['dungeon_types']['catacombs']['most_damage_archer'][$key], 0, '', ',') : 'N / A' }}
                                                                    </div>
                                                                    <div class="fastest-time-s">Fastest S run
                                                                        {{ isset($member['dungeons']['dungeon_types']['catacombs']['fastest_time_s'][$key]) ? gmdate('H:i:s', $member['dungeons']['dungeon_types']['catacombs']['fastest_time'][$key]) : 'N / A' }}
                                                                    </div>
                                                                    <div class="fastest-time-s">Fastest S+ run
                                                                        {{ isset($member['dungeons']['dungeon_types']['catacombs']['fastest_time_s_plus'][$key]) ? gmdate('H:i:s', $member['dungeons']['dungeon_types']['catacombs']['fastest_time_s_plus'][$key]) : 'N / A' }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @else
                                            No catacombs found
                                        @endif
                                    </div>
                                    <div class="master-catacombs">
                                        @if (isset($member['dungeons']['dungeon_types']['master_catacombs']['tier_completions']))
                                            <h3>Master Catacombs dungeon floor stats</h3>
                                            <div class="row mb-3">
                                                @foreach ($member['dungeons']['dungeon_types']['master_catacombs']['tier_completions'] as $key => $item)
                                                    @if ($key != 'total')
                                                        <div class="col-md-3 mb-3">
                                                            <div class="card floor-name-container">
                                                                <div class="card-header">
                                                                    @if ($key == 0)
                                                                        Entrance
                                                                    @else
                                                                        Master Mode Floor {{ $key }}
                                                                    @endif
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="completions-tracking">Completions:
                                                                        {{ $item }}</div>
                                                                    <div class="fastest-run"></div>
                                                                    <div class="most-damage-healer"><img
                                                                            src="{{ asset('minecraft/textures/items/potion_bottle_drinkable.png') }}"
                                                                            alt="">
                                                                        {{ isset($member['dungeons']['dungeon_types']['master_catacombs']['most_damage_healer'][$key]) ? number_format($member['dungeons']['dungeon_types']['master_catacombs']['most_damage_healer'][$key], 0, '', ',') : 'N / A' }}
                                                                    </div>
                                                                    <div class="most-damage-tank"><img
                                                                            src="{{ asset('minecraft/textures/items/leather_chestplate.png') }}"
                                                                            alt="">
                                                                        {{ isset($member['dungeons']['dungeon_types']['master_catacombs']['most_damage_tank'][$key]) ? number_format($member['dungeons']['dungeon_types']['master_catacombs']['most_damage_tank'][$key], 0, '', ',') : 'N / A' }}
                                                                    </div>
                                                                    <div class="most-damage-berserk"><img
                                                                            src="{{ asset('minecraft/textures/items/iron_sword.png') }}"
                                                                            alt="">
                                                                        {{ isset($member['dungeons']['dungeon_types']['master_catacombs']['most_damage_berserk'][$key]) ? number_format($member['dungeons']['dungeon_types']['master_catacombs']['most_damage_berserk'][$key], 0, '', ',') : 'N / A' }}
                                                                    </div>
                                                                    <div class="most-damage-mage"><img
                                                                            src="{{ asset('minecraft/textures/items/blaze_rod.png') }}"
                                                                            alt="">
                                                                        {{ isset($member['dungeons']['dungeon_types']['master_catacombs']['most_damage_mage'][$key]) ? number_format($member['dungeons']['dungeon_types']['master_catacombs']['most_damage_mage'][$key], 0, '', ',') : 'N / A' }}
                                                                    </div>
                                                                    <div class="most-damage-archer"><img
                                                                            src="{{ asset('minecraft/textures/items/bow_standby.png') }}"
                                                                            alt="">
                                                                        {{ isset($member['dungeons']['dungeon_types']['master_catacombs']['most_damage_archer'][$key]) ? number_format($member['dungeons']['dungeon_types']['master_catacombs']['most_damage_archer'][$key], 0, '', ',') : 'N / A' }}
                                                                    </div>
                                                                    <div class="fastest-time-s">Fastest S run
                                                                        {{ isset($member['dungeons']['dungeon_types']['master_catacombs']['fastest_time_s'][$key]) ? gmdate('H:i:s', $member['dungeons']['dungeon_types']['master_catacombs']['fastest_time_s'][$key] / 1000) : 'N / A' }}
                                                                    </div>
                                                                    <div class="fastest-time-s">Fastest S+ run
                                                                        {{ isset($member['dungeons']['dungeon_types']['master_catacombs']['fastest_time_s_plus'][$key]) ? gmdate('H:i:s', $member['dungeons']['dungeon_types']['master_catacombs']['fastest_time_s_plus'][$key] / 1000) : 'N / A' }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @else
                                            No catacombs found
                                        @endif
                                    </div>
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
