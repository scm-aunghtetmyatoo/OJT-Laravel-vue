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
                        <div class="col-12">
                            <p class="h4">Create Post Confirmation</p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row justify-content-start mb-4">
                        <div class="col-6">Title</div>
                        <div class="col-6">{{ $title }}</div>
                    </div>
                    <div class="row justify-content-start mb-4">
                        <div class="col-6">Description</div>
                        <div class="col-6">{{ $description }}</div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-inline">
                        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="title" class="form-control" value="{{ $title }}">
                            <input type="hidden" name="description" class="form-control" value="{{ $description }}">
                            <button type="submit" class="btn btn-primary mr-3">Create</button>

                        </form>
                        <form action="{{ route('posts.create') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="title" class="form-control" value="{{ $title }}">
                            <input type="hidden" name="description" class="form-control" value="{{ $description }}">
                            <button type="submit" class="btn btn-primary mr-3">Cancel</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
