@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Change Password</div>
                @if(session()->has('error'))
                    <span class="alert alert-danger">
                        <strong>{{ session()->get('error') }}</strong>
                    </span>
                @endif
                @if(session()->has('success'))
                    <span class="alert alert-success">
                        <strong>{{ session()->get('success') }}</strong>
                    </span>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('change.password',$user->id) }}">
                        @csrf
                        <div class="form-group row">
                            <label for="current_password" class="col-md-4 col-form-label text-md-right">Current Password</label>
                            <div class="col-md-6 input-group">
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" id="current_password" autocomplete="current_password">

                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span toggle="#current_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    </div>
                                </div>

                                @error('current_password')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>
                            <div class="col-md-6 input-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" autocomplete="password">

                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    </div>
                                </div>

                                @error('password')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">Password Confirmation</label>
                            <div class="col-md-6 input-group">
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" autocomplete="password_confirmation">

                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span toggle="#password_confirmation" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    </div>
                                </div>
                                
                                @error('password_confirmation')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary mr-3">Change</button>
                                <button type="reset" class="btn btn-primary">Clear</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".toggle-password").click(function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
    input.attr("type", "text");
    } else {
    input.attr("type", "password");
    }
    });
</script>
@endsection