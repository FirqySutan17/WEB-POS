@extends('layouts.admin.master')

@section('title')
CMS | Edit Profile
@endsection

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Edit Profile</h3>
@endslot
{{ Breadcrumbs::render('edit_profile') }}
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="card _card" style="margin: auto; padding-bottom: 20px">
                    <div class="card-body _card-body">
                        <div class="row d-flex align-items-stretch">
                            <div class="col-12">
                                <!-- image -->
                                {{-- <div class="form-group _form-group">
                                    <label for="upload_img" class="font-weight-bold">
                                        Featured Image <span class="wajib">* </span>
                                    </label>
                                    <input name="image" type="file" value="{{ old('image', $user->image) }}"
                                        class="form-control" />
                                    <?php if (!empty($user->image)): ?>
                                    <br>
                                    <a href="{{ asset('file_upload/'.$user->image) }}" target="_blank"
                                        class="btn btn-primary">Lihat File</a>
                                    <?php endif ?>
                                </div> --}}

                                <div class="form-group _form-group">
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input name="image" type="file" value="{{ old('image', $user->image) }}"
                                                class="form-control" type='file' id="imageUpload"
                                                accept=".png, .jpg, .jpeg" />
                                            <label for="imageUpload"></label>
                                        </div>
                                        <div class="avatar-preview">
                                            <div id="imagePreview"
                                                style="background-image: url('{{ asset('file_upload/'.$user->image) }}');">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end image -->
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group _form-group">
                                            <label for="input_user_name" class="font-weight-bold">
                                                Employee ID <span class="wajib">*</span>
                                            </label>
                                            <input id="input_user_name"
                                                value="{{ old('employee_id', $user->employee_id) }}" name="employee_id"
                                                type="text"
                                                class="form-control @error('employee_id') is-invalid @enderror"
                                                placeholder="Input Employee ID.." readonly />
                                            @error('employee_id')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                            <!-- error message -->
                                        </div>

                                    </div>
                                    <div class="col-6">
                                        <!-- title -->
                                        <div class="form-group _form-group">
                                            <label for="input_post_title" class="font-weight-bold">
                                                Name
                                            </label>
                                            <input id="input_post_title" value="{{ old('name', $user->name) }}"
                                                autocomplete="name" autofocus name="name" type="text"
                                                class="form-control" placeholder="{{ old('name', $user->name) }}" />
                                        </div>
                                        <!-- end title -->

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <!-- email -->
                                        <div class="form-group _form-group">
                                            <label for="input_post_title" class="font-weight-bold">
                                                Email
                                            </label>
                                            <input id="input_post_title" value="{{ old('email', $user->email) }}"
                                                autocomplete="email" autofocus name="email" type="email"
                                                class="form-control" placeholder="{{ old('email', $user->email) }}" />
                                        </div>
                                        <!-- end email -->
                                    </div>
                                    <div class="col-6">
                                        <!-- Phone Number -->
                                        <div class="form-group _form-group">
                                            <label for="input_user_name" class="font-weight-bold">
                                                Phone Number <span class="wajib">*</span>
                                            </label>
                                            <input id="input_user_name"
                                                value="{{ old('phone_number', $user->phone_number) }}"
                                                name="phone_number" type="text"
                                                class="form-control @error('phone_number') is-invalid @enderror"
                                                placeholder="Input Phone Number" />
                                            @error('phone_number')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                            <!-- error message -->
                                        </div>
                                        <!-- end name -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="float-right mTop">
                                    <a class="btn btn-outline-primary _btn-primary px-4" href="/">Back</a>
                                    <button type="submit" class="btn btn-primary _btn-primary px-4">
                                        Update
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
<style>
    .avatar-upload {
        position: relative;
        max-width: 205px;
        margin: 50px auto;
    }

    .avatar-upload .avatar-edit {
        position: absolute;
        right: 20px;
        z-index: 1;
        top: 10px;
    }

    .avatar-upload .avatar-edit input {
        display: none;
    }

    .avatar-upload .avatar-edit input+label {
        display: inline-block;
        width: 34px;
        height: 34px;
        margin-bottom: 0;
        border-radius: 100%;
        background: #FFFFFF;
        border: 1px solid transparent;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
        cursor: pointer;
        font-weight: normal;
        transition: all 0.2s ease-in-out;
    }

    .avatar-upload .avatar-edit input+label:hover {
        background: #f1f1f1;
        border-color: #d6d6d6;
    }

    .avatar-upload .avatar-edit input+label:after {
        content: "\f040";
        font-family: 'FontAwesome';
        color: #757575;
        position: absolute;
        top: 8px;
        left: 0;
        right: 0;
        text-align: center;
        margin: auto;
    }

    .avatar-upload .avatar-preview {
        width: 150px;
        height: 150px;
        margin: auto;
        position: relative;
        border-radius: 100%;
        border: 6px solid #F8F8F8;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
    }

    .avatar-upload .avatar-preview>div {
        width: 100%;
        height: 100%;
        border-radius: 100%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }
</style>
@endpush
@push('javascript-internal')
<script>
    function readURL(input) {
    	if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#imagePreview').css('background-image', 'url('+e.target.result +')');
				$('#imagePreview').hide();
				$('#imagePreview').fadeIn(650);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#imageUpload").change(function() {
		readURL(this);
	});
</script>

<script>
    $(document).ready(function() {
            $('#button_post_thumbnail').filemanager('image');
        });
</script>
@endpush