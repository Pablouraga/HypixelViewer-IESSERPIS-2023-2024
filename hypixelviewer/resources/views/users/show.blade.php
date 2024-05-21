@extends('layouts.general')

@section('title', $user->username . ' - HypixelViewer')

@section('content')
    {{-- @dd($data['data']['player']['raw_id']) --}}
    <div class="container">
        <h1 class="text-center">{{ $user->username }}</h1>
        @if ($user->linked_account != null)
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Linked account: <a
                                    href="{{ route('generalView', ['username' => $user->linked_account]) }}">{{ $user->linked_account }}</a>
                            </h5>
                            <img src="https://crafatar.com/renders/body/{{ $data['data']['player']['raw_id'] }}?overlay&scale=10"
                                alt="Avatar">
                            @if ($hypixelData['success'] == true)
                                @if ($hypixelData['player']['socialMedia'])
                                    <ul>
                                        @foreach ($hypixelData['player']['socialMedia']['links'] as $key => $socialMedia)
                                            <li>{{ ucfirst(strtolower($key)) }} - {{ $socialMedia }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Friends</h5>
                        </div>
                    </div>
                </div>
            </div>
        @else
        @endif
    </div>
@endsection
