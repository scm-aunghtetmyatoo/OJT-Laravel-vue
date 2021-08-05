@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit User') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('users.editconfirm',$user->id) }}"
                        enctype="multipart/form-data" id="selectform">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ $name }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ $email }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <input id="password" type="hidden" name="password" value="{{ $password }}" required
                            autocomplete="password">


                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>

                            <div class="col-md-6">
                                <select name="type" class="form-select form-control @error('type') is-invalid @enderror">
                                    @if($type === 'admin')
                                        <option value="admin" 'selected'>admin</option>
                                        <option value="user">user</option>
                                    @elseif($type === 'user')
                                        <option value="user" 'selected'>user</option>
                                        <option value="admin">admin</option>
                                    @endif
                                </select>

                                @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" value="{{ $phone }}" required autocomplete="phone" autofocus>

                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dob"
                                class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                            <div class="col-md-6">
                                <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror"
                                    name="dob" value="{{ $dob }}" required autocomplete="dob" autofocus>

                                @error('dob')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address"
                                class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <textarea name="address" id="address" cols="30" rows="5"
                                    class="form-control @error('dob') is-invalid @enderror">{{ $address }}</textarea>

                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="profile"
                                class="col-md-4 col-form-label text-md-right">{{ __('Profile') }}</label>

                            <div class="col-md-6">
                                <input id="profile" type="file"
                                    class="form-control mb-2 @error('profile') is-invalid @enderror" name="profile"
                                    value="{{ $profile }}" autocomplete="profile" autofocus>

                                @if ("/storage/uploads/{{ $profile }}")
                                <img src="{{ asset('storage/uploads/'.$profile) }}" height="200px" width="180px">
                                @else
                                <p>No image found</p>
                                @endif

                                @error('profile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4 col-form-label text-md-right"></div>
                            <div class="col-md-6">
                                <a href="{{ url('change-password',$user->id) }}">Change Password</a>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary mr-3">
                                    {{ __('Confirm') }}
                                </button>
                                <button class="reset btn btn-primary">
                                    {{ __('Clear') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var resetButtons = document.getElementsByClassName('reset');

    // Loop through each reset buttons to bind the click event
    for (var i = 0; i < resetButtons.length; i++) {
        resetButtons[i].addEventListener('click', resetForm);
    }

    /**
     * Function to hard reset the inputs of a form.
     *
     * @param object event The event object.
     * @return void
     */
    function resetForm(event) {

        event.preventDefault();

        var form = event.currentTarget.form;
        var inputs = form.querySelectorAll('input');
        var textareas = form.querySelectorAll('textarea');

        inputs.forEach(function (input, index) {
            input.value = null;
        });

        textareas.forEach(function (textarea, index) {
            textarea.value = null;
        });

    }

</script>
@endsection
