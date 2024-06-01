@extends('layouts.general')

@section('title', Auth::user()->username . ' - HypixelViewer')

@section('content')
    <div class="container">
        <h1 class="text-center mt-3">{{ Auth::user()->username }}</h1>

        {{-- Received friends --}}
        <div class="section-buttons row mt-5">
            <button class="btn btn-primary col mx-3" onclick="showContent('accepted-container')">Friends</button>
            <button class="btn btn-primary col mx-3" onclick="showContent('received-container')">Received requests</button>
            <button class="btn btn-primary col mx-3" onclick="showContent('sent-container')">Sent requests</button>
        </div>

        {{-- Accepted requests --}}
        <div id="accepted-container" class="d-block">
            @if ($acceptedRequests->isNotEmpty())
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
                                @foreach ($acceptedRequests as $friend)
                                    <tr>
                                        <td>{{ $friend->username }}</td>
                                        <td>Link to profile</td>
                                        <td>
                                            <form
                                                action="{{ route('deleteFriend', ['sender' => $friend->sender, 'receiver' => $friend->receiver]) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                            {{-- message friend --}}
                                            <form action="{{ route('messageCreate', ['receiver' => $friend->username]) }}"
                                                method="post">
                                                @csrf
                                                @method('POST')
                                                <button type="submit" class="btn btn-primary">Send message</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                No tienes amigos
            @endif
        </div>

        <div id="received-container" class="d-none">
            @if ($pendingFriendReceived->isNotEmpty())
                <div class="card friends mt-3">
                    {{-- Pending requests --}}
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
                                @foreach ($pendingFriendReceived as $friend)
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
                No has recibido solicitudes de amistad
            @endif
        </div>

        <div id="sent-container" class="d-none">
            @if ($pendingFriendSent->isNotEmpty())
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
                                @foreach ($pendingFriendSent as $friend)
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
            @else
                No has enviado solicitudes de amistad
            @endif
        </div>
    </div>
@endsection

<script>
    function showContent(section) {
        console.log(section)
        // Oculta todos los contenidos
        document.getElementById('accepted-container').classList.add('d-none');
        document.getElementById('received-container').classList.add('d-none');
        document.getElementById('sent-container').classList.add('d-none');

        // Muestra solo el contenido de la sección seleccionada
        document.getElementById(section).classList.remove('d-none');
        document.getElementById(section).classList.add('d-block');
    }
</script>
