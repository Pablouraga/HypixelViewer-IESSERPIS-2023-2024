@extends('layouts.general')
@section('title', 'Manage users - Hypixel Viewer')
@section('content')
    <div class="container mt-3 mb-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Users</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">User</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->username }}</td>
                                <td>
                                    <form action="{{ route('deleteUser', $user) }}" method="post">
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
@endsection
