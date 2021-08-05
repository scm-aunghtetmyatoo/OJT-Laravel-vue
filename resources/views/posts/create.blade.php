
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Post') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('posts.confirm') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $title }}" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                            <textarea name="description" id="description" cols="30" rows="5" class="form-control @error('description') is-invalid @enderror">{{ $description }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
