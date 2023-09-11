@extends('layouts.admin.master')

@section('title')
CMS | Shift Management
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.css') }}">
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Shift Management</h3>
@endslot
{{ Breadcrumbs::render('add_cashflow') }}
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <form id="form-shift" action="{{ route('shift.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="status" name="status">
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
                                                        Date <span class="wajib">* </span>
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
                                                    <label for="seq" class="font-weight-bold">
                                                        Shift
                                                    </label>
                                                    <input
                                                        value="{{ $data['shift_number'] }}"
                                                        name="seq" type="text" value="{{ date('H:i:s') }}"
                                                        class="form-control @error('seq') is-invalid @enderror"
                                                        required readonly />
                                                    @error('seq')
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
                                                        Cashier ON DUTY
                                                    </label>
                                                    <input value="{{ !empty($data['shift_data']) ? $data['shift_data']->user->employee_id : Auth::user()->employee_id }}" name="employee_id" type="hidden" class="form-control @error('employee_id') is-invalid @enderror" readonly />
                                                    <input value="{{ !empty($data['shift_data']) ? $data['shift_data']->user->name : Auth::user()->name }}" type="text" class="form-control @error('employee_name') is-invalid @enderror" readonly />
                                                    <!-- error message -->
                                                </div>
                                                <!-- end name -->
                                            </div>
                                            <div class="col-6">
                                                <!-- name -->
                                                <div class="form-group _form-group">
                                                    <label for="input_user_name" class="font-weight-bold">
                                                        Clock In
                                                    </label>
                                                    <input value="{{ !empty($data['shift_data']) ? $data['shift_data']->start_time : "" }}" type="text" class="form-control" readonly />
                                                    <!-- error message -->
                                                </div>
                                                <!-- end name -->
                                            </div>
                                        </div>

                                        <!-- Phone Number -->
                                        <div class="form-group _form-group">
                                            <label for="input_user_cash" class="font-weight-bold">
                                                CURRENT BEGIN CASH DRAWER
                                            </label>
                                            <input id="input_user_cash" value="{{ $data['begin'] }}"
                                                style="height: 50px; font-size: 20px" name="cash" type="number"
                                                class="form-control" {{ !empty($data['shift_data']) && $data['shift_data']->status == "IN_PROGRESS" ? "readonly" : "" }}/>
                                            <!-- error message -->
                                        </div>
                                        <!-- end name -->
                                        @if ($data['authorized'] == 1)
                                            <div class="form-group _form-group">
                                                <label for="input_pin" class="font-weight-bold">
                                                    AUTHORIZED PIN (Current Shift Cashier)
                                                </label>
                                                <input id="input_pin" style="height: 50px; font-size: 20px" name="pin" type="password" class="form-control"/>
                                                <!-- error message -->
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div style="width: 100; display: flex; align-items: center; justify-content: center;">
                                    @if ($data['authorized'] == 1)
                                        @if (!empty($data['shift_data']) && $data['shift_data']->status == 'IN_PROGRESS')
                                            <button data-status="FINISH" style="width: 100%;" type="button"
                                                class="btn-shift btn btn-primary _btn-primary px-4">
                                                END SHIFT
                                            </button>
                                        @else
                                            <button data-status="START" style="width: 100%;" type="button"
                                                class="btn-shift btn btn-primary _btn-primary px-4">
                                                START SHIFT
                                            </button>
                                        @endif
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>

            <form id="form-logout" action="{{ route('logout') }}" method="post">@csrf</form>
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
    let authorized_pin = "{{ $data['auth_pin'] }}";
    let chance = 0;
    $('.btn-shift').click(function() {
        let pin = $("#input_pin").val();
        let status = $(this).data('status');

        Swal.fire({
            title: `Do you want to ${status} your shift ?`,
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
                if (pin != authorized_pin) {
                    chance += 1;
                    if (chance >= 3) {
                        setTimeout(() => {
                            $("#form-logout").submit();
                        }, 2000);
                        return Swal.fire({
                            title: 'Oops...',
                            text: `Wrong PIN Number! You already try ${chance}x and will be forced to logout`,
                            icon: 'error'
                        });
                    }
                }
                
                if (status == 'FINISH') {
                    let url = "{{ route('shift_summary') }}";
                    window.open(url, '_self');
                } else {
                    $("#status").val(status);
                    $("#form-shift").submit();
                }
            } else if (result.isDenied) {
                return false;
            }
        })

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