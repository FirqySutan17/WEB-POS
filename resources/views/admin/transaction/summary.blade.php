@extends('layouts.admin.master')

@section('title')
CMS | Transaction
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.0/jquery.fancybox.min.css" rel="stylesheet" />
<style>
    .head-report th {
        background: #f3f2f7 !important;
    }

    .summary {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        width: 100%;
        column-gap: 20px;
        padding: 10px
    }

    .summary .summary-box {
        grid-column: span 2;
        width: 100%
    }

    .summary .summary-box .db-box {
        width: 100%;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
        padding: 20px 30px;
        height: 250px;
        display: flex;
        align-items: end;
        justify-content: center;
        flex-direction: column;
        position: relative;
        overflow: hidden;
        margin-bottom: 20px
    }

    .summary .summary-box .db-box:nth-child(2),
    .summary .summary-box .db-box:nth-child(4) {
        margin-bottom: 0px
    }

    .summary .summary-box .db-box i {
        position: absolute;
        top: 30px;
        left: -50px;
        font-size: 210px;
        color: #d9d9d9;
    }

    .summary .summary-box .db-box p {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 0px
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
    @if(Auth::user()->roles->first()->name == 'Cashier')
    <div class="menu-rt">
        <a class="{{routeActive('transaction.create')}}" href="{{ route('transaction.create') }}">Transaction</a>
        <a class="{{routeActive('transaction.index')}}" href="{{ route('transaction.index') }}">List</a>
        <a class="{{routeActive('transaction.summary')}}" href="{{ route('transaction.summary') }}">Profile</a>
    </div>
    @else
    @endif
    <div class="card">
        <div class="card-body table-responsive">
            <div class="summary">
                <div class="summary-box tr-shadow">
                    <div class="row"
                        style="height: 328px; display: flex; flex-direction: column; justify-content: center; align-items: center; position: sticky; position: -webkit-sticky; top: 10px">
                        <div class="col-12">
                            <div class="form-group _form-group">
                                <label for="receive_date" class="font-weight-bold">
                                    Kasir
                                </label>
                                <input value="{{ Auth::user()->name }}" type="text" class="form-control" required
                                    readonly tabindex="0" />
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group _form-group">
                                <label for="receive_date" class="font-weight-bold">
                                    Tanggal Transaksi
                                </label>
                                <input value="{{ date('d-m-Y') }}" class="form-control" required readonly
                                    tabindex="0" />
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group _form-group">
                                <label for="invoice_no" class="font-weight-bold">
                                    Nomor Invoice
                                </label>
                                <input name="invoice_no" type="text" value="" class="form-control" required readonly
                                    tabindex="0" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="summary-box">
                    <div class="db-box">
                        <h2>25</h2>
                        <p>Today</p>
                        <i class='bx bx-dollar'></i>
                    </div>
                    <div class="db-box">
                        <h2>127</h2>
                        <p>Montly</p>
                        <i class='bx bx-dollar'></i>
                    </div>
                </div>

                <div class="summary-box">
                    <div class="db-box">
                        <h2>Rp 5.230.000</h2>
                        <p>Today</p>
                        <i class='bx bx-dollar'></i>
                    </div>
                    <div class="db-box">
                        <h2>Rp 17.020.000</h2>
                        <p>Monthly</p>
                        <i class='bx bx-dollar'></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('javascript-internal')
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.0/jquery.fancybox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
		$("form[role='alert']").submit(function(event) {
			event.preventDefault();
			Swal.fire({
				title: 'Delete',
				text: 'Are you sure want to remove this?',
				icon: 'warning',
				allowOutsideClick: false,
				showCancelButton: true,
				cancelButtonText: "Cancel",
				reverseButtons: true,
				confirmButtonText: "Yes",
			}).then((result) => {
				if (result.isConfirmed) {
					// todo: process of deleting categories
					event.target.submit();
				}
			});
		});
	});
</script>
@endpush