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
                            <div class="col-md-3 col-sm-12">
                                <div class="row tr-shadow" style="height: 328px; display: flex; flex-direction: column;              justify-content: center;
                                align-items: center;">
                                    <div class="col-12">
                                        <div class="form-group _form-group">
                                            <label for="receive_date" class="font-weight-bold">
                                                Kasir
                                            </label>
                                            <input id="receive_date" value="John Doe" name="receive_date" type="text"
                                                value="{{ date('Y-m-d') }}"
                                                class="form-control @error('receive_date') is-invalid @enderror"
                                                required readonly />
                                            @error('receive_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group _form-group">
                                            <label for="receive_date" class="font-weight-bold">
                                                Tanggal Transaksi
                                            </label>
                                            <input id="receive_date" value="23-08-2023" name="receive_date" type="text"
                                                value="{{ date('Y-m-d') }}"
                                                class="form-control @error('receive_date') is-invalid @enderror"
                                                required readonly />
                                            @error('receive_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group _form-group">
                                            <label for="receive_date" class="font-weight-bold">
                                                Nomor Invoice
                                            </label>
                                            <input id="receive_date" value="#INV-000001" name="receive_date" type="text"
                                                value="{{ date('Y-m-d') }}"
                                                class="form-control @error('receive_date') is-invalid @enderror"
                                                required readonly />
                                            @error('receive_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9 col-sm-12" style="padding-right: 0px">
                                <input id="input-scanner" type="text"
                                    class="form-control input-scanner @error('suratjalan_number') is-invalid @enderror"
                                    placeholder="Klik disini untuk Scan Barcode"
                                    style="height: 50px; box-shadow: 0 3px 10px rgb(0 0 0 / 0.2); margin-bottom: 20px; padding-left: 20px " />
                                <div class="tr-shadow table-responsive">

                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="center-text" style="width: 5%;">No <span
                                                        class="dividerHr"></span></th>
                                                <th style="width: 30%; vertical-align: middle" class="heightHr">Nama
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
                                        <tbody class="custom-scrollbar">
                                            <tr>
                                                <td style="width: 5%;" class="center-text">1</td>
                                                <td style="width: 30%; vertical-align: middle">Lorem
                                                    Ipsum Dolor Sit
                                                    Amet
                                                </td>
                                                <td style="width: 19%; vertical-align: middle; text-align: center">
                                                    <p style="text-decoration: line-through; font-size: 12px">Rp
                                                        30.000</p>
                                                    Rp 23.000
                                                </td>
                                                <td style="width: 6%; vertical-align: middle">
                                                    <input type="number" min="1"
                                                        style="width: 100%; border-radius: 5px; text-align: center; border: 1px solid #000"
                                                        value="1" placeholder="1" />
                                                </td>
                                                <td style="width: 10%; vertical-align: middle; text-align: center">10%
                                                </td>
                                                <td style="width: 15%; vertical-align: middle; text-align: right">Rp
                                                    200.000</td>
                                                <td style="width: 10%;"
                                                    class="center-text boxAction fontField trans-icon">
                                                    <div class="boxInside"
                                                        style="align-items: center; justify-content: center;">
                                                        {{-- <div class="boxEdit">
                                                            <a href="" class="btn-sm btn-info" role="button">
                                                                <i class="bx bx-edit"></i>
                                                            </a>
                                                        </div> --}}
                                                        <div class="boxDelete">
                                                            <form action="" method="POST" role="alert">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger">
                                                                    <i class="bx bx-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>

                                                    </div>

                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="width: 5%;" class="center-text">2</td>
                                                <td style="width: 30%; vertical-align: middle">Lorem
                                                    Ipsum Dolor Sit
                                                    Amet</td>
                                                <td style="width: 19%; vertical-align: middle; text-align: center">Rp
                                                    23.000</td>
                                                <td style="width: 6%; vertical-align: middle">
                                                    <input type="number" min="1"
                                                        style="width: 100%; border-radius: 5px; text-align: center; border: 1px solid #000"
                                                        value="1" placeholder="1" />
                                                </td>
                                                <td style="width: 10%; vertical-align: middle; text-align: center">10%
                                                </td>
                                                <td style="width: 15%; vertical-align: middle; text-align: right">Rp
                                                    200.000</td>
                                                <td style="width: 10%;"
                                                    class="center-text boxAction fontField trans-icon">
                                                    <div class="boxInside"
                                                        style="align-items: center; justify-content: center;">
                                                        {{-- <div class="boxEdit">
                                                            <a href="" class="btn-sm btn-info" role="button">
                                                                <i class="bx bx-edit"></i>
                                                            </a>
                                                        </div> --}}
                                                        <div class="boxDelete">
                                                            <form action="" method="POST" role="alert">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger">
                                                                    <i class="bx bx-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>

                                                    </div>

                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="width: 5%;" class="center-text">3</td>
                                                <td style="width: 30%; vertical-align: middle">Lorem
                                                    Ipsum Dolor Sit
                                                    Amet</td>
                                                <td style="width: 19%; vertical-align: middle; text-align: center">Rp
                                                    23.000</td>
                                                <td style="width: 6%; vertical-align: middle">
                                                    <input type="number" min="1"
                                                        style="width: 100%; border-radius: 5px; text-align: center; border: 1px solid #000"
                                                        value="1" placeholder="1" />
                                                </td>
                                                <td style="width: 10%; vertical-align: middle; text-align: center">10%
                                                </td>
                                                <td style="width: 15%; vertical-align: middle; text-align: right">Rp
                                                    200.000</td>
                                                <td style="width: 10%;"
                                                    class="center-text boxAction fontField trans-icon">
                                                    <div class="boxInside"
                                                        style="align-items: center; justify-content: center;">
                                                        {{-- <div class="boxEdit">
                                                            <a href="" class="btn-sm btn-info" role="button">
                                                                <i class="bx bx-edit"></i>
                                                            </a>
                                                        </div> --}}
                                                        <div class="boxDelete">
                                                            <form action="" method="POST" role="alert">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger">
                                                                    <i class="bx bx-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>

                                                    </div>

                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="width: 5%;" class="center-text">4</td>
                                                <td style="width: 30%; vertical-align: middle">Lorem
                                                    Ipsum Dolor Sit
                                                    Amet</td>
                                                <td style="width: 19%; vertical-align: middle; text-align: center">
                                                    <p style="text-decoration: line-through; font-size: 12px">Rp
                                                        30.000</p>
                                                    Rp
                                                    23.000
                                                </td>
                                                <td style="width: 6%; vertical-align: middle">
                                                    <input type="number" min="1"
                                                        style="width: 100%; border-radius: 5px; text-align: center; border: 1px solid #000"
                                                        value="1" placeholder="1" />
                                                </td>
                                                <td style="width: 10%; vertical-align: middle; text-align: center">10%
                                                </td>
                                                <td style="width: 15%; vertical-align: middle; text-align: right">Rp
                                                    200.000</td>
                                                <td style="width: 10%;"
                                                    class="center-text boxAction fontField trans-icon">
                                                    <div class="boxInside"
                                                        style="align-items: center; justify-content: center;">
                                                        {{-- <div class="boxEdit">
                                                            <a href="" class="btn-sm btn-info" role="button">
                                                                <i class="bx bx-edit"></i>
                                                            </a>
                                                        </div> --}}
                                                        <div class="boxDelete">
                                                            <form action="" method="POST" role="alert">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger">
                                                                    <i class="bx bx-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>

                                                    </div>

                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="width: 5%;" class="center-text">5</td>
                                                <td style="width: 30%; vertical-align: middle">Lorem
                                                    Ipsum Dolor Sit
                                                    Amet</td>
                                                <td style="width: 19%; vertical-align: middle; text-align: center">Rp
                                                    23.000</td>
                                                <td style="width: 6%; vertical-align: middle">
                                                    <input type="number" min="1"
                                                        style="width: 100%; border-radius: 5px; text-align: center; border: 1px solid #000"
                                                        value="1" placeholder="1" />
                                                </td>
                                                <td style="width: 10%; vertical-align: middle; text-align: center">10%
                                                </td>
                                                <td style="width: 15%; vertical-align: middle; text-align: right">Rp
                                                    200.000</td>
                                                <td style="width: 10%;"
                                                    class="center-text boxAction fontField trans-icon">
                                                    <div class="boxInside"
                                                        style="align-items: center; justify-content: center;">
                                                        {{-- <div class="boxEdit">
                                                            <a href="" class="btn-sm btn-info" role="button">
                                                                <i class="bx bx-edit"></i>
                                                            </a>
                                                        </div> --}}
                                                        <div class="boxDelete">
                                                            <form action="" method="POST" role="alert">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger">
                                                                    <i class="bx bx-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>

                                                    </div>

                                                </td>
                                            </tr>

                                            {{-- <table></table>
                                            <p style="text-align: center; padding-top: 50px;">

                                                <strong> Search not found</strong>

                                                <strong> No data yet</strong>

                                            </p> --}}

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
                                            <select id="select_method_payment" name="skill[]"
                                                data-placeholder="Pilih pembayaran" class="custom-select">
                                                <option value="Tunai">Tunai</option>
                                                <option value="EDC - BCA">EDC - BCA</option>
                                                <option value="EDC - QRIS">EDC - QRIS</option>
                                            </select>
                                        </div>
                                        <div class="form-group _form-group">
                                            <label for="receive_date" class="font-weight-bold">
                                                Receipt <span class="wajib">* </span>
                                            </label>
                                            <input id="receive_date" placeholder="Ex: RCT123456789" name="receive_date"
                                                type="text"
                                                class="form-control @error('receive_date') is-invalid @enderror"
                                                required />
                                            @error('receive_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group _form-group">
                                            <label for="receive_date" class="font-weight-bold">
                                                Nominal Tunai
                                            </label>
                                            <input id="tanpa-rupiah" placeholder="Ex: 50000" name="receive_date"
                                                type="text"
                                                class="form-control @error('receive_date') is-invalid @enderror"
                                                required />
                                            @error('receive_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group _form-group">
                                            <label for="receive_date" class="font-weight-bold">
                                                Kembalian
                                            </label>
                                            <input id="receive_date" placeholder="Hitungan otomatis" name="receive_date"
                                                type="text"
                                                class="form-control @error('receive_date') is-invalid @enderror"
                                                required readonly />
                                            @error('receive_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-4" style="text-align: right">
                                        <h6>Total</h6>
                                        <h2>Rp 300.000,-</h2>
                                        <p style="margin-bottom: 0px">*Termasuk PPN 11%</p>
                                        <div style="width: 100%; display: flex; align-items: center; margin-top: 10px">
                                            {{-- <button onclick="submit_form()" type="button"
                                                class="btn btn-primary _btn-primary px-4" style="width: 100%">
                                                Save
                                            </button> --}}
                                            <a class="btn btn-primary _btn-primary px-4" style="width: 100%"
                                                href="{{ route('transaction.receipt')}}">SUBMIT ORDER</a>
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
    function submit_form() {
        $("#form-receive").submit();
    }
    $(document).ready(function(){
        $("#receive_date").datepicker({
            format: "yyyy-mm-dd",
            autoclose:true
        }); 
    })

     /* Tanpa Rupiah */
     var tanpa_rupiah = document.getElementById('tanpa-rupiah');
    tanpa_rupiah.addEventListener('keyup', function(e)
    {
        tanpa_rupiah.value = formatRupiah(this.value);
    });
    
    /* Dengan Rupiah */
    var dengan_rupiah = document.getElementById('dengan-rupiah');
    dengan_rupiah.addEventListener('keyup', function(e)
    {
        dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
    });
    
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
        $('#select_method_payment').select2({
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