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
    </div>
    <div class="row">
        <div class="col-12">
            <form id="form-shift" action="{{ route('closing_shift') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $data['current_shift']->id }}">
                <input type="hidden" name="estimated_end" value="{{ $data['estimated_ending'] }}">
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
                                                    <input id="date" value="{{ $data['current_shift']->date }}"
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
                                                    <input value="{{ $data['current_shift']->seq }}" name="seq"
                                                        type="text"
                                                        class="form-control @error('seq') is-invalid @enderror" required
                                                        readonly />
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
                                                    <input value="{{ $data['current_shift']->user->name }}" type="text"
                                                        class="form-control" readonly />
                                                    <!-- error message -->
                                                </div>
                                                <!-- end name -->
                                            </div>
                                            <div class="col-3">
                                                <!-- name -->
                                                <div class="form-group _form-group">
                                                    <label for="input_user_name" class="font-weight-bold">
                                                        Clock In
                                                    </label>
                                                    <input value="{{ $data['current_shift']->start_time }}" type="text"
                                                        class="form-control" readonly />
                                                    <!-- error message -->
                                                </div>
                                                <!-- end name -->
                                            </div>
                                            <div class="col-3">
                                                <!-- name -->
                                                <div class="form-group _form-group">
                                                    <label for="input_user_name" class="font-weight-bold">
                                                        Clock Out
                                                    </label>
                                                    <input name="end_time"
                                                        value="{{ date('H:i:s', strtotime($data['end_time'])) }}"
                                                        type="text" class="form-control" readonly />
                                                    <!-- error message -->
                                                </div>
                                                <!-- end name -->
                                            </div>
                                        </div>

                                        <!-- Phone Number -->
                                        <div class="form-group _form-group">
                                            <label for="inp" class="font-weight-bold">
                                                CURRENT BEGIN CASH DRAWER
                                            </label>
                                            <input id="inp" value="{{ $data['current_shift']->begin }}"
                                                style="height: 50px; font-size: 20px" name="cash" type="number"
                                                class="form-control" readonly />
                                            <!-- error message -->
                                        </div>

                                        <div class="form-group _form-group">
                                            <label for="input_user_cash" class="font-weight-bold">
                                                CASH IN
                                            </label>
                                            <input id="input_user_cash" value="{{ $data['cash_in'] }}"
                                                style="height: 50px; font-size: 20px" type="number" class="form-control"
                                                readonly />
                                            <!-- error message -->
                                        </div>

                                        <div class="form-group _form-group">
                                            <label for="input_user_cash" class="font-weight-bold">
                                                CASH OUT
                                            </label>
                                            <input id="input_user_cash" value="{{ $data['cash_out'] }}"
                                                style="height: 50px; font-size: 20px" type="number" class="form-control"
                                                readonly />
                                            <!-- error message -->
                                        </div>

                                        {{-- @foreach ($data['cash_balance'] as $item)
                                        <div class="form-group _form-group">
                                            <label for="inp" class="font-weight-bold">
                                                {{ $item->code_data }}
                                            </label>
                                            <div class="float-right">
                                                {{ date('d M Y H:i:s', strtotime($item->created_at)) }}
                                                <br>
                                                @if ($item->type_balance == 'D')
                                                <span class="text-success">+ @currency($item->amount)</span>
                                                @else
                                                <span class="text-danger">- @currency($item->amount)</span>
                                                @endif
                                            </div>
                                            <!-- error message -->
                                        </div>
                                        @endforeach --}}
                                        <div class="form-group _form-group">
                                            <label for="inp" class="font-weight-bold">
                                                ESTIMATED ENDING CASH IN DRAWER
                                            </label>
                                            <div class="float-right">
                                                <span class="text-success">+ @currency($data['estimated_ending'])</span>
                                            </div>
                                            <!-- error message -->
                                        </div>

                                        <div class="form-group _form-group">
                                            <label for="input_user_cash" class="font-weight-bold">
                                                ACTUAL ENDING CASH DRAWER
                                            </label>
                                            <input id="input_user_cash" value="{{ $data['estimated_ending'] }}"
                                                style="height: 50px; font-size: 20px" name="cash" type="number"
                                                class="form-control" readonly />
                                            <!-- error message -->
                                        </div>

                                        <div class="form-group _form-group">
                                            <label for="input_pin" class="font-weight-bold">
                                                AUTHORIZED PIN (Current Shift Cashier)
                                            </label>
                                            <input id="input_pin" style="height: 50px; font-size: 20px" name="pin"
                                                type="password" class="form-control" />
                                            <!-- error message -->
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div style="width: 100; display: flex; align-items: center; justify-content: center;">
                                    <button style="width: 100%;" type="button"
                                        class="btn-shift btn btn-primary _btn-primary px-4">
                                        CLOSING SHIFT
                                    </button>
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
<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
@endpush

@push('javascript-internal')


<script>
    let authorized_pin = "{{ $data['current_shift']->user->pin }}";
    let chance = 0;
    $('.btn-shift').click(function() {
        let pin = $("#input_pin").val();
        let url = "{{ route('logout') }}";
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
        let status = $(this).data('status');
        $("#status").val(status);
        $("#form-shift").submit();
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