@extends('layouts.admin.master')

@section('title')
CMS | Create - Purchase Order
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.css') }}">
<style>
    .table th {
        background: transparent !important;
    }

    .select-product-custom.select2-container .select2-selection--single {
        height: 50px !important;
    }

    .select-product-custom.select2-container .select2-selection--single .select2-selection__rendered {
        margin-top: 8px;
    }

    .select-product-custom.select2-container .select2-selection--single {
        border-radius: 5px 5px 0px 0px !important;
        border: 2px solid #a12a2f;
        border-color: #a12a2f !important;
    }

    .select-product-custom.select2-container--bootstrap4 .select2-selection--single .select2-selection__placeholder {
        line-height: calc(1.5em + .75rem);
        color: #a12a2f;
        font-size: 14px;
    }
</style>
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Create - Purchase Order</h3>
@endslot
{{-- {{ Breadcrumbs::render('add_code') }} --}}
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <form action="{{ route('purchase-order.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card _card">
                    <div class="card-body _card-body">
                        <div class="row d-flex align-items-stretch">

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group _form-group">
                                            <label for="input_po_no" class="font-weight-bold">
                                                P/O No <span class="wajib">* </span>
                                            </label>
                                            <input id="input_po_no" value="{{ old('po_no') }}" name="po_no" type="text"
                                                class="form-control @error('po_no') is-invalid @enderror"
                                                placeholder="Auto Generate" readonly />
                                            @error('po_no')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group _form-group">
                                            <label for="input_date_po" class="font-weight-bold">
                                                Date <span class="wajib">* </span>
                                            </label>
                                            <input id="input_date_po"
                                                value="{{ empty(old('date_po')) ? date('Y-m-d') : old('date_po') }}"
                                                name="date_po" type="date"
                                                class="trigger_term form-control @error('date_po') is-invalid @enderror"
                                                placeholder="Type here.." required />
                                            @error('date_po')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group _form-group">
                                            <label for="input_time_po" class="font-weight-bold">
                                                Time <span class="wajib">* </span>
                                            </label>
                                            <input id="input_time_po"
                                                value="{{ empty(old('time_po')) ? date('H:i') : old('time_po') }}"
                                                name="time_po" type="time" value="{{ date('H:i:s') }}"
                                                placeholder="Type here.."
                                                class="form-control @error('receive_time') is-invalid @enderror"
                                                required />
                                            @error('time_po')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-group _form-group">
                                            <label for="plant" class="font-weight-bold">
                                                Plant <span class="wajib">* </span>
                                            </label>
                                            <select id="plant" name="plant" data-placeholder="Choose.."
                                                class="js-example-placeholder-multiple" required>
                                                <option>Choose plant
                                                </option>
                                                <option value="Jakarta - PT. Feed & Care Indonesia">
                                                    Jakarta - PT. Feed & Care Indonesia
                                                </option>
                                                <option value="Semarang - PT. Feed & Care Indonesia">Semarang - PT. Feed
                                                    & Care Indonesia
                                                </option>
                                                <option value="Lampung - PT. Feed & Care Indonesia">Lampung - PT. Feed &
                                                    Care Indonesia
                                                </option>
                                            </select>
                                            @error('plant')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group _form-group">
                                            <label for="supplier_id" class="font-weight-bold">
                                                Supplier <span class="wajib">* </span>
                                            </label>
                                            <select id="supplier_id" name="supplier_id" data-placeholder="Choose.."
                                                class="js-example-placeholder-multiple" required>

                                            </select>
                                            @error('supplier_id')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="form-group _form-group">
                                            <label for="input_payment_term" class="font-weight-bold">
                                                Term <span class="wajib">* </span>
                                            </label>
                                            <input id="input_payment_term" value="{{ old('top_days') }}" name="top_days"
                                                type="text" class="trigger_term form-control @error('top_days') is-invalid @enderror"
                                                placeholder="0" required style="text-align: center" />
                                            @error('top_days')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group _form-group">
                                            <label for="select_top_category" class="font-weight-bold"
                                                style="margin-bottom: 20px">
                                                {{-- Office <span class="wajib">*</span> --}}
                                            </label>
                                            <select id="select_top_category" name="top_category"
                                                data-placeholder="Choose.." class="js-example-placeholder-multiple"
                                                required>

                                                @foreach($commons as $c)
                                                <option value="{{$c->id}}">
                                                    {{$c->code}} - {{$c->name}}
                                                </option>

                                                @endforeach
                                            </select>
                                            @error('top_category')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                            <!-- error message -->
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group _form-group">
                                            <label for="input_top_date" class="font-weight-bold"
                                                style="margin-bottom: 20px">
                                                {{-- Time <span class="wajib">* </span> --}}
                                            </label>
                                            <input id="input_top_date" value="{{ old('top_date') }}" name="top_date"
                                                type="date" class="trigger_term form-control @error('top_date') is-invalid @enderror"
                                                placeholder="Type here.." style="text-align: center" />
                                            @error('top_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <label for="input_delivery_time" class="font-weight-bold">
                                            Delivery time
                                        </label>
                                        <input id="input_delivery_time" value="{{ old('delivery_time') }}"
                                            name="delivery_time" type="text"
                                            class="form-control @error('delivery_time') is-invalid @enderror"
                                            placeholder="Type here.." />
                                        @error('delivery_time')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-3">
                                        <label for="input_delivery_place" class="font-weight-bold">
                                            Delivery place
                                        </label>
                                        <input id="input_delivery_place" value="{{ old('delivery_place') }}"
                                            name="delivery_place" type="text"
                                            class="form-control @error('delivery_place') is-invalid @enderror"
                                            placeholder="Type here.." />
                                        @error('delivery_place')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="input_remark" class="font-weight-bold">
                                            Remark
                                        </label>
                                        <textarea id="input_remark" value="{{ old('remarks') }}" name="remarks"
                                            type="text" class="form-control @error('remarks') is-invalid @enderror"
                                            placeholder="Type here.." rows="5"></textarea>
                                        @error('remarks')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-3" style="margin-top: -45px">
                                        <label for="input_tax" class="font-weight-bold">
                                            Tax
                                        </label>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="is_tax" id="taxYes"
                                                value="yes">
                                            <label class="form-check-label" for="taxYes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="is_tax" id="taxNo"
                                                value="no" checked>
                                            <label class="form-check-label" for="taxNo">No</label>
                                        </div>

                                    </div>

                                    <div class="col-3" style="margin-top: -45px">
                                        <label for="input_close" class="font-weight-bold">
                                            Close
                                        </label>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="is_po" id="closeYes"
                                                value="yes">
                                            <label class="form-check-label" for="closeYes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="is_po" id="closeNo"
                                                value="no" checked>
                                            <label class="form-check-label" for="closeNo">No</label>
                                        </div>

                                    </div>

                                    <div class="col-12">
                                        <hr style="margin: 20px 0px; height: 2px">
                                        <div class="form-group  _form-group" style="margin-bottom: 0px">
                                            {{-- <label for="select_product" class="font-weight-bold">
                                                Categories <span class="wajib">*</span>
                                            </label> --}}
                                            <select id="select_product" name="product"
                                                data-placeholder="Cari item manual disini" class="custom-select">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="table-responsive" style="background: #f2f2f2; margin-bottom: 20px">
                                            <table class="table table-striped table-hover" style="background: #f2f2f2">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 15%; vertical-align: middle; border-top: 0px solid #000; border-bottom: 2px solid #000"
                                                            class="heightHr">
                                                            Barcode
                                                            <span class="dividerHr"></span>
                                                        </th>
                                                        <th style="width: 21%; vertical-align: middle; text-align: left; border-top: 0px solid #000; border-bottom: 2px solid #000"
                                                            class="heightHr center-text">Name <span
                                                                class="dividerHr"></span>
                                                        </th>

                                                        <th style="width: 13%; vertical-align: middle; text-align: right; border-top: 0px solid #000; border-bottom: 2px solid #000"
                                                            class="heightHr center-text">Unit Price
                                                            <span class="dividerHr"></span>
                                                        </th>
                                                        <th style="width: 6%; vertical-align: middle; border-top: 0px solid #000; border-bottom: 2px solid #000"
                                                            class="heightHr center-text">Qty <span
                                                                class="dividerHr"></span>
                                                        </th>
                                                        <th style="width: 15%; vertical-align: middle; text-align: right; border-top: 0px solid #000; border-bottom: 2px solid #000"
                                                            class="heightHr center-text">Sub Amount <span
                                                                class="dividerHr"></span>
                                                        </th>
                                                        <th style="width: 15%; vertical-align: middle; text-align: right; border-top: 0px solid #000; border-bottom: 2px solid #000"
                                                            class="heightHr center-text">Tax <span
                                                                class="dividerHr"></span>
                                                        </th>
                                                        <th style="width: 15%; vertical-align: middle; text-align: right; border-top: 0px solid #000; border-bottom: 2px solid #000"
                                                            class="heightHr center-text">Total Amount <span
                                                                class="dividerHr"></span>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbl-material" class="custom-scrollbar">
                                                    
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="3"
                                                            style="font-weight: 700; text-align: left; border-top: 2px solid #000; border-bottom: 2px solid #000">
                                                            Grand total</td>
                                                        <td
                                                            style="font-weight: 700; text-align: center; border-top: 2px solid #000; border-bottom: 2px solid #000">
                                                            40
                                                        </td>
                                                        <td
                                                            style="vertical-align: middle; text-align: right;font-weight: 700; border-top: 2px solid #000; border-bottom: 2px solid #000">
                                                            Rp
                                                            1.500.000</td>
                                                        <td
                                                            style="vertical-align: middle; text-align: right;font-weight: 700; border-top: 2px solid #000; border-bottom: 2px solid #000">
                                                            Rp 500.000
                                                        </td>
                                                        <td
                                                            style="vertical-align: middle; text-align: right;font-weight: 700; border-top: 2px solid #000; border-bottom: 2px solid #000">
                                                            Rp
                                                            2.755.467</td>
                                                    </tr>
                                                </tfoot>

                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">

                            <div class="col-12">
                                <div style="width: 100%; display: flex; align-items: center; justify-content: center;">
                                    <a style="width: 50%; margin-right: 5px; padding: 10px 0px"
                                        class="btn btn-outline-primary _btn-primary px-4"
                                        href="{{ route('purchase-order.index') }}">Back</a>
                                    <button style="width: 50%; margin-left: 5px; padding: 10px 0px" type="submit"
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
<script src="{{ asset('assets/js/datepicker.min.js') }}">
</script>
@endpush


@push('javascript-internal')
<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
<script>
    $(function() {
        $('#supplier_id').select2({
            theme: 'bootstrap4',
            language: "{{ app()->getLocale() }}",
            allowClear: true,
            ajax: {
                url: "{{ route('supplier.select') }}",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.name,
                                code: item.supplier_code,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });
        $('#plant').select2({
            theme: 'bootstrap4',
            language: "{{ app()->getLocale() }}",
            allowClear: true,
        });
        $('#select_top_category').select2({
            placeholder: "Choose..",
                theme: 'bootstrap4',
                language: "{{ app()->getLocale() }}",
                allowClear: true,
                ajax: {
                    url: "{{ route('common-code.select') }}",
                    dataType: 'json',
                    delay: 100,
                    data: function (params) {
                        var query = {
                            q: params.term,
                            type: '1'
                        }

                        // Query parameters will be ?search=[term]&type=public
                        return query;
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.name,
                                    code: item.code,
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
    function onfocus_color(item_id) {
        $(`#btn_delete_${item_id}`).removeClass('btn-danger');
        $(`#btn_delete_${item_id}`).addClass('btn-warning');
    }

    function onblur_color(item_id) {
        $(`#btn_delete_${item_id}`).removeClass('btn-warning');
        $(`#btn_delete_${item_id}`).addClass('btn-danger');
    }

    function store_to_display() {
        let product_code = $("input[name^=product_code]").map(function(idx, elem) {
            return $(elem).val();
        }).get();

        let product_name = $("input[name^=product_name]").map(function(idx, elem) {
            return $(elem).val();
        }).get();

        let basic_price = $("input[name^=basic_price]").map(function(idx, elem) {
            return $(elem).val();
        }).get();

        let discount_store = $("input[name^=discount_store]").map(function(idx, elem) {
            return $(elem).val();
        }).get();

        let final_price = $("input[name^=final_price]").map(function(idx, elem) {
            return $(elem).val();
        }).get();

        // let total_price = $("input[name^=total_price]").map(function(idx, elem) {
        //     return $(elem).val();
        // }).get();

        let quantity = $("input[name^=quantity]").map(function(idx, elem) {
            return $(elem).val();
        }).get();

    }

    function calculate_vat() {
        clearInputItem();
        (function(next) {
            calculate_total();
            next()
        }(function() {
            store_to_display();
        }))
    }

    function calculate_total() {
        var total_discount  = 0;
        var total_qty       = 0;
        var sub_total       = 0;
        $('.final_price_item').each(function(i, obj) {
            var id = $(this).attr('id').split("_");
            var item_id = "item_product_" + id[4];
            var final_price_item = Number($(this).val());
            var basic_price_item = Number($(`#basic_price_${item_id}`).val());
            var quantity_item = Number($(`#quantity_${item_id}`).val());
            var discount = 0;
            var sub_total_item = final_price_item * quantity_item;
            if (final_price_item != basic_price_item) {
                discount = basic_price_item - final_price_item;
            }
            total_discount += discount * quantity_item;
            total_qty += quantity_item;
            sub_total += sub_total_item;
        });
        $("#total_discount").text(formatRupiah(total_discount.toString()));
        $("#sub_total").text(formatRupiah(sub_total.toString()));
        $("#total_qty").text(total_qty);

        var total_price_item = 0;
        $('.total_price_item').each(function(i, obj) {
            var price_item = Number($(this).val());
            total_price_item += price_item;
        });
        $("#total_transaction").text(formatRupiah(total_price_item.toString()));
    }

    function displayNames(value, text) {
        $("#input-typing").val(value);
        proceed_enter();
    }

    function proceed_enter() {
        var product_code = $('#select_product').val().trim();
        var item_product = "item_product_" + product_code;
        if ($(`#${item_product}`).length > 0) {
            var str_quantity_product = $(`#quantity_${item_product}`).val();
            var quantity_product = parseInt(str_quantity_product) + 1;
            var final_price = Number($(`#final_price_${item_product}`).val()) * quantity_product;
            
            $(`#quantity_${item_product}`).val(quantity_product);
            $(`#total_price_${item_product}`).val(final_price);
            $(`#text_final_price_${item_product}`).text(formatRupiah(final_price.toString()));
            calculate_vat();
        } else {
            add_product_item(product_code);
        }
    }

    function clearInputItem() {
        $('#select_product').val(null).trigger('change');
    }

    function add_product_item(product_code) {
        console.log(product_code);
        $.ajax({
            url: "{{ route('product.select_one') }}",
            type: "POST",
            data: {
                "_token": `{{ csrf_token() }}`,
                "product_code": product_code,
            },
            success: function(response) {
                if (response.status == "failed") {
                    Swal.fire({
                        title: 'Oops...',
                        text: response.message,
                        icon: 'error'
                    });
                    return false;
                }
                var product = response.data;
                var id = product_code;
                var item_id = "item_product_" + id;

                var basic_price = product.price_store;
                var final_price = basic_price;
                var html_price = formatRupiah(final_price.toString());
                // Calculate Discount
                var discount_store = (product.discount_store) ? product.discount_store : 0;
                var discount_price = 0;
                if (discount_store > 0) {
                    discount_price = basic_price * (discount_store / 100);
                    final_price = basic_price - discount_price;
                    html_price = `
                        <span style="text-decoration: line-through; font-size: 12px">${formatRupiah(basic_price.toString())}</span>
                        ${formatRupiah(final_price.toString())}
                    `;
                }

                var html_inputs = `
                    <input id="product_code_${item_id}" name="product_code[]" type="hidden" class="form-control" value="${product.code}" tabindex="0"/>
                    
                `;
                var html_item = `
                    <tr id="${item_id}">
                        <td style="vertical-align: middle; text-align: left">
                            
                            8991860205010</td>
                        <td style="vertical-align: middle; text-align: left">PAHA BAWAH
                            500 GR</td>

                        <td style="vertical-align: middle; text-align: right">
                            <input type="number" name="qty_detail" placeholder="0"
                                style="padding: 5px 5px; width: 100%; text-align: right; border-radius: 5px; border: 1px solid #a7a7a7" />
                        </td>
                        <td style="vertical-align: middle; text-align: center">
                            <input type="number" name="qty_detail" placeholder="0"
                                style="padding: 5px 5px; width: 100%; text-align: center; border-radius: 5px; border: 1px solid #a7a7a7" />
                        </td>
                        <td style="vertical-align: middle; text-align: right">Rp 167.540
                        </td>
                        <td style="vertical-align: middle; text-align: right">Rp 18.430
                        </td>
                        <td style="vertical-align: middle; text-align: right">
                            Rp 185.969
                        </td>
                        <td style="width: 35%; vertical-align: middle">
                            ${product.code + ' | ' + product.name}
                        </td>
                        <td style="width: 19%; vertical-align: middle; text-align: center">
                            ${html_price}
                        </td>
                        <td style="width: 6%; vertical-align: middle">
                            <input type="number" id="quantity_${item_id}" name="quantity[]" min="0" style="width: 100%; border-radius: 5px; text-align: center; border: 1px solid #000" value="1" placeholder="1" tabindex="1" />
                        </td>
                        <td style="width: 10%; vertical-align: middle; text-align: center">${discount_store}%</td>
                        <td style="width: 15%; vertical-align: middle; text-align: right">Rp <span id="text_final_price_${item_id}">${formatRupiah(final_price.toString())}</span></td>
                        <td style="width: 10%;" class="center-text boxAction fontField trans-icon">
                            <div class="boxInside" style="align-items: center; justify-content: center;">
                                <div class="boxDelete">
                                    <button id="btn_delete_${item_id}" onblur="onblur_color('${item_id}')" onfocus="onfocus_color('${item_id}')" onclick="delete_row_product('${item_id}')" type="button" class="btn btn-sm btn-danger">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                `;

                $("#product_lists").append(html_item);
                calculate_vat();
                $(`#quantity_${item_id}`).on('keyup', function (e) {
                    var code = e.keyCode || e.which;
                    // Arrow Up, Arrow Down, Backspace, Tab, Delete, 1 - 9
                    var allowed_keycode = [38, 40, 8, 9, 46, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105];
                    if (allowed_keycode.includes(code)) {
                        // var str_quantity_product = $(this).val();
                        // var quantity_product = code == 38 ? parseInt(str_quantity_product) + 1 : parseInt(str_quantity_product) - 1;
                        var qty = Number($(`#quantity_${item_id}`).val());
                        var final_price = Number($(`#final_price_${item_id}`).val());
                        var total_price = final_price * qty;
                        $(`#total_price_${item_id}`).val(total_price);
                        $(`#text_final_price_${item_id}`).text(formatRupiah(total_price.toString()));
                        calculate_vat();
                    } else {
                        e.preventDefault();
                    }
                });
            }
        });

    }

    function delete_row_product(eid_item) {
        $("#" + eid_item).remove();
        calculate_vat();
    }

</script>

<script>
    $(function() {
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

        $('#select_product').select2({
            theme: 'bootstrap4 select-product-custom',
            language: "",
            allowClear: true,
            minimumInputLength: 3,
            ajax: {
                url: "{{ route('product.select2_product') }}",
                dataType: 'json',
                delay: 250,
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

        $("#select_product").on('change', function() {
            if ($("#select_product").val()) {
                proceed_enter();
            }
        });
    });
</script>

<script>
    $('#click').on('click', function () {
    if ($('#click').html() === `<i class='bx bx-info-circle'
                    style="font-size: 18px; display: inline-block; vertical-align: middle"></i>`) {

        // This block is executed when
        // you click the show button
        $('#click').html(`<i class='bx bx-x'
                    style="font-size: 18px; display: inline-block; vertical-align: middle"></i>`);
    }
    else {

        // This block is executed when
        // you click the hide button
        $('#click').html(`<i class='bx bx-info-circle'
                    style="font-size: 18px; display: inline-block; vertical-align: middle"></i>`);
    }
    $('#element').toggle();
    });
</script>
@endpush