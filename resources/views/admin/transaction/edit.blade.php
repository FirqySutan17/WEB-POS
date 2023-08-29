@extends('layouts.admin.master')

@section('title')
CMS | Transaction
@endsection

@push('css')
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}"> --}}
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
            <form id="form-transaction" action="{{ route('transaction.update', ['transaction' => $transaction]) }}" method="POST"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <input id="input_status" type="hidden" name="status" value="FINISH">
                <div class="card _card" style="margin: auto; padding-bottom: 20px">
                    <div class="card-body _card-body">
                        <div class="row d-flex align-items-stretch">
                            <div class="col-md-3 col-sm-12">
                                <div class="row tr-shadow"
                                    style="height: 328px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                                    <div class="col-12">
                                        <div class="form-group _form-group">
                                            <label for="receive_date" class="font-weight-bold">
                                                Kasir
                                            </label>
                                            <input value="{{ Auth::user()->name }}" type="text" class="form-control"
                                                required readonly tabindex="0"/>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group _form-group">
                                            <label for="receive_date" class="font-weight-bold">
                                                Tanggal Transaksi
                                            </label>
                                            <input value="{{ $transaction->trans_date }}" class="form-control" required readonly tabindex="0"/>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group _form-group">
                                            <label for="invoice_no" class="font-weight-bold">
                                                Nomor Invoice
                                            </label>
                                            <input name="invoice_no" type="text" value="{{ $transaction->invoice_no }}"
                                                class="form-control" required readonly tabindex="0"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9 col-sm-12" style="padding-right: 0px">
                                <marquee width="100%" direction="left">
                                    @if (!empty($product_discount))
                                        @foreach ($product_discount as $item)
                                        <span class="m-2">{{ $item->name." DISC ".$item->discount_store."%" }}</span>
                                        @endforeach
                                    @endif
                                </marquee>
                                <input id="input-scanner" type="text" class="form-control"
                                    placeholder="Klik disini untuk Scan Barcode"
                                    style="height: 50px; box-shadow: 0 3px 10px rgb(0 0 0 / 0.2); margin-bottom: 20px; padding-left: 20px " tabindex="1" />
                                <div class="tr-shadow table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width: 35%; vertical-align: middle" class="heightHr">Nama
                                                    Item <span class="dividerHr"></span></th>
                                                <th style="width: 19%; vertical-align: middle; text-align: center"
                                                    class="heightHr center-text">Harga <span class="dividerHr"></span>
                                                </th>
                                                <th style="width: 6%; vertical-align: middle"
                                                    class="heightHr center-text">Qty <span class="dividerHr"></span>
                                                </th>
                                                <th style="width: 10%; vertical-align: middle; text-align: center"
                                                    class="heightHr center-text">Disc (%)
                                                    <span class="dividerHr"></span>
                                                </th>
                                                <th style="width: 15%; vertical-align: middle; text-align: right"
                                                    class="heightHr center-text">Total <span class="dividerHr"></span>
                                                </th>
                                                <th style="width: 10%;" class="center-text"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="product_lists" class="custom-scrollbar">
                                        </tbody>
                                        <thead>
                                            <tr>
                                                <th style="width: 75%; vertical-align: middle; text-align=right" class="heightHr">Total QTY<span class="dividerHr"></span></th>
                                                <th style="width: 25%; vertical-align: middle; text-align: center" class="heightHr center-text" id="total_qty">0</th>
                                            </tr>
                                            <tr>
                                                <th style="width: 75%; vertical-align: middle; text-align=right" class="heightHr">Sub Total<span class="dividerHr"></span></th>
                                                <th style="width: 25%; vertical-align: middle; text-align: center" class="heightHr center-text" id="sub_total">0</th>
                                            </tr>
                                            <tr>
                                                <th style="width: 75%; vertical-align: middle; text-align=right" class="heightHr">Total Discount<span class="dividerHr"></span></th>
                                                <th style="width: 25%; vertical-align: middle; text-align: center" class="heightHr center-text" id="total_discount">Rp 0</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div class="col-12 tr-shadow" style="margin-top: 20px">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group _form-group">
                                            <label for="receive_date" class="font-weight-bold">
                                                Metode Pembayaran <span class="wajib">* </span>
                                            </label>
                                            <select id="payment_method" name="payment_method" class="custom-select" tabindex="2">
                                                <option value="Tunai">Tunai</option>
                                                <option value="EDC - BCA">EDC - BCA</option>
                                                <option value="EDC - QRIS">EDC - QRIS</option>
                                            </select>
                                        </div>
                                        <div id="elm_receipt" class="form-group _form-group">
                                            <label for="receive_date" class="font-weight-bold">
                                                Receipt <span class="wajib">* </span>
                                            </label>
                                            <input placeholder="Ex: RCT123456789" name="receipt_no" type="text"
                                                class="form-control elm_receipt_input" readonly tabindex="3" />
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group _form-group elm_cash">
                                            <label for="receive_date" class="font-weight-bold">
                                                Nominal Tunai
                                            </label>
                                            <input id="tanpa-rupiah" placeholder="Ex: 50000" name="cash" type="text"
                                                class="form-control elm_cash_input" tabindex="4" />
                                        </div>
                                        <div class="form-group _form-group elm_cash">
                                            <label for="receive_date" class="font-weight-bold">
                                                Kembalian
                                            </label>
                                            <input id="kembalian" placeholder="Hitungan otomatis" type="text" class="form-control" disabled tabindex="0"/>
                                        </div>
                                    </div>

                                    <div class="col-4" style="text-align: right">
                                        <h6>Total</h6>
                                        <h2 id="total_transaction">Rp 0</h2>
                                        <p style="margin-bottom: 0px">*Termasuk PPN 11%</p>
                                        <div style="width: 100%; display: flex; align-items: center; margin-top: 10px">
                                            <button id="btn_delete_1" onblur="onblur_color('1')" onfocus="onfocus_color('1')" onclick="submit_form('FINISH')" type="button"
                                                class="btn btn-primary _btn-primary px-4" style="width: 100%" tabindex="6">
                                                FINISH ORDER
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush


@push('javascript-internal')
<script>
    $(function() {
        console.log('DOCUMENT READY');
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
        $("#form-transaction").submit();
    }

    function calculate_vat() {
        calculate_total();
        var total_price_item = 0;
        $('.total_price_item').each(function(i, obj) {
            var price_item = Number($(this).val());
            total_price_item += price_item;
        });
        var vat_price = total_price_item * (vat_amount / 100);
        final_total_price_item = total_price_item + vat_price;
        $("#total_transaction").text(formatRupiah(final_total_price_item.toString()));
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
            total_discount += discount;
            total_qty += quantity_item;
            sub_total += sub_total_item;
        });
        $("#total_discount").text(formatRupiah(total_discount.toString()));
        $("#sub_total").text(formatRupiah(sub_total.toString()));
        $("#total_qty").text(total_qty);
    }

    $('#input-scanner').unbind('keyup');
    $('#input-scanner').bind('keyup', function (e) {
        var code = e.keyCode || e.which;
        if (code == 13) {
            var product_code = $(this).val().trim();
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
            
            $(this).val('');
        }
        
    });

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
                            ${product.code + ' - ' + product.name}
                        </td>
                        <td style="width: 19%; vertical-align: middle; text-align: center">
                            ${html_price}
                        </td>
                        <td style="width: 6%; vertical-align: middle">
                            <input type="number" id="quantity_${item_id}" name="quantity[]" min="0" style="width: 100%; border-radius: 5px; text-align: center; border: 1px solid #000" value="${qty}" placeholder="1" tabindex="1" />
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

        var kembali = final_total_price_item - nominal_number;
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
@endpush