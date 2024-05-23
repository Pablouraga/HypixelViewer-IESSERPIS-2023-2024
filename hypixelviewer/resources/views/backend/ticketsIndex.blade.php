@extends('layouts.general')

@section('title', 'Tickets - HypixelViewer')

@section('content')

    <div class="container">
        <h1 class="text-center">Tickets</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tickets</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">Sender</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $ticket)
                                    <tr
                                        class="
                                    @if ($ticket->status == 'NotRead') table-warning
                                    @elseif ($ticket->status == 'Read')
                                        table-success @endif
                                    ">
                                        <th scope="row">{{ $ticket->subject }}</td>
                                        <td>{{ $ticket->sender_email }}</td>
                                        <td>{{ $ticket->status }}</td>
                                        <td>{{ $ticket->created_at }}</td>
                                        <td>
                                            <a href="{{ route('tickets.show', $ticket->id) }}"
                                                class="btn btn-primary">Open</a>
                                            <form action="{{ route('tickets.destroy', $ticket->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
