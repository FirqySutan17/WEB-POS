@extends('layouts.admin.master')

@section('title')
CMS | Add Adjustment Stock
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.css') }}">
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Add Adjustment Stock</h3>
@endslot
{{ Breadcrumbs::render('add_cashflow') }}
@endcomponent

<div class="container-fluid">
    <div class="wrap-cashier" style="display: none">
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
    </div>
    <div class="row">
        <div class="col-12">
            <div id="form-authorization" class="card _card" style="width: 60%; margin: auto; padding-bottom: 20px">
                <div class="card-body _card-body">
                    <div class="row d-flex align-items-stretch">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <!-- Phone Number -->
                                    <div class="form-group _form-group">
                                        <label for="input_user_pin" class="font-weight-bold">
                                            PIN <span class="wajib">*</span>
                                        </label>
                                        <input id="confirmation-pin" style="height: 50px; font-size: 20px"
                                            type="password" class="form-control"
                                            placeholder="Insert Supervisor PIN here" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div style="width: 100; display: flex; align-items: center; justify-content: center;">
                                <a style="width: 50%; margin-right: 5px"
                                    class="btn btn-outline-primary _btn-primary px-4"
                                    href="{{ route('adjust_stock.index') }}">Back</a>
                                <button id="btn-authorize" style="width: 50%; margin-left: 5px" type="button"
                                    class="btn btn-primary _btn-primary px-4">
                                    Authorize
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <form id="form-add" action="{{ route('adjust_stock.store') }}" method="POST" enctype="multipart/form-data"
                style="display: none">
                @csrf
                <div class="card _card" style="width: 60%; margin: auto; padding-bottom: 20px">
                    <div class="card-body _card-body">
                        <div class="row d-flex align-items-stretch">
                            <input type="hidden" name="approval" id="approval">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group _form-group">
                                                    <label for="date" class="font-weight-bold">
                                                        Tanggal <span class="wajib">* </span>
                                                    </label>
                                                    <input id="date"
                                                        value="{{ empty(old('date')) ? date('Y-m-d') : old('date') }}"
                                                        name="date" type="text"
                                                        class="form-control @error('date') is-invalid @enderror"
                                                        required readonly />
                                                    @error('date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group _form-group">
                                                    <label for="time" class="font-weight-bold">
                                                        Waktu <span class="wajib">* </span>
                                                    </label>
                                                    <input id="time"
                                                        value="{{ empty(old('time')) ? date('H:i') : old('time') }}"
                                                        name="time" type="text" value="{{ date('H:i:s') }}"
                                                        class="form-control @error('time') is-invalid @enderror"
                                                        required readonly />
                                                    @error('time')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <!-- name -->
                                                <div class="form-group _form-group">
                                                    <label for="input_user_name" class="font-weight-bold">
                                                        Cashier <span class="wajib">*</span>
                                                    </label>
                                                    <input type="hidden" name="employee_id"
                                                        value="{{ Auth::user()->employee_id }}">
                                                    <input id="input_user_name" value="{{ Auth::user()->name }}"
                                                        type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        readonly />
                                                    @error('name')
                                                    <span class="invalid-feedback">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                    <!-- error message -->
                                                </div>
                                                <!-- end name -->
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group _form-group">
                                                    <label for="select_adj_type" class="font-weight-bold">
                                                        Adjustment Type <span class="wajib">*</span>
                                                    </label>
                                                    <select id="select_adj_type" class="form-control" name="type">
                                                        <option value="IN">Barang Masuk</option>
                                                        <option value="OUT">Barang Keluar</option>
                                                    </select>
                                                    @error('product_code')
                                                    <span class="invalid-feedback">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group _form-group">
                                            <label for="select_product" class="font-weight-bold">
                                                Product <span class="wajib">*</span>
                                            </label>
                                            <select id="select_product" name="product_code"
                                                data-placeholder="Choose products"
                                                class="js-example-placeholder-multiple">
                                            </select>
                                            @error('product_code')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>

                                        <!-- Phone Number -->
                                        <div class="form-group _form-group">
                                            <label for="input_qty" class="font-weight-bold">
                                                QTY <span class="wajib">*</span>
                                            </label>
                                            <input id="input_qty" value="{{ old('qty') }}"
                                                style="height: 50px; font-size: 20px" name="qty" type="text"
                                                class="form-control @error('qty') is-invalid @enderror"
                                                onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                placeholder="0" />
                                            @error('qty')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                            <!-- error message -->
                                        </div>
                                        <!-- end name -->
                                        <div class="form-group _form-group">
                                            <label for="input_remark" class="font-weight-bold">
                                                Remark <span class="wajib">* </span>
                                            </label>
                                            <textarea id="input_remark" name="remark"
                                                placeholder="Write description here.."
                                                class="form-control @error('remark') is-invalid @enderror"
                                                rows="8">{{ old('remark') }}</textarea>
                                            @error('remark')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">

                            <div class="col-12">
                                <div style="width: 100; display: flex; align-items: center; justify-content: center;">
                                    <a style="width: 50%; margin-right: 5px"
                                        class="btn btn-outline-primary _btn-primary px-4"
                                        href="{{ route('adjust_stock.index') }}">Back</a>
                                    <button id="btn-save" style="width: 50%; margin-left: 5px" type="button"
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
<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
@endpush

@push('javascript-internal')


<script>
    let chance = 0;
    $("#btn-save").click(function() {
        Swal.fire({
            title: `Do you want to save this adjustment ?`,
            showCancelButton: true,
            confirmButtonText: 'Yes',
            denyButtonText: 'No',
            icon: 'question',
            customClass: {
                actions: 'my-actions',
                cancelButton: 'order-1 right-gap',
                confirmButton: 'order-2',
            }
            }).then((result) => {
            if (result.isConfirmed) {
                $("#form-add").submit();
            }
        })
    });
    $('#btn-authorize').click(function() {
        let pin = $("#confirmation-pin").val();
        let url = "{{ route('cashflow.index') }}";
        $.ajax({
            url: "{{ route('transaction.checksvppin') }}",
            type: "POST",
            data: {
                "_token": `{{ csrf_token() }}`,
                "pin": pin,
            },
            beforeSend: function () {
            },
            success: function(response) {
                if (JSON.stringify(response) === "{}") {
                    chance += 1;
                    if (chance >= 3) {
                        setTimeout(() => {
                            window.open(url, '_self');
                        }, 3000);
                        return Swal.fire({
                            title: 'Oops...',
                            text: `Wrong PIN Number! You already try ${chance}x and will be moved to index`,
                            icon: 'error'
                        });
                    }
                    
                    return Swal.fire({
                        title: 'Oops...',
                        text: `Wrong PIN Number! You already try ${chance}x`,
                        icon: 'error'
                    });
                }

                $("#approval").val(pin);
                $("#form-authorization").remove();
                Swal.fire({
                    title: 'Success',
                    text: `Authorized!`,
                    icon: 'success'
                });
                $("#form-add").show();
                $(".wrap-cashier").show();
            }
        });
    });

    $(function() {
        $('#select_adj_type').select2({
            theme: 'bootstrap4',
            language: "{{ app()->getLocale() }}"
        });
        $('#select_product').select2({
            theme: 'bootstrap4',
            language: "{{ app()->getLocale() }}",
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
    });
</script>
@endpush