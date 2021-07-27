@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <a href="{{ route('posts.create') }}" class="btn btn-success">Add</a>
            @foreach($posts as $post)
                <div class="card">
                    <div class="card-header">{{ $post->title }}</div>

                    <div class="card-body">
                        {{ $post->description }}
                    </div>
                </div>
                <a href="{{ route('posts.edit',$post->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('posts.destroy',$post->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            @endforeach
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection
