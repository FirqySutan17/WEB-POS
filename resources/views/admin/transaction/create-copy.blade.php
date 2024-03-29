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

    .select2-container.select-product-custom .select2-selection--single {
        height: 50px !important;
        box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
    }

    .select2-container--bootstrap4.select-product-custom .select2-selection--single .select2-selection__placeholder {
        font-size: 16px;
        padding: 10px;
    }

    .select2-container--bootstrap4.select-product-custom .select2-selection--single .select2-selection__rendered {
        margin-top: 6px;
        margin-left: 0px
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

        <div class="info-disc">
            <div class="button-container">
                <button id="click" class="btn-disc">
                    <i class='bx bx-x' style="font-size: 18px; display: inline-block; vertical-align: middle"></i>
                </button>
            </div>
            {{-- <div id="element">
                @if (!empty($product_discount))
                <ul>
                    @foreach ($product_discount as $item)
                    <li><span class="m-2">{{ $item->name." - DISC ".$item->discount_store."%" }}</span></li>
                    @endforeach
                </ul>
                @endif
            </div> --}}
        </div>
        @endif
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
                    <input name="invoice_no" type="hidden" value="{{ $no_invoice }}" required readonly tabindex="0" />
                    <input id="input_status" type="hidden" name="status" value="FINISH">
                    <div class="card" style="margin: auto;">
                        <div class="card-body _card-body">
                            <div class="row d-flex align-items-stretch">
                                <div class="col-md-12">
                                    <div class="row" style="padding: 5px 0px 10px 0px; font-weight: 600;">
                                        <div class="col-2" style="margin: auto">
                                            Kasir : {{ Auth::user()->name }}
                                        </div>
                                        <div class="col-2" style="margin: auto">
                                            Tanggal : {{ date('d-m-Y') }}
                                        </div>
                                        <div class="col-8" style="float: right; text-align: right">
                                            I-Sales : &nbsp;
                                            <label class="switch media-body text-end icon-state"
                                                style="vertical-align: middle">
                                                <input type="checkbox" id="is_isales" name="is_isales" {{
                                                    old("is_isales")==1 ? "checked" : null }}><span
                                                    class="switch-state"></span>
                                            </label>
                                            <!-- <div class="media-body text-end icon-state">
                                                
                                             </div> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9 col-sm-12" style="padding-left: 0px">
                                    <div class="tr-input">
                                        <div class="row">
                                            <div class="col-4">
                                                <input id="input-scanner" type="text" class="form-control"
                                                    placeholder="Klik disini untuk Scan Barcode"
                                                    style="height: 50px; box-shadow: 0 3px 10px rgb(0 0 0 / 0.2); margin-bottom: 20px; padding-left: 20px "
                                                    tabindex="1" autofocus />
                                            </div>
                                            <div class="col-4">
                                                {{-- <input type="text" id="input-typing"
                                                    placeholder="Cari barang manual disini" class="form-control"
                                                    tabindex="2"
                                                    style="height: 50px; box-shadow: 0 3px 10px rgb(0 0 0 / 0.2); margin-bottom: 20px; padding-left: 20px " />
                                                --}}
                                                <div class="form-group  _form-group">
                                                    {{-- <label for="select_product" class="font-weight-bold">
                                                        Categories <span class="wajib">*</span>
                                                    </label> --}}
                                                    <select id="select_product" name="product"
                                                        data-placeholder="Cari barang manual disini"
                                                        class="custom-select">

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                {{-- <input type="text" id="input-typing"
                                                    placeholder="Cari barang manual disini" class="form-control"
                                                    tabindex="2"
                                                    style="height: 50px; box-shadow: 0 3px 10px rgb(0 0 0 / 0.2); margin-bottom: 20px; padding-left: 20px " />
                                                --}}
                                                <div class="form-group  _form-group">
                                                    {{-- <label for="select_product" class="font-weight-bold">
                                                        Categories <span class="wajib">*</span>
                                                    </label> --}}
                                                    <select id="select_free_product" name="product"
                                                        data-placeholder="Pilih item gratis disini.."
                                                        class="custom-select">
                                                        <option></option>
                                                        <option value="8801007499482">8801007499482 | SEAWEED CRISPS
                                                        </option>
                                                        <option value="8801007499567">8801007499567 | SEAWEED CRISPS HOT
                                                            SPICY FLAVOR
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="list stay-hidden"></ul>
                                    </div>

                                    <div class="tr-shadow table-responsive" style="padding: 10px 10px 20px 10px">
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
                                                        class="heightHr center-text">Disc
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

                                        </table>
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-12">

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
                                                    Sub Disc
                                                </label>
                                                <h6 id="total_discount" style="text-align: right; width: 70%">0</h6>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row tr-shadow" style="margin-bottom: 10px; height: 130px">
                                        <div class="col-12" style="margin: auto">
                                            <h5 style="text-align: right">Grand Total</h5>
                                            <h2 id="total_transaction"
                                                style="text-align: right; font-size: 46px; font-weight: 800; margin-bottom: 0px">
                                                Rp 0</h2>
                                        </div>
                                    </div>


                                    <div class="row tr-shadow"
                                        style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                                        <div class="col-12">
                                            <div class="form-group _form-group"
                                                style="display: flex; margin-bottom: 10px; justify-content: center; align-items: center;">
                                                <label for="receive_date" class="font-weight-bold" style="width: 45%">
                                                    Metode
                                                </label>
                                                <select id="payment_method" name="payment_method" class="custom-select"
                                                    tabindex="2">
                                                    <option value="Tunai">Tunai</option>
                                                    <option value="EDC - BCA">EDC - BCA</option>
                                                    <option value="EDC - QRIS">EDC - QRIS</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <div class="form-group _form-group"
                                                style="display: flex; margin-bottom: 10px; justify-content: center; align-items: center;">
                                                <label for="receive_date" class="font-weight-bold" style="width: 45%">
                                                    Tunai
                                                </label>
                                                <input id="tanpa-rupiah" placeholder="Ex: 50000" name="cash" type="text"
                                                    class="form-control elm_cash_input" value="{{ old('cash') }}"
                                                    tabindex="4" style="text-align: right" />
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group _form-group"
                                                style="display: flex; margin-bottom: 0px; margin-bottom: 5px; justify-content: center; align-items: center;">
                                                <label for="receive_date" class="font-weight-bold" style="width: 45%">
                                                    Kembalian
                                                </label>
                                                <input id="kembalian" placeholder="Hitungan otomatis" name="kembalian"
                                                    type="text" class="form-control" readonly
                                                    value="{{ old('kembalian') }}" tabindex="0"
                                                    style="text-align: right" />
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

                                            <!-- role -->
                                            <div class="form-group _form-group">
                                                <label for="select_membership" class="font-weight-bold"
                                                    style="width: 100%">
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
                                <label for="input_membership_id" class="font-weight-bold">
                                    Membership ID <span class="wajib">*</span>
                                </label>
                                <input id="input_membership_id" type="text" class="form-control input_membership"
                                    placeholder="Auto Generate" readonly />
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
        $('#is_isales').on('change', function(){
            this.value = this.checked ? 1 : 0;
            show_discount(this.value);
         });
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
            // @endif
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
            cash_input = cash_input.replace(",", "");
            let cash_amount = Number(cash_input.replace(".", ""));

            // let total_price_item = 0;
            // $('.total_price_item').each(function(i, obj) {
            //     var price_item = Number($(this).val());
            //     total_price_item += price_item;
            // });
            var total_discount  = 0;
            var total_qty       = 0;
            var sub_total       = 0;
            $('.final_price_item').each(function(i, obj) {
                var id = $(this).attr('id').split("_");
                var item_id = "item_product_" + id[4];
                var final_price_item = Number($(this).val());
                var basic_price_item = Number($(`#basic_price_${item_id}`).val());
                var quantity_item = Number($(`#quantity_${item_id}`).val());
                var discount = Number($(`#discount_store_${item_id}`).val());
                var sub_total_item = final_price_item * quantity_item;
                if (final_price_item != basic_price_item) {
                    discount = basic_price_item - final_price_item;
                }

                var checkBox = document.getElementById("is_isales");
                if (checkBox.checked == false) {
                    discount = 0;
                }
                total_discount += discount * quantity_item;
                total_qty += quantity_item;
                sub_total += sub_total_item;

                
            });

            var grand_total = sub_total - total_discount;
            if ((status == 'FINISH' && payment_method.toUpperCase() == 'TUNAI') && grand_total > cash_amount) {
                return Swal.fire({
                    title: 'Oops...',
                    text: 'Uang tunai kurang dari total belanja',
                    icon: 'error'
                });
            }

            if (status == 'FINISH' && payment_method.toUpperCase() != 'TUNAI' && $(".elm_receipt_input").val() == "") {
                return Swal.fire({
                    title: 'Oops...',
                    text: 'Nomor Receipt wajib diisi',
                    icon: 'error'
                });
            }
            // printExternal(url);
            // window.location.href = url
            $("#form-transaction").submit();
        }

        function store_to_display() {

            var checkBox = document.getElementById("is_isales");
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
                if (checkBox.checked == false) {
                    return 0;
                }
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

            // <input id="product_code_${item_id}" name="product_code[]" type="hidden" class="form-control" value="${product.code}" tabindex="0"/>
            // <input id="basic_price_${item_id}" name="basic_price[]" type="hidden" class="form-control" value="${basic_price}" tabindex="0"/>
            // <input id="discount_store_${item_id}" name="discount_store[]" type="hidden" class="form-control" value="${discount_store}" tabindex="0"/>
            // <input id="final_price_${item_id}" name="final_price[]" type="hidden" class="form-control final_price_item" value="${final_price}" tabindex="0"/>
            // <input id="total_price_${item_id}" name="total_price[]" type="hidden" class="form-control total_price_item" value="${final_price}" tabindex="0"/>
            // <input type="number" id="quantity_${item_id}" name="quantity[]" min="0" style="width: 100%; border-radius: 5px; text-align: center; border: 1px solid #000" value="1" placeholder="1" tabindex="1" />
            $.ajax({
                url: "{{ route('transaction.itemdisplay_store') }}",
                type: "POST",
                data: {
                    "_token": `{{ csrf_token() }}`,
                    "product_code": product_code,
                    "product_name": product_name,
                    "basic_price": basic_price,
                    "discount_store": discount_store,
                    "final_price": final_price,
                    // "total_price": total_price,
                    "quantity": quantity,
                },
                success: function(response) {
                   console.log("STORE TO DISPLAY", response)
                }
            });
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
                if (id[3] != "free") {
                    var item_id = "item_product_" + id[4];
                    var final_price_item = Number($(this).val());
                    var is_free_data = $("#is_free_" + item_id).val();
                    console.log(id, item_id, is_free_data);
                    var basic_price_item = Number($(`#basic_price_${item_id}`).val());
                    var quantity_item = Number($(`#quantity_${item_id}`).val());
                    var discount = Number($(`#discount_store_${item_id}`).val());
                    var sub_total_item = final_price_item * quantity_item;
                    if (final_price_item != basic_price_item) {
                        discount = basic_price_item - final_price_item;
                    }
                    var checkBox = document.getElementById("is_isales");
                    if (checkBox.checked == false) {
                        discount = 0;
                    }
                    total_discount += discount * quantity_item;
                    total_qty += quantity_item;
                    sub_total += sub_total_item;
                }

            });
            $("#total_discount").text(formatRupiah(total_discount.toString()));
            $("#sub_total").text(formatRupiah(sub_total.toString()));
            $("#total_qty").text(total_qty);

            var total_price_item = 0;
            $('.total_price_item').each(function(i, obj) {
                var price_item = Number($(this).val());
                total_price_item += price_item;
            });
            var grand_total = sub_total - total_discount;
            $("#total_transaction").text(formatRupiah(grand_total.toString()));
        }

        $('#input-scanner').unbind('keyup');
        $('#input-scanner').bind('keyup', function (e) {
            var code = e.keyCode || e.which;
            if (code == 13) {
                proceed_enter();
            }
            
        });

        function show_discount(is_isales) {
            $(".discount_store").each(function(i, obj) {
                var id = $(this).attr('id').split("_");
                var item_id = "item_product_" + id[4];
                var discount_store = parseInt($(this).val());

                if (is_isales == 0) {
                    discount_store = 0;
                }
                $("#discount_" + item_id).text(discount_store);
                // var item_id = id[]
            });
            calculate_vat();
        }

        function displayNames(value, text) {
            $("#input-typing").val(value);
            proceed_enter();
        }

        function proceed_enter(is_free = 0) {
            if (is_free == 1) {
                var product_code = $('#select_free_product').val().trim();
                var item_product = "item_free_product_" + product_code
            } else {
                var product_code = $('#input-scanner').val().trim() == '' ? $('#select_product').val().trim() : $('#input-scanner').val().trim();
                var item_product = "item_product_" + product_code;
            }
            if ($(`#${item_product}`).length > 0) {
                var str_quantity_product = $(`#quantity_${item_product}`).val();
                var quantity_product = parseInt(str_quantity_product) + 1;
                var final_price = Number($(`#final_price_${item_product}`).val()) * quantity_product;
                
                $(`#quantity_${item_product}`).val(quantity_product);
                $(`#total_price_${item_product}`).val(final_price);
                $(`#text_final_price_${item_product}`).text(formatRupiah(final_price.toString()));
                if (is_free == 0) {
                    calculate_vat();
                }
            } else {
                add_product_item(product_code, is_free);
            }
        }

        function clearInputItem() {
            $('#input-scanner').val('');
            $('#select_product').val(null).trigger('change');
            $('#select_free_product').val(null).trigger('change');
        }

        function add_product_item(product_code, is_free = 0) {
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
                    if (is_free == 1) {
                        item_id = "item_free_product_" + id;

                        var basic_price = 0;
                        var final_price = 0;
                        var html_price = formatRupiah("0");
                        var discount_store = 0;
                        var discount_price = 0;
                        product.price_store = 0;

                    } else {
                        var basic_price = product.price_store;
                        var final_price = basic_price;
                        var html_price = formatRupiah(final_price.toString());
                        var discount_store = (product.discount_store) ? product.discount_store : 0;
                        var discount_price = 0;

                        var checkBox = document.getElementById("is_isales");
                        if (discount_store > 0 && checkBox.checked !== false) {
                            discount_price = discount_store;
                        }
                    }

                    

                    var html_item = `
                        <tr id="${item_id}">
                            <td style="width: 35%; vertical-align: middle">
                                <input id="is_free_${item_id}" name="is_free[]" type="hidden" class="form-control" value="${is_free}" tabindex="0"/>
                                <input id="product_code_${item_id}" name="product_code[]" type="hidden" class="form-control" value="${product.code}" tabindex="0"/>
                                <input id="product_name_${item_id}" name="product_name[]" type="hidden" class="form-control" value="${product.name}" tabindex="0"/>
                                <input id="basic_price_${item_id}" name="basic_price[]" type="hidden" class="form-control" value="${basic_price}" tabindex="0"/>
                                <input id="discount_store_${item_id}" name="discount_store[]" type="hidden" class="form-control discount_store" value="${discount_store}" tabindex="0"/>
                                <input id="final_price_${item_id}" name="final_price[]" type="hidden" class="form-control final_price_item" value="${final_price}" tabindex="0"/>
                                <input id="total_price_${item_id}" name="total_price[]" type="hidden" class="form-control total_price_item" value="${final_price}" tabindex="0"/>
                                ${product.code + ' | ' + product.name}
                            </td>
                            
                            <td style="width: 19%; vertical-align: middle; text-align: center">
                                ${product.price_store}
                            </td>
                            <td style="width: 6%; vertical-align: middle">
                                <input type="number" id="quantity_${item_id}" name="quantity[]" min="0" style="width: 100%; border-radius: 5px; text-align: center; border: 1px solid #000" value="1" placeholder="1" tabindex="1" />
                            </td>
                            <td class="disc_class" style="width: 10%; vertical-align: middle; text-align: center" id="discount_${item_id}">${discount_price}</td>
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
            var total_discount  = 0;
            var total_qty       = 0;
            var sub_total       = 0;
            $('.final_price_item').each(function(i, obj) {
                var id = $(this).attr('id').split("_");
                if (id[3] != "free") {
                    var item_id = "item_product_" + id[4];
                    var final_price_item = Number($(this).val());
                    var basic_price_item = Number($(`#basic_price_${item_id}`).val());
                    var quantity_item = Number($(`#quantity_${item_id}`).val());
                    var discount = Number($(`#discount_store_${item_id}`).val());
                    var sub_total_item = final_price_item * quantity_item;
                    if (final_price_item != basic_price_item) {
                        discount = basic_price_item - final_price_item;
                    }

                    var checkBox = document.getElementById("is_isales");
                    if (checkBox.checked == false) {
                        discount = 0;
                    }
                    total_discount += discount * quantity_item;
                    total_qty += quantity_item;
                    sub_total += sub_total_item;
                }
            });

            var grand_total = sub_total - total_discount;

            var total_price_item = 0;
            $('.total_price_item').each(function(i, obj) {
                var price_item = Number($(this).val());
                total_price_item += price_item;
            });

            var kembali = grand_total - nominal_number;
            if (nominal_number >= grand_total) {
                kembalian.value = formatRupiah(kembali.toString());
            }
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
                if (val == "Tunai") {
                    // $("#elm_receipt").hide();
                    $(".elm_receipt_input").prop('readonly', true);
                    $(".elm_receipt_input").prop('required', false);
                    // $(".elm_cash").show();
                    $(".elm_cash_input").prop('readonly', false);
                } else {
                    // $(".elm_cash").hide();
                    $(".elm_cash_input").prop('readonly', true);
                    // $("#elm_receipt").show();
                    $(".elm_receipt_input").prop('readonly', false);
                    $(".elm_receipt_input").prop('required', true);
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
                                    text: item.code + " | " + item.name + " | " + item.phone,
                                    phone: item.phone,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            });

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

            $('#select_free_product').select2({
                theme: 'bootstrap4 select-product-custom',
                language: "",
                placeholder: "Pilih item gratis disini..",
                allowClear: true
            });

            $("#select_free_product").on('change', function() {
                if ($("#select_free_product").val()) {
                    proceed_enter(1);
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
        $("#add_member").on('click', function() {
            let name    = $("#input_membership_name").val().trim();
            let phone   = $("#input_membership_phone").val().trim();
            let email   = $("#input_membership_email").val().trim();

            if (name == '' || phone == '' || email == '') {
            } else {
                $.ajax({
                    url: "{{ route('transaction.addmember') }}",
                    type: "POST",
                    data: {
                        "_token": `{{ csrf_token() }}`,
                        "name": name,
                        "phone": phone,
                        "email": email
                    },
                    beforeSend: function () {
                    },
                    success: function(response) {
                        if (response.status == 'failed') {
                            return Swal.fire({
                                title: 'Oops...',
                                text: response.message,
                                icon: 'error'
                            });
                        }

                        $(".close").trigger('click');
                    }
                });
            }
        });

        function addMembers() {
            $(".input_membership").val('');
            $("#modal-add-membership").modal('show');
        }

        $('.close').on('click', function () {
            $('#modal-add-membership').removeClass("show");
            $('#modal-add-membership').modal("hide");
        });
    </script>

    <script>
        $('.close').on('click', function () {
        $('#modal-detail-print').removeClass("show");
        $('#modal-detail-print').modal("hide");
        });
    </script>



    @endpush