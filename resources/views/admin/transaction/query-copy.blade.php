@extends('layouts.admin.master')

@section('title')
CMS | Transaction
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.css') }}">
<link href="{{ asset('assets/css/datepicker.min.css') }}" rel="stylesheet">

<style>
    .tr-input {
        width: 100%;
        position: relative;
    }

    .tr-input input[type="text"] {
        width: 100%;
        padding: 15px 0px;
        border: none;
        outline: none;
        border-radius: 5px 5px 0 0;
        background-color: #ffffff;
        font-size: 16px;
    }

    .tr-input ul {
        list-style: none;
        position: absolute;
        top: 64px;
        box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
        left: 0;
        padding: 10px 10px;
        border-radius: 10px
    }

    .tr-input .list {
        width: 100%;
        background-color: #ffffff;
        border-radius: 10px
    }

    .tr-input .list-items {
        padding: 10px 5px;
    }

    .tr-input .list-items:hover {
        background-color: #dddddd;
    }

    .stay-hidden {
        display: none;
    }

    .wrap-cashier {
        display: flex;
        margin: auto;
        position: relative;
        margin-top: 20px;
    }

    .info-disc {
        position: absolute;
        top: 0;
        right: 0;
    }

    #element {
        position: absolute;
        top: 41px;
        right: 10px;
        background: #000000c4;
        color: #fff;
        z-index: 1000;
        width: 520px;
        padding: 20px 10px;
        border-radius: 5px;
        border-top-right-radius: 0px;
    }

    .query-padding td {
        padding: 15px 10px !important;
    }
</style>
@endpush

@section('content')
@if(Auth::user()->roles->first()->name == 'Cashier')

@else
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Transaction</h3>
@endslot
{{ Breadcrumbs::render('transaction') }}
@endcomponent
@endif

<div class="container-fluid">
    <div class="wrap-cashier">
        @if(Auth::user()->roles->first()->name == 'Cashier')
        <div class="menu-rt">
            <a class="{{routeActive('transaction.create')}}" href="{{ route('transaction.create') }}">Transaction</a>
            <a class="{{routeActive('transaction.listdraft')}}" href="{{ route('transaction.listdraft') }}">Draft</a>
            <a class="{{routeActive('transaction.index')}}" href="{{ route('transaction.index') }}">List</a>
            <a class="{{routeActive('cashflow.index')}}" href="{{ route('cashflow.index') }}">Cash Flow</a>
            <a class="{{routeActive('shift.index')}}" href="{{ route('shift.index') }}">Shift Management</a>

            <button class="btn " type="button">
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class='bx bx-log-out-circle'></i> {{__('Logout') }}
                </a>
            </button>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
        @endif
        <div class="info-disc">
            <div class="button-container">
                <button id="click" class="btn-disc">
                    <i class='bx bx-x' style="font-size: 18px; display: inline-block; vertical-align: middle"></i>
                </button>
            </div>
            {{-- <div id="element">
                @if (!empty($product_discount))
                @foreach ($product_discount as $item)
                <span class="m-2">{{ $item->name." DISC ".$item->discount_store."%" }}</span>
                @endforeach
                @endif
            </div> --}}
        </div>
    </div>

    @if(Auth::user()->roles->first()->name == 'Cashier')
    <div class="row" style="padding: 10px">
        @else
        <div class="row" style="padding: 0px 10px">
            @endif

            <div class="col-12">
                <form id="form-transaction" action="{{ route('transaction.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input id="input_status" type="hidden" name="status" value="FINISH">
                    <div class="card" style="margin: auto;">
                        <div class="card-body _card-body">
                            <div class="row d-flex align-items-stretch">
                                <div class="col-md-12">
                                    <div class="row" style="padding: 10px 0px; font-weight: 600; margin-bottom: 10px">
                                        <div class="col-6">
                                            Kasir : {{ Auth::user()->name }}
                                        </div>
                                        <div class="col-6" style="float: right; text-align: right">
                                            Tanggal : {{ date('d-m-Y') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9 col-sm-12" style="padding-left: 0px">
                                    {{-- <div class="tr-input">
                                        <div class="row">
                                            <div class="col-6">
                                                <input id="input-scanner" type="text" class="form-control"
                                                    placeholder="Klik disini untuk Scan Barcode"
                                                    style="height: 50px; box-shadow: 0 3px 10px rgb(0 0 0 / 0.2); margin-bottom: 20px; padding-left: 20px "
                                                    tabindex="1" autofocus />
                                            </div>
                                            <div class="col-6">
                                                <input type="text" id="input-typing"
                                                    placeholder="Cari barang manual disini" class="form-control"
                                                    tabindex="2"
                                                    style="height: 50px; box-shadow: 0 3px 10px rgb(0 0 0 / 0.2); margin-bottom: 20px; padding-left: 20px " />
                                            </div>
                                        </div>
                                        <ul class="list stay-hidden"></ul>
                                    </div> --}}

                                    <div class="tr-shadow table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th style="width: 45%; vertical-align: middle" class="heightHr">Nama
                                                        Item <span class="dividerHr"></span></th>
                                                    <th style="width: 19%; vertical-align: middle; text-align: center"
                                                        class="heightHr center-text">Harga <span
                                                            class="dividerHr"></span>
                                                    </th>
                                                    <th style="width: 6%; vertical-align: middle"
                                                        class="heightHr center-text">Qty <span class="dividerHr"></span>
                                                    </th>
                                                    <th style="width: 10%; vertical-align: middle; text-align: center"
                                                        class="heightHr center-text">Disc (%)
                                                        <span class="dividerHr"></span>
                                                    </th>
                                                    <th style="width: 15%; vertical-align: middle; text-align: right"
                                                        class="heightHr center-text">Total <span
                                                            class="dividerHr"></span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="product_lists" class="custom-scrollbar query-padding"
                                                style="height: 525px">
                                            </tbody>

                                        </table>
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-12">

                                    <div class="row tr-shadow" style="margin-bottom: 10px; height: 130px">
                                        <div class="col-12" style="margin: auto">
                                            <h5 style="text-align: right">Grand Total</h5>
                                            <h2 id="total_transaction"
                                                style="text-align: right; font-size: 46px; font-weight: 800; margin-bottom: 0px">
                                                Rp 0</h2>
                                        </div>
                                    </div>
                                    <div class="row tr-shadow"
                                        style="display: flex; flex-direction: column; justify-content: center; align-items: center; margin-bottom: 10px; padding: 20px 10px 10px 10px">
                                        <div class="col-12">
                                            <div class="form-group _form-group"
                                                style="display: flex; margin-bottom: 10px">
                                                <label for="receive_date" class="font-weight-bold" style="width: 20%">
                                                    Sub Total
                                                </label>
                                                <h6 id="sub_total" style="text-align: right; width: 80%">0</h6>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group _form-group"
                                                style="display: flex; margin-bottom: 0px">
                                                <label for="receive_date" class="font-weight-bold" style="width: 30%">
                                                    Sub Disc (%)
                                                </label>
                                                <h6 id="total_discount" style="text-align: right; width: 70%">0</h6>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row tr-shadow"
                                        style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                                        <div class="col-12">
                                            <div class="form-group _form-group"
                                                style="display: flex; margin-bottom: 10px; justify-content: center; align-items: center;">
                                                <label for="receive_date" class="font-weight-bold" style="width: 45%">
                                                    Tunai
                                                </label>
                                                <input id="tanpa-rupiah" style="text-align: right"
                                                    placeholder="Ex: 50000" name="cash" type="text" {{
                                                    $transaction->payment_method != 'Tunai' ? 'readonly' : '' }}
                                                class="form-control elm_cash_input" tabindex="4" value="{{
                                                number_format($transaction->cash) }}" readonly />
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group _form-group"
                                                style="display: flex; margin-bottom: 0px; margin-bottom: 5px; justify-content: center; align-items: center;">
                                                <label for="receive_date" class="font-weight-bold" style="width: 45%">
                                                    Kembalian
                                                </label>
                                                <?php $kembalian = !empty($transaction->kembalian) ? $transaction->kembalian : $transaction->cash - $transaction->total_price; ?>
                                                <input style="text-align: right" id="kembalian"
                                                    placeholder="Hitungan otomatis" type="text" class="form-control"
                                                    readonly tabindex="0" value="{{ number_format($kembalian) }}" />
                                            </div>

                                            <div class="form-group _form-group" style="margin-bottom: 5px">
                                                <label for="receive_date" class="font-weight-bold">
                                                    Metode Pembayaran <span class="wajib">* </span>
                                                </label>
                                                <input type="text" class="form-control"
                                                    value="{{ $transaction->payment_method}}" readonly />
                                            </div>
                                            <div id="elm_receipt" class="form-group _form-group"
                                                style="margin-bottom: 10px !important">
                                                <label for="receive_date" class="font-weight-bold">
                                                    Receipt <span class="wajib">* </span>
                                                </label>
                                                <input type="text" class="form-control"
                                                    value="{{ $transaction->receipt_no}}" readonly />
                                            </div>

                                            <!-- role -->
                                            @if (!empty($transaction->membership_id))
                                                <div class="form-group _form-group">
                                                    <label for="select_membership" class="font-weight-bold"
                                                        style="width: 100%">
                                                        Membership
                                                    </label>
                                                    <input type="text" class="form-control"
                                                    value="{{ $transaction->membership?->code }} | {{ $transaction->membership?->name }} | {{ $transaction->membership?->phone }}"
                                                    readonly />
                                                    
                                                    <!-- error message -->
                                                </div>
                                            @endif
                                            <!-- end role -->

                                            <div
                                                style="width: 100%; display: flex; align-items: center; margin-top: 10px">
                                                <a class="btn btn-primary _btn-primary px-4" style="width: 100%"
                                                    href="{{ route('transaction.create')}}">BACK TO TRANSACTION</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <div class="modal" id="modal-add-membership" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ADD NEW MEMBERSHIP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" style="width: 40%; margin: auto">
                        <div class="col-12">
                            <!-- Employee ID -->
                            <div class="form-group _form-group">
                                <label for="input_membership_id" class="font-weight-bold">
                                    Membership ID <span class="wajib">*</span>
                                </label>
                                <input id="input_membership_id" type="text" class="form-control input_membership"
                                    placeholder="Input Employee ID.." />
                                <!-- error message -->
                            </div>
                            <!-- end Employee ID -->

                            <!-- name -->
                            <div class="form-group _form-group">
                                <label for="input_membership_name" class="font-weight-bold">
                                    Name <span class="wajib">*</span>
                                </label>
                                <input id="input_membership_name" type="text" class="form-control input_membership"
                                    placeholder="Write name here.." />
                                <!-- error message -->
                            </div>
                            <!-- end name -->

                            <!-- Phone Number -->
                            <div class="form-group _form-group">
                                <label for="input_membership_phone" class="font-weight-bold">
                                    Phone Number <span class="wajib">*</span>
                                </label>
                                <input id="input_membership_phone" type="number" class="form-control input_membership"
                                    placeholder="Input Phone Number" />
                                <!-- error message -->
                            </div>
                            <!-- end name -->

                            <!-- email -->
                            <div class="form-group _form-group">
                                <label for="input_membership_email" class="font-weight-bold">
                                    Email <span class="wajib">*</span>
                                </label>
                                <input id="input_membership_email" type="email" class="form-control input_membership"
                                    placeholder="Write email here.." autocomplete="email" />
                                <!-- error message -->
                            </div>
                            <!-- end email -->


                        </div>

                        <div class="col-12">
                            <div style="width: 100%; display: flex; align-items: center; justify-content: center;">
                                <a style="width: 50%; margin-right: 5px"
                                    class="btn btn-outline-primary _btn-primary px-4 close"
                                    href="javascript:void(0)">Back</a>
                                <button id="add_member" style="width: 50%; margin-left: 5px" type="button"
                                    class="btn btn-primary _btn-primary px-4">
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
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
            $("#input-scanner").focus();
            $('#payment_method').select2({
                theme: 'bootstrap4',
                language: "{{ app()->getLocale() }}"
            });

            $("#payment_method").on('change', function() {
                var val = $("#payment_method option:selected").val();
                console.log('val', val);
                if (val == "Tunai") {
                    // $("#elm_receipt").hide();
                    $(".elm_receipt_input").prop('readonly', true);
                    // $(".elm_cash").show();
                    $(".elm_cash_input").prop('readonly', false);
                } else {
                    // $(".elm_cash").hide();
                    $(".elm_cash_input").prop('readonly', true);
                    // $("#elm_receipt").show();
                    $(".elm_receipt_input").prop('readonly', false);
                }
            });

            var transaction_detail_draft = JSON.parse(`{!! json_encode($transaction_details) !!}`);
            if (transaction_detail_draft.length > 0) {
                $.each(transaction_detail_draft, function(i, item) {
                    add_product_item(item.product_code, item.quantity);
                });
            }
        });

        var final_total_price_item = 0;
        var vat_amount = parseInt({{ config('app.vat_amount') }});
        function onfocus_color(item_id) {
            $(`#btn_delete_${item_id}`).removeClass('btn-danger');
            $(`#btn_delete_${item_id}`).addClass('btn-warning');
        }

        function onblur_color(item_id) {
            $(`#btn_delete_${item_id}`).removeClass('btn-warning');
            $(`#btn_delete_${item_id}`).addClass('btn-danger');
        }

        function submit_form(status) {
            $("#input_status").val(status);
            let payment_method = $("#payment_method option:selected").val();

            let cash_input  = $("#tanpa-rupiah").val();
            let cash_amount = Number(cash_input.replace(".", ""));

            let total_price_item = 0;
            $('.total_price_item').each(function(i, obj) {
                var price_item = Number($(this).val());
                total_price_item += price_item;
            });
            // console.log(status, payment_method, cash_amount, total_price_item);
            if ((status == 'FINISH' && payment_method.toUpperCase() == 'TUNAI') && total_price_item > cash_amount) {
                return Swal.fire({
                    title: 'Oops...',
                    text: 'Uang tunai kurang dari total belanja',
                    icon: 'error'
                });
            }
            $("#form-transaction").submit();
        }

        function calculate_vat() {
            clearInputItem();
            calculate_total();
            var total_price_item = 0;
            $('.total_price_item').each(function(i, obj) {
                var price_item = Number($(this).val());
                total_price_item += price_item;
            });
            $("#total_transaction").text(formatRupiah(total_price_item.toString()));
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
        }

        $('#input-typing').unbind('keyup');
        $('#input-typing').bind('keyup', function (e) {
            removeElements();
            var code = e.keyCode || e.which;
            let value = $('#input-typing').val();
            let len_char = value.length;
            if (len_char >= 3 && code != 13) {
                search_product(value);
            }
        });

        $('#input-scanner').unbind('keyup');
        $('#input-scanner').bind('keyup', function (e) {
            var code = e.keyCode || e.which;
            if (code == 13) {
                proceed_enter();
            }
            
        });

        function displayNames(value, text) {
            $("#input-typing").val(value);
            proceed_enter();
        }
        function removeElements() {
            $(".list").empty();
            $(".list").addClass('stay-hidden');
        }

        function proceed_enter() {
            removeElements();
            var product_code = $('#input-scanner').val().trim() == '' ? $('#input-typing').val().trim() : $('#input-scanner').val().trim();
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
            removeElements();
        }

        function clearInputItem() {
            $('#input-scanner').val('');
            $('#input-typing').val('');
        }


        function search_product(keyword) {
            $.ajax({
                url: "{{ route('product.select') }}",
                type: "POST",
                data: {
                    "_token": `{{ csrf_token() }}`,
                    "q": keyword,
                },
                beforeSend: function () {
                    removeElements();
                },
                success: function(response) {
                    console.log(response);
                    let data = response;
                    let html_input = "";
                    if (data.length > 0) {
                        $.each(data, function(i, item) {
                            html_input += `<option onclick="displayNames('${item.code}', '${item.code} | ${item.name}')" class="list-items" value="${item.code}">${item.code} | ${item.name}</option>`;
                        })
                    }
                    $(".list").html(html_input);
                    $(".list").removeClass("stay-hidden");
                }
            });
        }

        function add_product_item(product_code, qty = 1) {
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
                    var total_price_item = final_price * qty;
                    var html_item = `
                        <tr id="${item_id}">
                            <td style="width: 45%; vertical-align: middle">
                                <input id="product_code_${item_id}" name="product_code[]" type="hidden" class="form-control" value="${product.code}" tabindex="0"/>
                                <input id="basic_price_${item_id}" name="basic_price[]" type="hidden" class="form-control" value="${basic_price}" tabindex="0"/>
                                <input id="discount_store_${item_id}" name="discount_store[]" type="hidden" class="form-control" value="${discount_store}" tabindex="0"/>
                                <input id="final_price_${item_id}" name="final_price[]" type="hidden" class="form-control final_price_item" value="${final_price}" tabindex="0"/>
                                <input id="total_price_${item_id}" name="total_price[]" type="hidden" class="form-control total_price_item" value="${total_price_item}" tabindex="0"/>
                                ${product.code + ' - ' + product.name}
                            </td>
                            <td style="width: 19%; vertical-align: middle; text-align: center">
                                ${html_price}
                            </td>
                            <td style="width: 6%; vertical-align: middle">
                                <input type="number" id="quantity_${item_id}" name="quantity[]" min="0" style="width: 100%; border-radius: 5px; text-align: center; border: 1px solid #000" value="${qty}" placeholder="1" tabindex="1" readonly />
                            </td>
                            <td style="width: 10%; vertical-align: middle; text-align: center">${discount_store}%</td>
                            <td style="width: 15%; vertical-align: middle; text-align: right">Rp <span id="text_final_price_${item_id}">${formatRupiah(final_price.toString())}</span></td>

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

        /* Tanpa Rupiah */
        var tanpa_rupiah    = document.getElementById('tanpa-rupiah');
        var kembalian       = document.getElementById('kembalian');
        tanpa_rupiah.addEventListener('keyup', function(e) {
            var nominal = this.value;
            var nominal_number = Number(nominal.replace(".", ""));
            tanpa_rupiah.value = formatRupiah(nominal);

            var total_price_item = 0;
            $('.total_price_item').each(function(i, obj) {
                var price_item = Number($(this).val());
                total_price_item += price_item;
            });

            var kembali = total_price_item - nominal_number;
            kembalian.value = formatRupiah(kembali.toString());
        });
        
        /* Dengan Rupiah */
        // var dengan_rupiah = document.getElementById('dengan-rupiah');
        // dengan_rupiah.addEventListener('keyup', function(e)
        // {
        //     dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
        // });
        
        /* Fungsi */
        function formatRupiah(angka, prefix)
        {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split    = number_string.split(','),
                sisa     = split[0].length % 3,
                rupiah     = split[0].substr(0, sisa),
                ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
                
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>

    <script>
        $(function() {
        //parent category
        $('#select_membership').select2({
            theme: 'bootstrap4',
            language: "{{ app()->getLocale() }}",
            allowClear: true,
            ajax: {
                url: "{{ route('membership.select') }}",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.code + " | " + item.name + " | " + item.phone,
                                phone: item.phone,
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

    <script>
        function addMembers() {
        $("#modal-add-membership").modal('show');
        }

        $('.close').on('click', function () {
            $('#modal-add-membership').removeClass("show");
            $('#modal-add-membership').modal("hide");
        });
    </script>
    @endpush