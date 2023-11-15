@extends('layouts.admin.master')

@section('title')
CMS | Create - Supplier
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.css') }}">

<style>
    form {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        min-height: 70vh;
    }
</style>
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Create - Supplier</h3>
@endslot
{{-- {{ Breadcrumbs::render('add_code') }} --}}
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <form action="{{ route('supplier.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card _card" style="width: 40%; margin: auto">
                    <div class="card-body _card-body">
                        <div class="row d-flex align-items-stretch">

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <!-- title -->
                                        <div class="form-group _form-group">
                                            <label for="input_supplier_code" class="font-weight-bold">
                                                Code <span class="wajib">* </span>
                                            </label>
                                            <input id="input_supplier_code" value="{{ old('supplier_code') }}"
                                                name="supplier_code" type="text"
                                                class="form-control @error('supplier_code') is-invalid @enderror"
                                                placeholder="Type here.." required />
                                            @error('supplier_code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-12">
                                        <div class="form-group _form-group">
                                            <label for="input_name" class="font-weight-bold">
                                                Name <span class="wajib">* </span>
                                            </label>
                                            <input id="input_name" value="{{ old('name') }}" name="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Type here.." required />
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group _form-group">
                                            <label for="input_phone" class="font-weight-bold">
                                                Phone <span class="wajib">* </span>
                                            </label>
                                            <input id="input_phone" value="{{ old('phone') }}" name="phone"
                                                type="number" class="form-control @error('phone') is-invalid @enderror"
                                                placeholder="Type here.." required />
                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group _form-group">
                                            <label for="input_email" class="font-weight-bold">
                                                Email <span class="wajib">* </span>
                                            </label>
                                            <input id="input_email" value="{{ old('email') }}" name="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Type here.." required />
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group _form-group">
                                            <label for="input_address" class="font-weight-bold">
                                                Address <span class="wajib">* </span>
                                            </label>
                                            <textarea id="input_address" value="{{ old('address') }}" name="address"
                                                type="text" class="form-control @error('address') is-invalid @enderror"
                                                placeholder="Type here.." required></textarea>
                                            @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">

                            <div class="col-12">
                                <div style="width: 100; display: flex; align-items: center; justify-content: center;">
                                    <a style="width: 50%; margin-right: 5px"
                                        class="btn btn-outline-primary _btn-primary px-4"
                                        href="{{ route('supplier.index') }}">Back</a>
                                    <button style="width: 50%; margin-left: 5px" type="submit"
                                        class="btn btn-primary _btn-primary px-4">
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
<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script src="{{ asset('vendor/tinymce5/jquery.tinymce.min.js') }}"></script>
<script src="{{ asset('vendor/tinymce5/tinymce.min.js') }}"></script>
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('vendor/select2/js/' . app()->getLocale() . '.js') }}"></script>
@endpush


@push('javascript-internal')

@endpush