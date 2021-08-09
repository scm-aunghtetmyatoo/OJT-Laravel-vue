@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul></ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-start">
                        <div class="col-6">
                            <p class="h4">User Confirm</p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row justify-content-start mb-4">
                        <div class="col-6">Name</div>
                        <div class="col-6">{{ $name }}</div>
                    </div>
                    <div class="row justify-content-start mb-4">
                        <div class="col-6">Email Address</div>
                        <div class="col-6">{{ $email }}</div>
                    </div>
                    <div class="row justify-content-start mb-4">
                        <div class="col-6">Type</div>
                        <div class="col-6">{{ $type }}</div>
                    </div>
                    <div class="row justify-content-start mb-4">
                        <div class="col-6">Phone</div>
                        <div class="col-6">{{ $phone }}</div>
                    </div>
                    <div class="row justify-content-start mb-4">
                        <div class="col-6">Date Of Birth</div>
                        <div class="col-6">{{ $dob }}</div>
                    </div>
                    <div class="row justify-content-start mb-4">
                        <div class="col-6">Address</div>
                        <div class="col-6">{{ $address }}</div>
                    </div>
                    <div class="row justify-content-start mb-4">
                        <div class="col-6">Profile</div>
                        <div class="col-6"><img src="{{ asset('storage/uploads/'.$profile) }}" height="200px"
                                width="180px"></div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-inline">
                        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        
                            <input type="hidden" name="name" class="form-control" value="{{ $name }}">
                            <input type="hidden" name="email" class="form-control" value="{{ $email }}">
                            <input type="hidden" name="password" class="form-control" placeholder="Title"
                                value="{{ $password }}">
                            <input type="hidden" name="type" class="form-control" value="{{ $type }}">
                            <input type="hidden" name="phone" class="form-control" value="{{ $phone }}">
                            <input type="hidden" name="dob" class="form-control" value="{{ $dob }}">
                            <input type="hidden" name="address" class="form-control" value="{{ $address }}">
                            <input type="hidden" name="profile" class="form-control" value="{{ $profile }}">
                            <button type="submit" class="btn btn-primary mr-3">Update</button>
                        </form>
                        <form action="{{ route('users.edit', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        
                            <input type="hidden" name="name" class="form-control" value="{{ $name }}">
                            <input type="hidden" name="email" class="form-control" value="{{ $email }}">
                            <input type="hidden" name="password" class="form-control" placeholder="Title"
                                value="{{ $password }}">
                            <input type="hidden" name="type" class="form-control" value="{{ $type }}">
                            <input type="hidden" name="phone" class="form-control" value="{{ $phone }}">
                            <input type="hidden" name="dob" class="form-control" value="{{ $dob }}">
                            <input type="hidden" name="address" class="form-control" value="{{ $address }}">
                            <input type="hidden" name="profile" class="form-control" value="{{ $profile }}">
                            <button type="submit" class="btn btn-primary mr-3">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
