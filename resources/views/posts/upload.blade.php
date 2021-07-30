@extends('layouts.app')

@section('content')
<div class="container">
    <h3>hello</h3>
    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" class="form-control">
        <br>
        <button class="btn btn-success">Import User Data</button>    
    </form>
</div>
@endsection
