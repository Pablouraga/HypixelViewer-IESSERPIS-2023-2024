@extends('layouts.general')

@section('title', 'Messages - HypixelViewer')

@section('content')
    <div class="container mt-3">
        <div class="section-buttons row">
            <button class="btn btn-primary col mx-3 received-messages-btn"
                onclick="showContent('received-messages')">Inbox</button>
            <button class="btn btn-outline-primary col mx-3 sent-messages-btn"
                onclick="showContent('sent-messages')">Sent</button>
        </div>

        <div class="card mt-3 d-block" id="received-messages">
            <div class="card-body">
                <h5 class="card-title">Received messages</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col" class="w-25">Sender</th>
                            <th scope="col">Text</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inbox as $message)
                            <tr>
                                <td>{{ $message->senderUsername }}</td>
                                <td>{{ $message->text }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mt-3 d-none" id="sent-messages">
            <div class="card-body">
                <h5 class="card-title">Sent messages</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col" class="w-25">Receiver</th>
                            <th scope="col">Text</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sent as $message)
                            <tr>
                                <td>{{ $message->receiverUsername }}</td>
                                <td>{{ $message->text }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

<script>
    function showContent(section) {
        console.log(section)
        // Oculta todos los contenidos
        document.getElementById('received-messages').classList.add('d-none');
        document.getElementById('sent-messages').classList.add('d-none');

        //get element by class name
        var receivedMessagesBtn = document.getElementsByClassName('received-messages-btn');
        var sentMessagesBtn = document.getElementsByClassName('sent-messages-btn');

        if (section == 'received-messages') {
            // Muestra solo el contenido de la sección seleccionada
            receivedMessagesBtn[0].classList.remove('btn-outline-primary');
            receivedMessagesBtn[0].classList.add('btn-primary');
            sentMessagesBtn[0].classList.remove('btn-primary');
            sentMessagesBtn[0].classList.add('btn-outline-primary');
        } else {
            // Muestra solo el contenido de la sección seleccionada
            sentMessagesBtn[0].classList.remove('btn-outline-primary');
            sentMessagesBtn[0].classList.add('btn-primary');
            receivedMessagesBtn[0].classList.remove('btn-primary');
            receivedMessagesBtn[0].classList.add('btn-outline-primary');
        }

        // Muestra solo el contenido de la sección seleccionada
        document.getElementById(section).classList.remove('d-none');
        document.getElementById(section).classList.add('d-block');
    }
</script>
