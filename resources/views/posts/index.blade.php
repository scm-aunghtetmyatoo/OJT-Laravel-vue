@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('posts.create') }}" class="btn btn-success mb-4">Add</a>
    <table class="table">
        <thead class="thead-light">
            <tr>
            <th scope="col">Post Title</th>
            <th scope="col">Post Description</th>
            <th scope="col">Post Date</th>
            <th scope="col"></th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
            <th>{{ $post->title }}</th>
            <td>{{ $post->description }}</td>
            <td>{{ $post->created_at->format('d/m/Y') }}</td>
            <td><a href="{{ route('posts.edit',$post->id) }}" class="btn btn-warning">Edit</a></td>
            <td>
                <form action="{{ route('posts.destroy',$post->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $posts->links() }}
</div>
@endsection
