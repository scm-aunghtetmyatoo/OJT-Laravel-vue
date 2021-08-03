@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>User Confirm</h2>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul></ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="panel panel-default">
  <div class="panel-heading">Name : {{ $user->name }}</div>
  <div class="panel-body">
    Email : {{ $user->email }}<br>
  
  </div>
</div>


        </div>
    </div>
</div>

@endsection