@extends('admin.authentication.master')

@section('title')
CMS | Reset Password
@endsection

@push('css')
@endpush

@section('content')
    <div class="container">
        {{-- Error message email --}}
        <div class="boxAlert">
            @if ($errors->has('email'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert"> {{ $errors->first('email') }}
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>
            @endif
        </div>
        {{-- Error message password --}}
        <div class="boxAlert mt-7">
            @if ($errors->has('password'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert"> {{ $errors->first('password') }}
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>
            @endif
        </div>

        {{-- Content --}}
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-9 reset-card">
                    <div class="card-header m-auto"><h3>{{ __('Reset Password') }}</h3></div>
                    
                    <div class="card-body">
                        <form action="{{ route('reset.password.post') }}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
    
                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-8">
                                    <input type="email" id="email_address" class="form-control" name="email" placeholder="Enter email addreas" required autofocus>
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-8">
                                    <input type="password" id="inputPassword" class="form-control" name="password" required placeholder="Enter new password" autofocus>
                                    <i class="fa fa-eye" id="togglePassword" style="cursor: pointer; position: absolute; right: 30px; top: 10px; z-index: 1000"></i>
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                                <div class="col-md-8">
                                    <input type="password" id="inputPassword1" class="form-control" name="password_confirmation" placeholder="Confirm your new password" required autofocus>
                                    <i class="fa fa-eye" id="togglePassword1" style="cursor: pointer; position: absolute; right: 30px; top: 10px; z-index: 1000"></i>
                                    {{-- error password --}}
                                    @if ($errors->has('password_confirmation'))
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary reset-btn-1">
                                    <strong>{{ __('Reset Password') }}</strong>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    const togglePassword = document.querySelector('#togglePassword');
    const togglePassword1 = document.querySelector('#togglePassword1');
    const password = document.querySelector('#inputPassword');
    const password1 = document.querySelector('#inputPassword1');

    /* This for password */
    togglePassword.addEventListener('click', function(e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');

    });

    /* This for confirm pass */
    togglePassword1.addEventListener('click', function(e) {
        // toggle the type attribute
        const type = password1.getAttribute('type') === 'password' ? 'text' : 'password';
        password1.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');

    });
    </script>
@endsection
