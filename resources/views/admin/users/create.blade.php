@extends('layouts.admin.master')

@section('title')
CMS | Add User
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.css') }}">
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Add User</h3>
@endslot
{{ Breadcrumbs::render('add_user') }}
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card _card" style="width: 60%; margin: auto">
                    <div class="card-body _card-body">
                        <div class="row d-flex align-items-stretch">

                            <div class="col-12">
                                <!-- image -->
                                <div class="form-group _form-group">
                                    {{-- <label for="upload_img" class="font-weight-bold">
                                        Profile Image
                                    </label> --}}
                                    <div class="pro-up">
                                        <div class="circle">
                                          <img class="profile-pic" src="https://t3.ftcdn.net/jpg/03/46/83/96/360_F_346839683_6nAPzbhpSkIpb8pmAwufkC7c5eD7wYws.jpg">
                                        </div>
                                        <div class="p-image">
                                            <i class="fa fa-camera upload-button"></i>
                                             <input type="file" value="{{ old('image') }}" name="image" require class="file-upload form-control @error('image') is-invalid @enderror" id="upload_img" type="file" accept="image/*"/>
                                          </div>
                                     </div>
                                    {{-- <input type="file" value="{{ old('image') }}" name="image" require class="form-control @error('image') is-invalid @enderror" id="upload_img"> --}}
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!-- end image -->
                                
                                <div class="row">
                                    <div class="col-6">
                                        <!-- Employee ID -->
                                        <div class="form-group _form-group">
                                            <label for="input_user_name" class="font-weight-bold">
                                                Employee ID <span class="wajib">*</span>
                                            </label>
                                            <input id="input_user_name" value="{{ old('employee_id') }}" name="employee_id" type="text" class="form-control @error('employee_id') is-invalid @enderror" placeholder="Input Employee ID.." />
                                            @error('employee_id')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                            <!-- error message -->
                                        </div>
                                        <!-- end Employee ID -->

                                        <!-- email -->
                                        <div class="form-group _form-group">
                                            <label for="input_user_email" class="font-weight-bold">
                                                Email <span class="wajib">*</span>
                                            </label>
                                            <input id="input_user_email" value="{{ old('email') }}" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Write email here.." autocomplete="email" />
                                            @error('email')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                            <!-- error message -->
                                        </div>
                                        <!-- end email -->

                                        <!-- role -->
                                       
                                        <!-- end role -->
                                    </div>
                                    <div class="col-6">
                                        <!-- name -->
                                        <div class="form-group _form-group">
                                            <label for="input_user_name" class="font-weight-bold">
                                                Name <span class="wajib">*</span>
                                            </label>
                                            <input id="input_user_name" value="{{ old('name') }}" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Write name here.." />
                                            @error('name')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                            <!-- error message -->
                                        </div>
                                        <!-- end name -->

                                        <!-- Phone Number -->
                                        <div class="form-group _form-group">
                                            <label for="input_user_name" class="font-weight-bold">
                                                Phone Number <span class="wajib">*</span>
                                            </label>
                                            <input id="input_user_name" value="{{ old('phone_number') }}" name="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" placeholder="Input Phone Number" />
                                            @error('phone_number')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                            <!-- error message -->
                                        </div>
                                        <!-- end name -->
                                        
                                        <!-- role -->
                                        <div class="form-group _form-group">
                                            <label for="select_user_role" class="font-weight-bold">
                                                Role <span class="wajib">*</span>
                                            </label>
                                            <select id="select_user_role" name="role" data-placeholder="Choose Role" class="js-example-placeholder-multiple">
                                                <option value="0">Choose Role</option>
                                                @foreach($roles as $role)
                                                <option value="{{$role->id}}">
                                                    {{$role->name}}
                                                </option>

                                                @endforeach
                                                <!-- @if (old('role'))
                                                <option value="{{ old('role')->id }}" selected>
                                                    {{ old('role')->name }}
                                                </option>
                                                @endif -->
                                            </select>
                                            @error('role')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                            <!-- error message -->
                                        </div>
                                        <!-- end role -->
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <!-- password -->
                                        <div class="form-group _form-group">
                                            <label for="input_user_password" class="font-weight-bold">
                                                Password <span class="wajib">*</span>
                                            </label>
                                            <input id="input_user_password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Write password.." autocomplete="new-password" />
                                            @error('password')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                            <!-- error message -->
                                        </div>
                                        <!-- end password -->
                                    </div>
                                    <div class="col-6">
                                        <!-- password_confirmation -->
                                        <div class="form-group _form-group">
                                            <label for="input_user_password_confirmation" class="font-weight-bold">
                                                Confirm Password <span class="wajib">*</span>
                                            </label>
                                            <input id="input_user_password_confirmation" name="password_confirmation" type="password" class="form-control" placeholder="Write confirm password.." autocomplete="new-password" />
                                            <!-- error message -->
                                        </div>
                                        <!-- end password confirmation -->
                                    </div>
                                </div>
                                <!-- status -->
                                <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }} _form-group" style="display: flex;">
                                    <label for="input_banner_status" class="font-weight-bold" style="padding: 7px 0px; margin-right: 20px;">
                                    Status
                                    </label>
                                    <div class="col-2">
                                    <div class="media">
                                        <div class="media-body text-end icon-state">
                                        <label class="switch">
                                            <input type="checkbox" name="status" {{ old("status") == 1  ? "checked"  : null }}><span class="switch-state"></span>
                                        </label>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <!-- end status -->

                            </div>
                        </div>
                        <div class="row">

                            <div class="col-12">
                                <div class="float-right">
                                    <a class="btn btn-outline-primary _btn-primary px-4" href="{{ route('users.index') }}">Back</a>
                                    <button type="submit" class="btn btn-primary _btn-primary px-4">
                                        Save
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection

@push('css-external')
<link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/select2/css/select2-bootstrap4.min.css') }}">
@endpush

@push('javascript-external')
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('vendor/select2/js/' . app()->getLocale() . '.js') }}"></script>
<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>
@endpush

@push('javascript-internal')
<script>
    $(function() {
        //parent category
        $('#select_user_role').select2({
            theme: 'bootstrap4',
            language: "{{ app()->getLocale() }}",
            allowClear: true,
            ajax: {
                url: "{{ route('roles.select') }}",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });

        $('#select_user_office').select2({
            theme: 'bootstrap4',
            language: "{{ app()->getLocale() }}",
            allowClear: true,
            // ajax: {
            //     url: "{{ route('roles.select') }}",
            //     dataType: 'json',
            //     delay: 250,
            //     processResults: function(data) {
            //         return {
            //             results: $.map(data, function(item) {
            //                 return {
            //                     text: item.name,
            //                     id: item.id
            //                 }
            //             })
            //         };
            //     }
            // }
        });
    });
</script>

<script>
    $(document).ready(function() {
        var readURL = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.profile-pic').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }


        $(".file-upload").on('change', function(){
            readURL(this);
        });

        $(".upload-button").on('click', function() {
        $(".file-upload").click();
        });
    });
</script>
@endpush