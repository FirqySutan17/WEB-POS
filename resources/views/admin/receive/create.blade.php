 @extends('layouts.admin.master')

@section('title')
CMS | Add Receive
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.css') }}">
<link href="{{ asset('assets/css/datepicker.min.css') }}" rel="stylesheet">
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Add Receive</h3>
@endslot
{{ Breadcrumbs::render('add_receive') }}
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
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group _form-group">
                                            <label for="receive_date" class="font-weight-bold">
                                                Receive Date <span class="wajib">* </span>
                                            </label>
                                            <input id="receive_date"
                                                value="{{ empty(old('receive_date')) ? date('Y-m-d') : old('receive_date') }}"
                                                name="receive_date" type="text"
                                                class="form-control @error('receive_date') is-invalid @enderror"
                                                required readonly />
                                            @error('receive_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group _form-group">
                                            <label for="receive_time" class="font-weight-bold">
                                                Receive Time <span class="wajib">* </span>
                                            </label>
                                            <input id="receive_time"
                                                value="{{ empty(old('receive_time')) ? date('H:i') : old('receive_time') }}"
                                                name="receive_time" type="text" value="{{ date('H:i:s') }}"
                                                class="form-control @error('receive_time') is-invalid @enderror"
                                                required readonly />
                                            @error('receive_time')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- title -->
                                <div class="form-group _form-group">
                                    <label for="is_warehouse" class="font-weight-bold">
                                        Stock Taken From <span class="wajib">* </span>
                                    </label>
                                    <select id="is_warehouse" name="is_warehouse" class="form-control">
                                        <option value="0">Delivery</option>
                                        <option value="1">Warehouse</option>
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group _form-group not_warehouse">
                                            <label for="driver" class="font-weight-bold">
                                                Supplier
                                            </label>
                                            <select name="supplier_code" id="select_suppliers">
                                                @foreach ($suppliers as $sp)
                                                <option value="{{ $sp->supplier_code }}">{{ $sp->supplier_code.' |
                                                    '.$sp->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group _form-group not_warehouse">
                                            <label for="driver" class="font-weight-bold">
                                                Driver Name
                                            </label>
                                            <input id="driver" value="{{ old('driver') }}" name="driver" type="text"
                                                class="form-control not_warehouse_input  @error('driver') is-invalid @enderror"
                                                placeholder="Input driver name here" />
                                            @error('driver')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <!-- End Year -->
                                        <div class="form-group _form-group not_warehouse">
                                            <label for="driver_phone" class="font-weight-bold">
                                                Driver Phone Number
                                            </label>
                                            <input id="driver_phone" value="{{ old('driver_phone') }}"
                                                name="driver_phone" type="text"
                                                class="form-control not_warehouse_input @error('driver_phone') is-invalid @enderror"
                                                placeholder="Input Driver Phone Number here" />
                                            @error('driver_phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group _form-group not_warehouse">
                                            <label for="plate_no" class="font-weight-bold">
                                                Vehicle License Number
                                            </label>
                                            <input id="plate_no" value="{{ old('plate_no') }}" name="plate_no"
                                                type="text"
                                                class="form-control not_warehouse_input @error('plate_no') is-invalid @enderror"
                                                placeholder="Input Plat Nomor Kendaraan disini" />
                                            @error('plate_no')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <!-- title -->
                                <div class="form-group _form-group">
                                    <label for="delivery_number" class="font-weight-bold">
                                        Delivery Number <span class="wajib">* </span>
                                    </label>
                                    <input id="delivery_number" value="{{ old('delivery_number') }}"
                                        name="delivery_number" type="text"
                                        class="form-control  @error('delivery_number') is-invalid @enderror"
                                        placeholder="Input surat jalan number here" />
                                    @error('delivery_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- title -->
                                <div class="form-group _form-group">
                                    <label for="input_post_link" class="font-weight-bold">
                                        Delivery File <span class="wajib">* </span>
                                    </label>
                                    <input name="delivery_file" type="file" class="form-control" />
                                    @error('delivery_file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="row req-box">
                                    <div class="col-6">
                                        <p
                                            style="vertical-align: middle; font-weight: 600; color: rgba(0, 0, 0, 0.85); padding: 6px 0px;font-size: 13px">
                                            Product / Item <span class="wajib">*</span></p>
                                        <input id="input-scanner" type="text" class="form-control"
                                            placeholder="Fokuskan kursor kesini untuk scan barcode"
                                            autocomplete="off" />
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
                                    <button onclick="submit_form()" type="button"
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
<script src="{{ asset('assets/js/datepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
@endpush


@push('javascript-internal')

<script>
    $(function() {
        $('#select_suppliers').select2({
            theme: 'bootstrap4',
            language: "{{ app()->getLocale() }}"
        });
    });

    $("#is_warehouse").on('change', function() {
        var val = $("#is_warehouse option:selected").val();
        if (val == "0") {
            $(".not_warehouse").show();
        } else {
            $(".not_warehouse_input").val('');
            $(".not_warehouse").hide();
        }
    });

    function submit_form() {
        $("#form-receive").submit();
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
                $(`#quantity_${item_product}`).val(quantity_product);
                calculate_from_qty(item_product);
            } else {
                add_product_item(product_code);
            }
            $(this).val('');
        }
        
    });

    function calculate_from_qty(item_id) {
        let str_qty = $(`#quantity_${item_id}`).val();
        let qty = Number(str_qty.replace(".", ""));

        let str_unitprice = $(`#unit_price_${item_id}`).val();
        let unitprice = Number(str_unitprice.replace(".", ""));

        let amount = qty * unitprice;
        let str_amount = amount.toString();
        $(`#amount_${item_id}`).val(str_amount);

        console.log(str_qty, qty, str_unitprice, unitprice, str_amount, amount);
    }

    function calculate_from_amount(item_id) {
        let str_qty = $(`#quantity_${item_id}`).val();
        let qty = Number(str_qty.replace(".", ""));

        let str_amount = $(`#amount_${item_id}`).val();
        let amount = Number(str_amount.replace(".", ""));

        let unitprice = Math.round(amount / qty);
        let str_unitprice = unitprice.toString();
        $(`#unit_price_${item_id}`).val(str_unitprice);
    }
    

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
                var html_item = `
                    <div id="${item_id}">
                        <div class="row">
                            <div class="col-5">
                                <div class="form-group _form-group">
                                    <label for="input_post_description" class="font-weight-bold">
                                        Product / Item <span class="wajib">* </span>
                                    </label>
                                    <div class="float-right">
                                        <button onclick="delete_row_product('${item_id}')" type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                                    </div>
                                    <input id="product_code_${item_id}" name="product_code[]" type="hidden" class="form-control" value="${product.code}" />
                                    <input id="product_code_text_${item_id}" type="text" class="form-control" value="${product.code + ' - ' + product.name }" readonly/>
                                </div>
                            </div>
                            <div class="col-1">
                                <div  class="form-group _form-group">
                                    <label for="input_post_description" class="font-weight-bold">
                                        Qty 
                                    </label>
                                    <input data-itemid="${item_id}" id="quantity_${item_id}" name="quantity[]" type="number" class="form-control" value="1" onkeyup="calculate_from_qty('${item_id}')" style="text-align:center;" />
                                </div>
                            </div>
                            <div class="col-2">
                                <div  class="form-group _form-group">
                                    <label for="input_post_description" class="font-weight-bold">
                                        Unit Price <span class="wajib">* </span>
                                    </label>
                                    <input data-itemid="${item_id}" id="unit_price_${item_id}" name="unit_price[]" type="text" class="form-control" value="0" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onkeyup="calculate_from_qty('${item_id}')" style="text-align:right;" required />
                                </div>
                            </div>
                            <div class="col-2">
                                <div  class="form-group _form-group">
                                    <label for="input_post_description" class="font-weight-bold">
                                        Amount <span class="wajib">* </span>
                                    </label>
                                    <input data-itemid="${item_id}" id="amount_${item_id}" name="amount[]" type="text" class="form-control" value="0" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onkeyup="calculate_from_amount('${item_id}')" style="text-align:right;" required />
                                </div>
                            </div>
                            <div class="col-2">
                                <div  class="form-group _form-group">
                                    <label for="input_post_description" class="font-weight-bold">
                                        Expired Date <span class="wajib">* </span>
                                    </label>
                                    <input data-itemid="${item_id}" id="expired_date_${item_id}" name="expired_date[]" type="date" class="form-control" required />
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                $("#product_lists").append(html_item);
            }
        });

    }

    function delete_row_product(eid_item) {
        $("#" + eid_item).remove();
    }
</script>
@endpush