@extends('layouts.admin.master')

@section('title')
CMS | Edit Membership
@endsection

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Edit Membership</h3>
@endslot
{{ Breadcrumbs::render('edit_membership', $membership) }}
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <form action="{{ route('membership.update', ['membership' => $membership]) }}" method="POST"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card _card " style="width: 60%; margin: auto">
                    <div class="card-body _card-body">
                        <div class="row d-flex align-items-stretch">

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <!-- Employee ID -->
                                        <div class="form-group _form-group">
                                            <label for="input_user_name" class="font-weight-bold">
                                                Employee ID <span class="wajib">*</span>
                                            </label>
                                            <input id="input_user_name" value="#{{ old('code', $membership->code) }}"
                                                name="code" type="text"
                                                class="form-control @error('code') is-invalid @enderror"
                                                placeholder="Input Employee ID.." readonly />
                                            @error('code')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                            <!-- error message -->
                                        </div>
                                        <!-- end Employee ID -->

                                        <!-- name -->
                                        <div class="form-group _form-group">
                                            <label for="input_user_name" class="font-weight-bold">
                                                Name <span class="wajib">*</span>
                                            </label>
                                            <input id="input_user_name" value="{{ old('name', $membership->name) }}"
                                                name="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Write name here.." />
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
                                                Phone <span class="wajib">*</span>
                                            </label>
                                            <input id="input_user_name" value="{{ old('phone', $membership->phone) }}"
                                                name="phone" type="text"
                                                class="form-control @error('phone') is-invalid @enderror"
                                                placeholder="Input Phone Number" readonly />
                                            @error('phone')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                            <!-- error message -->
                                        </div>
                                        <!-- end name -->

                                        <!-- email -->
                                        <div class="form-group _form-group">
                                            <label for="input_user_email" class="font-weight-bold">
                                                Email <span class="wajib">*</span>
                                            </label>
                                            <input id="input_user_email" value="{{ old('email', $membership->email) }}"
                                                name="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Write email here.." autocomplete="email" readonly />
                                            @error('email')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                            <!-- error message -->
                                        </div>
                                        <!-- end email -->
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">

                            <div class="col-12">
                                <div style="width: 100; display: flex; align-items: center; justify-content: center;">
                                    <a style="width: 50%; margin-right: 5px"
                                        class="btn btn-outline-primary _btn-primary px-4"
                                        href="{{ route('membership.index') }}">Back</a>
                                    <button style="width: 50%; margin-left: 5px" type="submit"
                                        class="btn btn-primary _btn-primary px-4">
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
<link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/select2/css/select2-bootstrap4.min.css') }}">
@endpush

@push('javascript-external')
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('vendor/select2/js/' . app()->getLocale() . '.js') }}"></script>
<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
@endpush

@push('javascript-internal')
<script>
    $(function() {
		//parent category
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
@endpush