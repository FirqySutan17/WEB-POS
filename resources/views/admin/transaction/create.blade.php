@extends('layouts.admin.master')

@section('title')
CMS | Transaction
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">

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
            <a class="{{routeActive('transaction.summary')}}" href="{{ route('transaction.summary') }}">Profile</a>

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
        @else
        @endif
        <div class="info-disc">
            <div class="button-container">
                <button id="click" class="btn-disc">
                    <i class='bx bx-x' style="font-size: 18px; display: inline-block; vertical-align: middle"></i>
                </button>
            </div>
            <div id="element">
                @if (!empty($product_discount))
                @foreach ($product_discount as $item)
                <span class="m-2">{{ $item->name." DISC ".$item->discount_store."%" }}</span>
                @endforeach
                @endif
            </div>
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
                                <div class="col-md-3 col-sm-12">
                                    <div class="row tr-shadow"
                                        style="height: 328px; display: flex; flex-direction: column; justify-content: center; align-items: center; position: sticky; position: -webkit-sticky; top: 10px">
                                        <div class="col-12">
                                            <div class="form-group _form-group">
                                                <label for="receive_date" class="font-weight-bold">
                                                    Kasir
                                                </label>
                                                <input value="{{ Auth::user()->name }}" type="text" class="form-control"
                                                    required readonly tabindex="0" />
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group _form-group">
                                                <label for="receive_date" class="font-weight-bold">
                                                    Tanggal Transaksi
                                                </label>
                                                <input value="{{ date('d-m-Y') }}" class="form-control" required
                                                    readonly tabindex="0" />
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group _form-group">
                                                <label for="invoice_no" class="font-weight-bold">
                                                    Nomor Invoice
                                                </label>
                                                <input name="invoice_no" type="text" value="{{ $no_invoice }}"
                                                    class="form-control" required readonly tabindex="0" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row tr-shadow" style="margin-top: 20px">
                                        <!-- role -->
                                        <div class="form-group _form-group">
                                            <label for="select_membership" class="font-weight-bold" style="width: 100%">
                                                Membership <span class="wajib">*</span>
                                                <a href="javascript:void(0)" onclick="addMembers()" class="new-mem"
                                                    style="float: right;">
                                                    <i class='bx bx-plus'
                                                        style="display: inline-block; vertical-align: middle; font-weight: 700; font-size: 14px"></i>
                                                    New member
                                                </a>
                                            </label>
                                            <select id="select_membership" name="membership_id"
                                                data-placeholder="Choose membership"
                                                class="js-example-placeholder-multiple">
                                                <option value="0">Choose membership</option>
                                                @foreach($memberships as $membership)
                                                <option value="{{$membership->id}}">
                                                    {{$membership->phone}} - {{$membership->name}}
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
                                        <!-- end role -->
                                    </div>
                                </div>
                                <div class="col-md-9 col-sm-12" style="padding-right: 0px">
                                    {{-- <marquee width="100%" direction="left">

                                    </marquee> --}}
                                    <div class="tr-input">
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
                                    </div>

                                    <div class="tr-shadow table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th style="width: 35%; vertical-align: middle" class="heightHr">Nama
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
                                                    <th style="width: 10%;" class="center-text"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="product_lists" class="custom-scrollbar">
                                            </tbody>
                                            <thead>
                                                <tr>
                                                    <th style="width: 75%; vertical-align: middle; text-align=right"
                                                        class="heightHr">Total QTY<span class="dividerHr"></span></th>
                                                    <th style="width: 25%; vertical-align: middle; text-align: center"
                                                        class="heightHr center-text" id="total_qty">0</th>
                                                </tr>
                                                <tr>
                                                    <th style="width: 75%; vertical-align: middle; text-align=right"
                                                        class="heightHr">Sub Total<span class="dividerHr"></span></th>
                                                    <th style="width: 25%; vertical-align: middle; text-align: center"
                                                        class="heightHr center-text" id="sub_total">0</th>
                                                </tr>
                                                <tr>
                                                    <th style="width: 75%; vertical-align: middle; text-align=right"
                                                        class="heightHr">Total Discount<span class="dividerHr"></span>
                                                    </th>
                                                    <th style="width: 25%; vertical-align: middle; text-align: center"
                                                        class="heightHr center-text" id="total_discount">Rp 0</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12 tr-shadow" style="padding: 20px 20px 10px 20px; margin-top: 20px">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group _form-group">
                                                <label for="receive_date" class="font-weight-bold">
                                                    Metode Pembayaran <span class="wajib">* </span>
                                                </label>
                                                <select id="payment_method" name="payment_method" class="custom-select"
                                                    tabindex="2">
                                                    <option value="Tunai">Tunai</option>
                                                    <option value="EDC - BCA">EDC - BCA</option>
                                                    <option value="EDC - QRIS">EDC - QRIS</option>
                                                </select>
                                            </div>
                                            <div id="elm_receipt" class="form-group _form-group"
                                                style="margin-bottom: 10px !important">
                                                <label for="receive_date" class="font-weight-bold">
                                                    Receipt <span class="wajib">* </span>
                                                </label>
                                                <input placeholder="Ex: RCT123456789" name="receipt_no" type="text"
                                                    class="form-control elm_receipt_input"
                                                    style="text-transform:uppercase" readonly tabindex="3" />
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group _form-group elm_cash">
                                                <label for="receive_date" class="font-weight-bold">
                                                    Nominal Tunai
                                                </label>
                                                <input id="tanpa-rupiah" placeholder="Ex: 50000" name="cash" type="text"
                                                    class="form-control elm_cash_input" value="{{ old('cash') }}"
                                                    tabindex="4" />
                                            </div>
                                            <div class="form-group _form-group elm_cash"
                                                style="margin-bottom: 10px !important">
                                                <label for="receive_date" class="font-weight-bold">
                                                    Kembalian
                                                </label>
                                                <input id="kembalian" placeholder="Hitungan otomatis" name="kembalian"
                                                    type="text" class="form-control" readonly
                                                    value="{{ old('kembalian') }}" tabindex="0" />
                                            </div>
                                        </div>

                                        <div class="col-4" style="text-align: right">
                                            <h6>Total</h6>
                                            <h2 id="total_transaction">Rp 0</h2>
                                            {{-- @if(Session::get('receipt'))
                                            ada receipt {{ Session::get('receipt') }}
                                            @endif --}}
                                            <div
                                                style="width: 100%; display: flex; align-items: center; margin-top: 10px">
                                                <button onclick="submit_form('DRAFT')" type="button"
                                                    class="btn btn-success _btn-success px-4"
                                                    style="width: 100%; margin-right:5px" ; tabindex="6">
                                                    SAVE DRAFT
                                                </button>
                                                <button id="btn_delete_1" onblur="onblur_color('1')"
                                                    onfocus="onfocus_color('1')" onclick="submit_form('FINISH')"
                                                    type="button" class="btn btn-primary _btn-primary px-4"
                                                    style="width: 100%" tabindex="6">
                                                    SUBMIT ORDER
                                                </button>
                                                {{-- <a class="btn btn-primary _btn-primary px-4" style="width: 100%"
                                                    href="{{ route('transaction.receipt')}}">SUBMIT ORDER</a> --}}
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
                                <label for="input_user_name" class="font-weight-bold">
                                    Membership ID <span class="wajib">*</span>
                                </label>
                                <input id="input_user_name" value="{{ old('code') }}" name="code" type="text"
                                    class="form-control @error('code') is-invalid @enderror"
                                    placeholder="Input Employee ID.." />
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
                                <input id="input_user_name" value="{{ old('name') }}" name="name" type="text"
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
                                    Phone Number <span class="wajib">*</span>
                                </label>
                                <input id="input_user_name" value="{{ old('phone') }}" name="phone" type="number"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    placeholder="Input Phone Number" />
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
                                <input id="input_user_email" value="{{ old('email') }}" name="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Write email here.." autocomplete="email" />
                                @error('email')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                                <!-- error message -->
                            </div>
                            <!-- end email -->


                        </div>

                        <div class="col-12">
                            <div style="width: 100%; display: flex; align-items: center; justify-content: center;">
                                <a style="width: 50%; margin-right: 5px"
                                    class="btn btn-outline-primary _btn-primary px-4"
                                    href="{{ route('membership.index') }}">Back</a>
                                <button style="width: 50%; margin-left: 5px" type="submit"
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js">
    </script>
    @endpush


    @push('javascript-internal')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        window.onload = function() {
        var input = document.getElementById("input-scanner").focus();
        }
        function printExternal(url) {
            var printWindow = window.open( url, 'Print', 'left=200, top=200, width=950, height=500, toolbar=0, resizable=0');

            printWindow.addEventListener('load', function() {
                if (Boolean(printWindow.chrome)) {
                    printWindow.print();
                    setTimeout(function(){
                        printWindow.close();
                    }, 500);
                } else {
                    printWindow.print();
                    printWindow.close();
                }
            }, true);
        }

        var final_total_price_item = 0;

        $(document).ready(function(e) {
            // @if(Session::has('receipt'))
            //     let url = `{{ route('transaction.receipt', ['transaction' => Session::has('receipt')]) }}`;
            //     console.log('Ada receipt', url);
            // @endif
            // console.log('ready')
            // $("#input-scanner").focus();
        });
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
            // printExternal(url);
            // window.location.href = url
            $("#form-transaction").submit();
        }

        function calculate_vat() {
            calculate_total();
            var total_price_item = 0;
            $('.total_price_item').each(function(i, obj) {
                var price_item = Number($(this).val());
                total_price_item += price_item;
            });
            // var vat_price = total_price_item * (vat_amount / 100);
            // final_total_price_item = total_price_item + vat_price;
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
            $('#input-scanner').val('');
            $('#input-typing').val('');
            removeElements();
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

        function add_product_item(product_code) {
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
                            <p style="text-decoration: line-through; font-size: 12px">${formatRupiah(basic_price.toString())}</p>
                            ${formatRupiah(final_price.toString())}
                        `;
                    }
                    var html_item = `
                        <tr id="${item_id}">
                            <td style="width: 35%; vertical-align: middle">
                                <input id="product_code_${item_id}" name="product_code[]" type="hidden" class="form-control" value="${product.code}" tabindex="0"/>
                                <input id="basic_price_${item_id}" name="basic_price[]" type="hidden" class="form-control" value="${basic_price}" tabindex="0"/>
                                <input id="discount_store_${item_id}" name="discount_store[]" type="hidden" class="form-control" value="${discount_store}" tabindex="0"/>
                                <input id="final_price_${item_id}" name="final_price[]" type="hidden" class="form-control final_price_item" value="${final_price}" tabindex="0"/>
                                <input id="total_price_${item_id}" name="total_price[]" type="hidden" class="form-control total_price_item" value="${final_price}" tabindex="0"/>
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
        });
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
                                text: item.name,
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