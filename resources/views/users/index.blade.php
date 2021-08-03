@extends('layouts.app')

@section('content')

<div class="container">
    <div class="mb-4 form-inline">
        <form action="{{ route('users.search') }}" method="POST" class="form-inline mr-3">
            @csrf
            <input type="text" name="search" class="form-control mr-3" required />
            <button class="btn btn-success" type="submit">Search</button>
        </form>
        <a href="{{ route('users.create') }}" class="btn btn-success">Add User</a>
    </div>
    <table class="table">
        <thead class="thead-light">
            <tr>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Created User</th>
            <th scope="col">Type</th>
            <th scope="col">Phone</th>
            <th scope="col">Birth Date</th>
            <th scope="col">Address</th>
            <th scope="col">Profile</th>
            <th scope="col"></th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
            <th>{{ $user->name }}</th>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_user->name }}</td>
            <td>{{ $user->type }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->dob }}</td>
            <td>{{ $user->address }}</td>
            <td><img src="{{ asset('storage/uploads/'.$user->profile) }}" height="50px" width="50px"></td>
            <td><a href="{{ route('users.edit',$user->id) }}" class="btn btn-warning">Edit</a></td>
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
