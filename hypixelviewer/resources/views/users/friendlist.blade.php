@extends('layouts.general')

@section('title', Auth::user()->username . ' - HypixelViewer')

@section('content')
    <div class="container">
        <h1 class="text-center">{{ Auth::user()->username }}</h1>

        {{-- Received friends --}}
        <div class="section-buttons row">
            {{-- Dos botones, uno para mostrar auctions y otro para mostrar bids, que ocupen los dos todo el espacio de la clase padre y que sean del mismo tamaño --}}
            <button class="btn btn-primary col mx-3" onclick="">Friends</button>
            <button class="btn btn-primary col mx-3" onclick="">Received requests</button>
            <button class="btn btn-primary col mx-3" onclick="">Sent requests</button>
        </div>

        {{-- Current friends --}}
        @foreach ($friends as $friend)
            @if ($friend->status == 'Accepted')
                <div class="card friends mt-3">
                    <div class="card-body">
                        <h5 class="card-title">Friends</h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Player</th>
                                    <th scope="col">Show profile</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($friends as $friend)
                                    <tr>
                                        <td>{{ $friend->username }}</td>
                                        <td>Link to profile</td>
                                        <td>
                                            <form action="#" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                            {{-- message friend --}}
                                            <form action="#" method="post">
                                                @csrf
                                                @method('POST')
                                                <button type="submit" class="btn btn-primary">Message</button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                @if ($friend->receiver == Auth::user()->id)
                    <div class="card friends mt-3">
                        <div class="card-body">
                            <h5 class="card-title">Received requests</h5>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Player</th>
                                        <th scope="col">Show profile</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($friends as $friend)
                                        <tr>
                                            <td>{{ $friend->username }}</td>
                                            <td>Link to profile</td>
                                            <td>
                                                <form
                                                    action="{{ route('acceptFriendRequest', ['sender' => $friend->sender, 'receiver' => $friend->receiver]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit" class="btn btn-primary">Accept</button>
                                                </form>
                                                <form
                                                    action="{{ route('rejectFriendRequest', ['sender' => $friend->sender, 'receiver' => $friend->receiver]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Decline</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <div class="card friends mt-3">
                        <div class="card-body">
                            <h5 class="card-title">Sent requests</h5>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Player</th>
                                        <th scope="col">Show profile</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($friends as $friend)
                                        <tr>
                                            <td>{{ $friend->username }}</td>
                                            <td>Link to profile</td>
                                            <td>
                                                <form
                                                    action="{{ route('rejectFriendRequest', ['sender' => $friend->sender, 'receiver' => $friend->receiver]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Cancel friend
                                                        request</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            @endif
        @endforeach

        {{-- Received requests --}}

        {{-- <form action="{{ route('addUser') }}" method="post">
            @csrf
            @method('POST')
            <input type="hidden" name="friend" value="0">
            <button type="submit" class="btn btn-warning">Add as friend</button>
        </form> --}}

        {{-- Sent requests --}}

        {{-- @foreach ($friends as $friend)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Sender - {{ $friend->sender }}</h5>
                    <p class="card-text">Receiver - {{ $friend->receiver }}</p>
                    @if ($friend->status == 'pending')
                        <a href="{{ route('friend.accept', ['id' => $friend->id]) }}" class="btn btn-primary">Accept</a>
                        <a href="{{ route('friend.decline', ['id' => $friend->id]) }}" class="btn btn-danger">Decline</a>
                    @endif
                    <p class="card-text">{{ $friend->status }}</p>
                </div>
            </div>
        @endforeach --}}
    </div>
@endsection
