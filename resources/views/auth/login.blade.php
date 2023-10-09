@extends('admin.authentication.master')

@section('title')
CMS | Login
@endsection

@push('css')
<style>
    .danger-suspend {
        border-radius: 5px !important;
        padding: 10px 15px !important;
        font-weight: 600;
    }
</style>

@endpush

@section('content')
<div class="container-fluid">
    {{-- Error message --}}
    @if ($errors->any())
    <div class="boxAlert">
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">{{ $error }}
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title=""
                title=""></button>
        </div>
        @endforeach
    </div>
    @endif
    {{-- Content --}}
    <div class="row">
        <div class="col-xl-5"><img class="bg-img-cover bg-center" src="{{ asset('assets/images/login/3.jpg') }}"
                alt="loginpage" /></div>
        <div class="col-xl-7 p-0">

            <div class="login-card"
                style="display: flex; align-items: center: justify-content: center; flex-direction: column">
                {{-- <h1 style="text-align: center">POS <br> MEAT MASTER</h1> --}}
                <img class="img-fluid" width="100%" src="{{ asset('assets/images/meatmaster_logo.jpeg')}}" alt="">
                <br>
                <form class="theme-form login-form" method="POST" action="{{ route('login') }}">
                    @csrf

                    <h4>Login</h4>
                    <h6>Welcome back! Log in to your account.</h6>
                    @if (session('error'))
                    <div class="alert alert-danger danger-suspend">
                        {{ session('error') }}
                    </div>
                    @endif
                    <div class="form-group _form-group">
                        <label>Username</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="icon-user"></i></span>
                            <input name="employee_id" class="form-control @error('employee_id') is-invalid @enderror"
                                id="input_login_employee_id" type="text" placeholder="Enter Employee ID"
                                value="{{ old('employee_id') }}">
                        </div>
                    </div>

                    <div class="form-group _form-group">
                        <label>Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="icon-lock"></i></span>
                            <input name="password" class="form-control @error('password') is-invalid @enderror"
                                id="input_login_password" type="password" placeholder="Enter password"
                                autocomplete="current-password"
                                style="border-top-right-radius: 4px; border-bottom-right-radius: 4px;" />
                            <i class="fa fa-eye" id="togglePassword"
                                style="cursor: pointer; position: absolute; right: 30px; top: 10px; z-index: 1000"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="checkbox" style="visibility: hidden;">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{
                                old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                        @if (Route::has('password.request'))
                        <a class="link" href="{{ route('forget.password.get') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                        @endif
                    </div>
                    <div class="">
                        <button class="btn btn-primary btn-block" type="submit">Sign in</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<script>
    (function() {
        "use strict";
        window.addEventListener(
            "load",
            function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName("needs-validation");
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener(
                        "submit",
                        function(event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add("was-validated");
                        },
                        false
                    );
                });
            },
            false
        );
    })();
</script>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#input_login_password');

    togglePassword.addEventListener('click', function(e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
    });

    // function myFunction() {
    //     var x = document.getElementById("input_login_password");
    //     if (x.type === "password") {
    //         x.type = "text";
    //     } else {
    //         x.type = "password";
    //     }
    // }
</script>


@push('scripts')
@endpush

@endsection