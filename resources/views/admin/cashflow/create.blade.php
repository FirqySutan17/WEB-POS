@extends('layouts.admin.master')

@section('title')
CMS | Add Cashflow
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.css') }}">
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Add Cashflow</h3>
@endslot
{{ Breadcrumbs::render('add_cashflow') }}
@endcomponent

<div class="container-fluid">
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
                                        <label for="input_user_cash" class="font-weight-bold">
                                            PIN <span class="wajib">*</span>
                                        </label>
                                        <input id="confirmation-pin"
                                            style="height: 50px; font-size: 20px" name="cash" type="password"
                                            class="form-control"
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
                                    href="{{ route('cashflow.index') }}">Back</a>
                                <button id="btn-authorize" style="width: 50%; margin-left: 5px" type="button"
                                    class="btn btn-primary _btn-primary px-4">
                                    Authorize
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <form id="form-add" action="{{ route('cashflow.store') }}" method="POST" enctype="multipart/form-data" style="display: none">
                @csrf
                <div class="card _card" style="width: 60%; margin: auto; padding-bottom: 20px">
                    <div class="card-body _card-body">
                        <div class="row d-flex align-items-stretch">

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
                                                    <input id="input_user_name" value="{{ Auth::user()->name }}"
                                                        name="employee_id" type="text"
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
                                                    <label for="select_user_categories" class="font-weight-bold">
                                                        Categories <span class="wajib">*</span>
                                                    </label>
                                                    <select id="select_user_categories" name="categories"
                                                        data-placeholder="Choose categories"
                                                        class="js-example-placeholder-multiple">
                                                        <option value="In - Cash">In - Cash</option>
                                                        <option value="Out - Cash">Out - Cash</option>
                                                        <option value="Setoran - Cash">Setoran - Cash</option>
                                                    </select>
                                                    @error('role')
                                                    <span class="invalid-feedback">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group _form-group">
                                            <label for="input_post_description" class="font-weight-bold">
                                                Description <span class="wajib">* </span>
                                            </label>
                                            <textarea id="input_post_description" name="description"
                                                placeholder="Write description here.."
                                                class="form-control @error('description') is-invalid @enderror"
                                                rows="8">{{ old('description') }}</textarea>
                                            @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <!-- Phone Number -->
                                        <div class="form-group _form-group">
                                            <label for="input_user_cash" class="font-weight-bold">
                                                Cash <span class="wajib">*</span>
                                            </label>
                                            <input id="input_user_cash" value="{{ old('cash') }}"
                                                style="height: 50px; font-size: 20px" name="cash" type="number"
                                                class="form-control @error('cash') is-invalid @enderror"
                                                placeholder="Rp 0" />
                                            @error('cash')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                            <!-- error message -->
                                        </div>
                                        <!-- end name -->

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">

                            <div class="col-12">
                                <div style="width: 100; display: flex; align-items: center; justify-content: center;">
                                    <a style="width: 50%; margin-right: 5px"
                                        class="btn btn-outline-primary _btn-primary px-4"
                                        href="{{ route('cashflow.index') }}">Back</a>
                                    <button style="width: 50%; margin-left: 5px" type="submit"
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@push('javascript-internal')


<script>
    let chance = 0;
    $('#btn-authorize').click(function() {
        let pin = $("#confirmation-pin").val();
        let url = "{{ route('cashflow.index') }}";
        $.ajax({
            url: "{{ route('transaction.checkpin') }}",
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

                $("#form-authorization").remove();
                Swal.fire({
                    title: 'Success',
                    text: `Authorized!`,
                    icon: 'success'
                });
                $("#form-add").show();
            }
        });
    });

    $(function() {
        $('#select_user_categories').select2({
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

    /* Tanpa Rupiah */
        var tanpa_rupiah    = document.getElementById('input_user_cash');
        tanpa_rupiah.addEventListener('keyup', function(e) {
            var nominal = this.value;
            var nominal_number = Number(nominal.replace(".", ""));
            tanpa_rupiah.value = formatRupiah(nominal);
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
@endpush