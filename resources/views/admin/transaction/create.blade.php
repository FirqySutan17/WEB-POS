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
            <form id="form-transaction" action="{{ route('transaction.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card _card" style="margin: auto; padding-bottom: 20px">
                    <div class="card-body _card-body">
                        <div class="row d-flex align-items-stretch">
                            <div class="col-md-3 col-sm-12">
                                <div class="row tr-shadow" style="height: 328px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                                    <div class="col-12">
                                        <div class="form-group _form-group">
                                            <label for="receive_date" class="font-weight-bold">
                                                Kasir
                                            </label>
                                            <input value="{{ Auth::user()->name }}" type="text"
                                                class="form-control"
                                                required readonly />
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group _form-group">
                                            <label for="receive_date" class="font-weight-bold">
                                                Tanggal Transaksi
                                            </label>
                                            <input value="{{ date('d-m-Y') }}" class="form-control" required readonly />
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group _form-group">
                                            <label for="invoice_no" class="font-weight-bold">
                                                Nomor Invoice
                                            </label>
                                            <input name="invoice_no" type="text"
                                                value="{{ $no_invoice }}" class="form-control" required readonly />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9 col-sm-12" style="padding-right: 0px">
                                <input id="input-scanner" type="text"
                                    class="form-control"
                                    placeholder="Klik disini untuk Scan Barcode"
                                    style="height: 50px; box-shadow: 0 3px 10px rgb(0 0 0 / 0.2); margin-bottom: 20px; padding-left: 20px " />
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
                                            <select id="payment_method" name="payment_method" class="custom-select">
                                                <option value="Tunai">Tunai</option>
                                                <option value="EDC - BCA">EDC - BCA</option>
                                                <option value="EDC - QRIS">EDC - QRIS</option>
                                            </select>
                                        </div>
                                        <div id="elm_receipt" class="form-group _form-group" style="display:none">
                                            <label for="receive_date" class="font-weight-bold">
                                                Receipt <span class="wajib">* </span>
                                            </label>
                                            <input placeholder="Ex: RCT123456789" name="receipt_no" type="text" class="form-control" required />
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group _form-group elm_cash">
                                            <label for="receive_date" class="font-weight-bold">
                                                Nominal Tunai
                                            </label>
                                            <input id="tanpa-rupiah" placeholder="Ex: 50000" name="cash"
                                                type="text"
                                                class="form-control"
                                                required />
                                        </div>
                                        <div class="form-group _form-group elm_cash">
                                            <label for="receive_date" class="font-weight-bold">
                                                Kembalian
                                            </label>
                                            <input placeholder="Hitungan otomatis"
                                                type="text"
                                                class="form-control"
                                                required readonly />
                                        </div>
                                    </div>

                                    <div class="col-4" style="text-align: right">
                                        <h6>Total</h6>
                                        <h2 id="total_transaction">Rp 0</h2>
                                        <p style="margin-bottom: 0px">*Termasuk PPN 11%</p>
                                        <div style="width: 100%; display: flex; align-items: center; margin-top: 10px">
                                            <button onclick="submit_form()" type="button"
                                                class="btn btn-primary _btn-primary px-4" style="width: 100%">
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
    var vat_amount = parseInt({{ config('app.vat_amount') }});
    function submit_form() {
        $("#form-transaction").submit();
    }

    function calculate_vat() {
        var total_price_item = 0;
        $('.total_price_item').each(function(i, obj) {
            var price_item = Number($(this).val());

            total_price_item += price_item;
        });
        var vat_price = total_price_item * (vat_amount / 100);
        var final_total_price_item = total_price_item + vat_price;
        $("#total_transaction").text(formatRupiah(final_total_price_item.toString()));
    }

    $('#input-scanner').unbind('keyup');
    $('#input-scanner').bind('keyup', function (e) {
        var code = e.keyCode || e.which;
        if (code == 13) {
            var product_code = $(this).val();
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

    function add_product_item(product_code) {
        $.ajax({
            url: "{{ route('product.select_one') }}",
            type: "POST",
            data: {
                "_token": `{{ csrf_token() }}`,
                "product_code": product_code,
            },
            success: function(response) {
                var product = response;
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
                            <input id="product_code_${item_id}" name="product_code[]" type="hidden" class="form-control" value="${product.code}" />
                            <input id="basic_price_${item_id}" name="basic_price[]" type="hidden" class="form-control" value="${basic_price}" />
                            <input id="discount_store_${item_id}" name="discount_store[]" type="hidden" class="form-control" value="${discount_store}" />
                            <input id="final_price_${item_id}" name="final_price[]" type="hidden" class="form-control" value="${final_price}" />
                            <input id="total_price_${item_id}" name="total_price[]" type="hidden" class="form-control total_price_item" value="${final_price}" />
                            ${product.code + ' - ' + product.name}
                        </td>
                        <td style="width: 19%; vertical-align: middle; text-align: center">
                            ${html_price}
                        </td>
                        <td style="width: 6%; vertical-align: middle">
                            <input type="number" id="quantity_${item_id}" name="quantity[]" min="1" style="width: 100%; border-radius: 5px; text-align: center; border: 1px solid #000" value="1" placeholder="1" />
                        </td>
                        <td style="width: 10%; vertical-align: middle; text-align: center">${discount_store}%</td>
                        <td style="width: 15%; vertical-align: middle; text-align: right">Rp <span id="text_final_price_${item_id}">${formatRupiah(final_price.toString())}</span></td>
                        <td style="width: 10%;" class="center-text boxAction fontField trans-icon">
                            <div class="boxInside" style="align-items: center; justify-content: center;">
                                <div class="boxDelete">
                                    <button onclick="delete_row_product('${item_id}')" type="button" class="btn btn-sm btn-danger">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                `;

                $("#product_lists").append(html_item);
                calculate_vat();
                $(`#quantity_${item_id}`).on('keydown', function (e) {
                    var code = e.keyCode || e.which;
                    if (code == 38 || code == 40) {
                        var str_quantity_product = $(this).val();
                        var quantity_product = code == 38 ? parseInt(str_quantity_product) + 1 : parseInt(str_quantity_product) - 1;
                        var final_price = Number($(`#final_price_${item_id}`).val());
                        var total_price = final_price * quantity_product;
                        
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
    }

     /* Tanpa Rupiah */
     var tanpa_rupiah = document.getElementById('tanpa-rupiah');
    tanpa_rupiah.addEventListener('keyup', function(e)
    {
        tanpa_rupiah.value = formatRupiah(this.value);
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
                $("#elm_receipt").hide();
                $(".elm_cash").show();
            } else {
                $(".elm_cash").hide();
                $("#elm_receipt").show();
            }
        });
    });
</script>

<script>
    $(".sub").focusout(function() {
        $("#answer").html('');
        var num1 = $("#num1").val();
        var num2 = $("#num2").val();
        var answer = 100 - num1 - num2;
        $("#answer").html(answer);
    });
</script>
@endpush