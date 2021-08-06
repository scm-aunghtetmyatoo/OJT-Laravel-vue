@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
                @endif
                <div class="card-header">
                    <div class="h4">Contact Us</div>
                </div>

                <div class="card-body">
                    <form action="{{ route('send.email') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Email">
                            @error('email')
                            <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <strong>Suggestion:</strong>
                            <textarea name="suggestion" rows="5" class="form-control"
                                placeholder="Enter Your Message"></textarea>
                            @error('suggestion')
                            <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Attachments:</label>
                            <input type="file" name="files" class="form-control">
                            @error('files')
                            <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>

                        <div class="form-check">
                            <input type="checkbox" name="files" class="form-check-input" id="checkbox"
                                onchange="document.getElementById('submit').disabled = !this.checked;">
                            <label class="form-check-label" for="checkbox">
                                Agreement to send
                            </label>
                            @error('files')
                            <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary save-data" id="submit" disabled>Send
                                Email</button>
                            <button type="reset" class="btn btn-primary save-data">Cancel</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
