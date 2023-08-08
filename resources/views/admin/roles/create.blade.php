@extends('layouts.admin.master')

@section('title')
CMS | Create Role
@endsection

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Create Role</h3>
@endslot
{{ Breadcrumbs::render('add_role') }}
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                <div class="card _card">
                    <div class="card-body _card-body">
                        <div class="row d-flex align-items-stretch">
                            <div class="col-12">

                                <!-- role name -->
                                <div class="form-group _form-group">
                                    <label for="input_role_name" class="font-weight-bold">
                                        Role <span class="required-field">*</span>
                                    </label>
                                    <input id="input_role_name" value="{{ old('name') }}" name="name" type="text" class="form-control @error('name') is-invalid @enderror" style="width: 23.5%;" placeholder="Write name here.." />
                                    @error('name')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <!-- end role name -->

                                <div class="form-group _form-group">
                                    <label for="input_role_name" class="font-weight-bold">
                                        Description
                                    </label>
                                    <textarea id="input_role_description" name="description" type="text" class="form-control @error('description') is-invalid @enderror" placeholder="Write description here.." rows="6">{{ old('description') }}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <!-- permission -->
                                <div class="form-group _form-group">
                                    <label for="input_role_permission" class="font-weight-bold">
                                        Permission
                                    </label>
                                    <div class="row" style="padding-top: 5px">
                                        <!-- list manage name:start -->
                                        @foreach ($authorities as $manageName => $permissions)
                                        <div class="col-3" style="margin-bottom: 20px;">
                                            <ul class="list-group mx-1">
                                                <li class="list-group-item list-group-item-head">
                                                    {{ $manageName }}
                                                </li>
                                                <!-- list permission:start -->
                                                @foreach ($permissions as $permission)
                                                <li class="list-group-item  list-group-item-body">
                                                    <div class="form-check">
                                                        @if (old('permissions'))
                                                        <input id="{{ $permission }}" name="permissions[]" class="form-check-input" type="checkbox" value="{{ $permission }}" {{ in_array($permission,
                                                            old('permissions')) ? "Checked" : null }}>
                                                        @else
                                                        <input id="{{ $permission }}" name="permissions[]" class="form-check-input" type="checkbox" value="{{ $permission }}">
                                                        @endif
                                                        <span for="{{ $permission }}" class="form-check-label">
                                                            {{ $permission }}
                                                        </span>
                                                    </div>
                                                </li>
                                                @endforeach
                                                <!-- list permission:end -->
                                            </ul>
                                        </div>

                                        <!-- list manage name:end  -->
                                        @endforeach
                                    </div>

                                    @error('permissions')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="float-right">
                                    <a class="btn btn-outline-primary _btn-primary px-4" href="{{ route('roles.index') }}">
                                        Back
                                    </a>
                                    <button type="submit" class="btn btn-primary _btn-primary px-4">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
            </form>
        </div>

    </div>
</div>
</div>
</div>

@endsection