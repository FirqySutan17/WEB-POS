@extends('layouts.admin.master')

@section('title')
CMS | Add Common Code
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
<h3>Add Common Code</h3>
@endslot
{{-- {{ Breadcrumbs::render('add_code') }} --}}
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <form action="{{ route('common-code.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card _card" style="width: 40%; margin: auto">
                    <div class="card-body _card-body">
                        <div class="row d-flex align-items-stretch">

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group _form-group">
                                            <label for="input_head" class="font-weight-bold">
                                                Head <span class="wajib">* </span>
                                            </label>
                                            <select id="select_code" name="head_id" data-placeholder="Choose head"
                                                class="js-example-placeholder-multiple">
                                                <option value="0">Choose head</option>
                                                @foreach($codes as $c)
                                                <option value="{{$c->id}}">
                                                    {{$c->head}} - {{$c->code_name}}
                                                </option>

                                                @endforeach
                                            </select>
                                            @error('membership')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                            <!-- error message -->
                                        </div>

                                    </div>
                                    <div class="col-12">
                                        <div class="form-group _form-group">
                                            <label for="input_code" class="font-weight-bold">
                                                Code <span class="wajib">* </span>
                                            </label>
                                            <input id="input_code" value="{{ old('code') }}" name="code" type="text"
                                                class="form-control @error('code') is-invalid @enderror"
                                                placeholder="Type here.." />
                                            @error('code')
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
                                                placeholder="Type here.." />
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group _form-group">
                                            <label for="input_desc" class="font-weight-bold">
                                                Description
                                            </label>
                                            <textarea id="input_desc" value="" name="description" type="text"
                                                class="form-control @error('description') is-invalid @enderror"
                                                placeholder="Type here.." rows="5">{{ old('description') }}</textarea>
                                            @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group {{ $errors->has('is_active') ? ' has-error' : '' }} _form-group"
                                            style="display: flex;">
                                            <label for="input_banner_status" class="font-weight-bold"
                                                style="padding: 7px 0px; margin-right: 20px;">
                                                Status
                                            </label>
                                            <div class="col-2">
                                                <div class="media">
                                                    <div class="media-body text-end icon-state">
                                                        <label class="switch">
                                                            <input type="checkbox" name="is_active" {{
                                                                old("is_active")==1 ? "checked" : null }}><span
                                                                class="switch-state"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
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
                                        href="{{ route('common-code.index') }}">Back</a>
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
<script>
    $(function() {
        //parent category
        $('#select_code').select2({
            theme: 'bootstrap4',
            language: "{{ app()->getLocale() }}",
            allowClear: true,
            ajax: {
                url: "{{ route('code.select') }}",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.head + " - " + item.code_name,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });


    });
</script>
@endpush