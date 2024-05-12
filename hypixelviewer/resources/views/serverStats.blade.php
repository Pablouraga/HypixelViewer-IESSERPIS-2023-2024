{{-- @dd($serverStats) --}}
@extends('contentlayout')

@section('content')
    <div class="container">
        <div class="card skywars-data">
            @foreach ($serverStats['stats']['SkyWars'] as $key => $item)
                @if (!is_array($item))
                    <div class="card-body">
                        <h5 class="card-title">{{ $key }} - {{ $item }}</h5>

                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection
