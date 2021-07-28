@extends('layouts.app')

@section('content')

<div class="container">
<a href="{{ route('users.create') }}" class="btn btn-success mb-4">Add User</a>
    <table class="table">
        <thead class="thead-light">
            <tr>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
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
