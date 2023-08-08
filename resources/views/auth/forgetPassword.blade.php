@extends('admin.authentication.master')

@section('title')
CMS | Reset Password
@endsection

@push('css')
@endpush

@section('content')
    <div class="container">
        {{-- Success Message --}}
        <div class="boxAlert">
            @if (Session::has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">{{ Session::get('message') }}
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>
            @endif
        </div>
        {{-- Error message if email invalid --}}
        <div class="boxAlert">
            @if ($errors->has('email'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert"> {{ $errors->first('email') }}
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>
            @endif
        </div>
        {{-- Content --}}
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-10 reset-card">
                    <div class="card-header m-auto"><h3>{{ __('Reset Password') }}</h3></div>
                    <div class="card-body">
                        <form action="{{ route('forget.password.post') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-8">
                                    <input type="email" id="email_address" class="form-control" Placeholder="Enter email addreas" name="email" required autofocus>
                                </div>
                            </div>
                            <div class="col-md-8 offset-md-4">
                                <a class="link reset-a" href="/">Back to login</a>
                                <button type="submit" class="btn btn-primary reset-btn">
                                    <strong>{{ __('Submit') }}</strong>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
