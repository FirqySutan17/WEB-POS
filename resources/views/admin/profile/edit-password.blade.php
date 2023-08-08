@extends('layouts.admin.master')

@section('title')
CMS | Edit Password
@endsection

@section('content')

@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Edit Password</h3>
@endslot
{{ Breadcrumbs::render('edit_password') }}
@endcomponent

<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <form action="{{ route('password.updatePassword') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card _card" style="margin: auto; padding-bottom: 20px">
          <div class="card-body _card-body">
            <div class="row d-flex align-items-stretch">

              <div class="col-12">

                @if (session('error'))
                <div class="alert alert-danger">
                  {{ session('error') }}
                </div>
                @endif
                @if (session('success'))
                <div class="alert alert-success">
                  {{ session('success') }}
                </div>
                @endif
                @if($errors)
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
                @endif

                <!-- current password -->
                <div class="form-group _form-group">
                  <label for="input_post_title" class="font-weight-bold">
                    Current Password
                  </label>
                  <input id="input_post_title" autocomplete="current_password" autofocus name="current_password"
                    type="password" class="form-control @error('current_password') is-invalid @enderror"
                    placeholder="Current password" />
                  @error('current_password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <!-- end current password -->

                <!-- password -->
                <div class="form-group _form-group">
                  <label for="input_post_title" class="font-weight-bold">
                    New Password
                  </label>
                  <input id="input_post_title" autocomplete="new-password" autofocus name="password" type="password"
                    class="form-control @error('current_password') is-invalid @enderror" placeholder="New Password" />
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <!-- end password -->

                <!-- password -->
                <div class="form-group _form-group">
                  <label for="input_post_title" class="font-weight-bold">
                    Confirm Password
                  </label>
                  <input id="input_post_title" autocomplete="new-password" autofocus name="password_confirmation"
                    type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                    placeholder="Confirm Password" />
                  @error('password_confirmation')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <!-- end password -->

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