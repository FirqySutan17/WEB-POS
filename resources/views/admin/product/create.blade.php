@extends('layouts.admin.master')

@section('title')
CMS | Add Product
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.css') }}">
<link href="{{ asset('assets/css/datepicker.min.css') }}" rel="stylesheet">
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Add Product</h3>
@endslot
{{ Breadcrumbs::render('product') }}
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card _card" style="margin: auto; padding-bottom: 20px">
                    <div class="card-body _card-body">
                        <div class="row d-flex align-items-stretch">

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <!-- code -->
                                        <div class="form-group _form-group">
                                            <label for="input_post_code" class="font-weight-bold">
                                                Barcode <span class="wajib">* </span>
                                            </label>
                                            <input id="input_post_code" value="{{ old('code', '8891') }}" max="13" name="code"
                                                type="text" class="form-control @error('code') is-invalid @enderror"
                                                placeholder="Scan barcode here.." required tabindex="1" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  autofocus />
                                            @error('code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <!-- title -->
                                        <div class="form-group _form-group">
                                            <label for="input_post_title" class="font-weight-bold">
                                                Product Name <span class="wajib">* </span>
                                            </label>
                                            <input id="input_post_title" value="{{ old('name') }}" name="name"
                                                type="text" class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Type name here.." required />
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group _form-group">
                                            <label for="price_store" class="font-weight-bold">
                                                Store Price <span class="wajib">* </span>
                                            </label>
                                            <input id="price_store" value="{{ old('price_store') }}" name="price_store"
                                                type="text"
                                                class="form-control @error('price_store') is-invalid @enderror"
                                                placeholder="Ex: 5.000"
                                                onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                required />
                                            @error('price_store')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group _form-group">
                                            <label for="price_olshop" class="font-weight-bold">
                                                E-Commerce Price <span class="wajib">* </span>
                                            </label>
                                            <input id="price_olshop" value="{{ old('price_olshop') }}"
                                                name="price_olshop" type="text"
                                                class="form-control @error('price_olshop') is-invalid @enderror"
                                                placeholder="Ex: 5.000"
                                                onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                required />
                                            @error('price_olshop')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <!-- End Year -->
                                        <div class="form-group _form-group">
                                            <label for="stock_olshop" class="font-weight-bold">
                                                Store Discount (%)
                                            </label>
                                            <input id="discount_store" value="{{ old('discount_store') }}"
                                                name="discount_store" type="number"
                                                class="form-control @error('discount_store') is-invalid @enderror"
                                                placeholder="Ex: 5" />
                                            @error('discount_store')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <!-- End Year -->
                                        <div class="form-group _form-group">
                                            <label for="stock_olshop" class="font-weight-bold">
                                                E-Commerce Discount (%)
                                            </label>
                                            <input id="discount_olshop" value="{{ old('discount_olshop') }}"
                                                name="discount_olshop" type="number"
                                                class="form-control @error('discount_olshop') is-invalid @enderror"
                                                placeholder="Ex: 5" />
                                            @error('discount_olshop')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Kategori -->
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group _form-group">
                                            <label for="select_user_kategori" class="font-weight-bold">
                                                Category <span class="wajib">*</span>
                                            </label>
                                            <select id="select_user_kategori" name="kategori"
                                                data-placeholder="Choose categories"
                                                class="js-example-placeholder-multiple">
                                                <option value="Internal">Internal</option>
                                                <option value="External">External</option>
                                            </select>
                                            @error('role')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                            <!-- error message -->
                                        </div>

                                    </div>
                                    <div class="col-6">
                                        {{-- Skill --}}
                                        <div class="form-group  _form-group">
                                            <label for="select_product_category" class="font-weight-bold">
                                                Type <span class="wajib">*</span>
                                            </label>
                                            <select id="select_product_category" name="categories[]"
                                                data-placeholder="Choose product type.." class="custom-select" required
                                                multiple>

                                            </select>
                                        </div>
                                        {{-- End Skill --}}
                                    </div>
                                </div>

                                <!-- end role -->

                                <!-- description -->
                                <div class="form-group _form-group">
                                    <label for="input_post_description" class="font-weight-bold">
                                        Description
                                    </label>
                                    <textarea id="input_post_description" name="description"
                                        placeholder="Write description here.."
                                        class="form-control @error('description') is-invalid @enderror"
                                        rows="7">{{ old('description') }}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group {{ $errors->has('is_vat') ? ' has-error' : '' }} _form-group"
                                    style="display: flex; margin-top: 30px">
                                    <label for="input_banner_status" class="font-weight-bold"
                                        style="padding: 7px 0px; margin-right: 20px;">
                                        Include PPN
                                    </label>
                                    <div class="col-2">
                                        <div class="media">
                                            <div class="media-body text-end icon-state">
                                                <label class="switch">
                                                    <input type="checkbox" name="is_vat" {{ old("is_vat")==1 ? "checked"
                                                        : null }}><span class="switch-state"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- status -->
                                <div class="form-group {{ $errors->has('is_active') ? ' has-error' : '' }} _form-group"
                                    style="display: flex; margin-top: 30px">
                                    <label for="input_banner_status" class="font-weight-bold"
                                        style="padding: 7px 0px; margin-right: 20px;">
                                        Status
                                    </label>
                                    <div class="col-2">
                                        <div class="media">
                                            <div class="media-body text-end icon-state">
                                                <label class="switch">
                                                    <input type="checkbox" name="is_active" {{ old("is_active")==1
                                                        ? "checked" : null }}><span class="switch-state"></span>
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
                                    <a class="btn btn-outline-primary _btn-primary px-4"
                                        href="{{ route('product.index') }}">Back</a>
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
<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script src="{{ asset('vendor/tinymce5/jquery.tinymce.min.js') }}"></script>
<script src="{{ asset('vendor/tinymce5/tinymce.min.js') }}"></script>
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
{{-- <script src="{{ asset('vendor/select2/js/' . app()->getLocale() . '.js') }}"></script> --}}
<script src="{{ asset('assets/js/datepicker.min.js') }}"></script>
@endpush


@push('javascript-internal')
<script>
    $(function() {
        $('#select_user_kategori').select2({
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

        $("#select_user_kategori").change(function() {
            let isian = $(this).val();
            if (isian == 'Internal') {
                $("#input_post_code").val('8891');
            } else {
                $("#input_post_code").val('889010121');
            }
        });

        //select2 tag
    $('#select_product_category').select2({
            theme: 'bootstrap4',
            language: "",
            allowClear: true,
            ajax: {
                url: "{{ route('product-category.select') }}",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.categories,
                                id: item.id
                            }
                        })
                    };
                }
            }
    });
    });
</script>

<script>
    /* Tanpa Rupiah */
    var price_store    = document.getElementById('price_store');
        price_store.addEventListener('keyup', function(e) {
            var nominal = this.value;
            price_store.value = formatRupiah(nominal);
        });

    var price_olshop    = document.getElementById('price_olshop');
        price_olshop.addEventListener('keyup', function(e) {
            var nominal = this.value;
            price_olshop.value = formatRupiah(nominal);
        });

        /* Fungsi */
        function formatRupiah(angka, prefix)
        {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split   		= number_string.split(','),
            sisa     		= split[0].length % 3,
            rupiah     		= split[0].substr(0, sisa),
            ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
        
            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if(ribuan){
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
        
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
</script>
@endpush