@extends('layouts.admin.master')

@section('title')
CMS | Transaction
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Transaction</h3>
@endslot
{{ Breadcrumbs::render('transaction') }}
@endcomponent
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <form id="form-receive" action="{{ route('receive.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card _card" style="margin: auto; padding-bottom: 20px">
                    <div class="card-body _card-body">
                        <div class="row d-flex align-items-stretch">

                            <div class="col-12">
                                <div class="form-group _form-group">
                                    <label for="receive_date" class="font-weight-bold">
                                        Receive Date <span class="wajib">* </span>
                                    </label>
                                    <input id="receive_date" value="{{ old('receive_date') }}" name="receive_date"
                                        type="text"
                                        value="{{ date('Y-m-d') }}"
                                        class="form-control @error('receive_date') is-invalid @enderror" required />
                                    @error('receive_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group _form-group">
                                            <label for="driver" class="font-weight-bold">
                                                Driver Name <span class="wajib">* </span>
                                            </label>
                                            <input id="driver" value="{{ old('driver') }}" name="driver" type="text" class="form-control input-scanner @error('driver') is-invalid @enderror" placeholder="Input driver name here"/>
                                            @error('driver')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <!-- End Year -->
                                        <div class="form-group _form-group">
                                            <label for="driver_phone" class="font-weight-bold">
                                                Driver Phone Number <span class="wajib">* </span>
                                            </label>
                                            <input id="driver_phone" value="{{ old('driver_phone') }}" name="driver_phone" type="text" class="form-control input-scanner @error('driver_phone') is-invalid @enderror" placeholder="Input Driver Phone Number here"/>
                                            @error('driver_phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group _form-group">
                                            <label for="plat_no" class="font-weight-bold">
                                                Vehicle License Number <span class="wajib">* </span>
                                            </label>
                                            <input id="plat_no" value="{{ old('plat_no') }}" name="plat_no" type="text" class="form-control input-scanner @error('plat_no') is-invalid @enderror" placeholder="Input Plat Nomor Kendaraan disini"/>
                                            @error('plat_no')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <!-- title -->
                                <div class="form-group _form-group">
                                    <label for="suratjalan_number" class="font-weight-bold">
                                        Nomor Surat Jalan <span class="wajib">* </span>
                                    </label>
                                    <input id="suratjalan_number" value="{{ old('suratjalan_number') }}"
                                        name="suratjalan_number" type="text"
                                        class="form-control input-scanner @error('suratjalan_number') is-invalid @enderror"
                                        placeholder="Input surat jalan number here"/>
                                    @error('suratjalan_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- title -->
                                <div class="form-group _form-group">
                                    <label for="input_post_link" class="font-weight-bold">
                                        File Surat Jalan  <span class="wajib">* </span>
                                    </label>
                                    <input name="suratjalan_file" type="file" class="form-control"  />
                                    @error('suratjalan_file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="row req-box">
                                    <div class="col-6">
                                        <p style="vertical-align: middle; font-weight: 600; color: rgba(0, 0, 0, 0.85); padding: 6px 0px;font-size: 13px">Product / Item <span class="wajib">*</span></p>
                                        <input id="input-scanner" type="text" class="form-control input-scanner @error('suratjalan_number') is-invalid @enderror" placeholder="Fokuskan kursor kesini untuk scan barcode"/>
                                    </div>
                                    <div class="col-6" style="float: right; text-align: right">
                                        
                                        <button onclick="add_product_item()" type="button"
                                            class="btn btn-primary _btn-primary px-4" style="font-weight: 600">
                                            +
                                        </button>
                                    </div>
                                </div>

                                <div class="mt-2" id="product_lists">

                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-12">
                                <div class="float-right">
                                    <a class="btn btn-outline-primary _btn-primary px-4"
                                        href="{{ route('receive.index') }}">Back</a>
                                    <button onclick="submit_form()" type="button" class="btn btn-primary _btn-primary px-4">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
@endpush


@push('javascript-internal')

<script>
    function submit_form() {
        $("#form-receive").submit();
    }
    $(document).ready(function(){
        $("#receive_date").datepicker({
            format: "yyyy-mm-dd",
            autoclose:true
        }); 
    })
</script>

<script>
    var item_arr = [];
    var product_arr = [];
    var product_position_arr = [];
    function add_product_item() {
        var id = new Date().valueOf();
        var item_id = "item_slider_" + id;
        var html_item = `
            <div id="${item_id}">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group _form-group">
                            <label for="input_post_description" class="font-weight-bold">
                                Product / Item <span class="wajib">* </span>
                            </label>
                            <div class="float-right">
                                <button onclick="delete_row_slider('${item_id}')" type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                            </div>
                            <select id="select_item_product_${item_id}" data-itemid="${item_id}" name="product_code[]"
                                data-placeholder="Choose item" class="custom-select select-item" onChange="select_item_onchange('${item_id}')">
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div  class="form-group _form-group">
                            <label for="input_post_description" class="font-weight-bold">
                                Amount 
                            </label>
                            <input id="amount_${item_id}" name="amount[]" type="number" class="form-control" value="0" />
                        </div>
                    </div>
                </div>
            </div>
        `;

        item_arr[item_id] = "";
        $("#product_lists").append(html_item);
        $(`#select_item_product_${item_id}`).select2({
            theme: 'bootstrap4',
            language: "",
            allowClear: false,
            ajax: {
                url: "{{ route('product.select') }}",
                dataType: 'json',
                delay: 250,
                type: 'POST',
                data: {
                    _token : `{{ csrf_token() }}`,
                    existing_item: get_product_arr()
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.code + " | " + item.name,
                                id: item.code
                            }
                        })
                    };
                }
            }
        });

        console.log(product_position_arr, item_arr, product_arr);
    }

    function get_product_arr() {
        return JSON.stringify(product_arr);
    }

    function delete_row_slider(eid_item) {
        var product_code = item_arr[eid_item];
        var toRemove = [product_code];

        delete product_position_arr[product_code];
        delete item_arr[eid_item];

        var index_product = product_arr.indexOf(product_code);
        if (product_arr.includes(product_code)) {
            delete product_arr[index_product];
            product_arr.length = product_arr.length - 1;
        }

        // product_arr = product_arr.filter( function( el ) {
        //     return toRemove.indexOf( el ) < 0;
        // } );
        $("#" + eid_item).remove();
    }

    function select_item_onchange(item_id) {
        var product_code = $(`#select_item_product_${item_id} :selected`).val();
        if (!(product_code in product_position_arr)) {
            // Execute to create new array with product code as key in product_position_arr
            product_position_arr[product_code] = item_id;
            item_arr[item_id] = product_code;
            product_arr.push(product_code);
        }

        if (product_code != item_arr[item_id]) {
            $("#item_id").remove();
        }
        // Menambah Amount pada existing product
        var position_product_item = product_position_arr[product_code];
        if ($(`#${position_product_item}`).length > 0) {
            var str_amount_product = $(`#amount_${position_product_item}`).val();
            var amount_product = parseInt(str_amount_product) + 1;
            $(`#amount_${position_product_item}`).val(amount_product);
        }
    }

</script>
@endpush