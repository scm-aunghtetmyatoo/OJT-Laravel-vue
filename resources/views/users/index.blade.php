@extends('layouts.app')

@section('content')

<div class="container">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="mb-4 form-inline">
        <form action="{{ route('users.search') }}" method="POST" class="form-inline mr-3">
            @csrf
            <input type="text" name="search" class="form-control mr-3" placeholder="Name" required />
            <button class="btn btn-primary" type="submit">Search</button>
        </form>
        <form action="{{ route('users.create') }}" method="POST">
            @csrf
            <button class="btn btn-primary" type="submit">Add User</button>
        </form>
    </div>
    <table class="table">
        <thead class="thead-light">
            <tr>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Created User</th>
            <th scope="col">Phone</th>
            <th scope="col">Birth Date</th>
            <th scope="col">Address</th>
            <th scope="col">Created Date</th>
            <th scope="col">Updated Date</th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
            <th><a href="{{ route('users.edit', $user->id) }}">{{ $user->name }}</a></th>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_user->name }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->dob }}</td>
            <td>{{ $user->address }}</td>
            <td>{{ $user->created_at->format('d/m/Y') }}</td>
            <td>{{ $user->updated_at->format('d/m/Y') }}</td>
            <td>
                <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}
</div>
@endsection
