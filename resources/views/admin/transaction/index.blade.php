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
            <a class="{{routeActive('transaction.summary')}}" href="{{ route('transaction.summary') }}">Profile</a>

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
        @else
        @endif

    </div>
    <div class="card">
        <div class="card-header">
            <div class="boxHeader">
                {{-- filter:start --}}
                <form class="row" method="GET">
                    <div class="col-8">
                        @if(Auth::user()->roles->first()->name == 'Cashier')
                        @else
                        @can('T Create')
                        <a href="{{ route('transaction.create') }}" class="btn btn-primary _btn" role="button">
                            <i class='bx bx-plus'></i> Add new
                        </a>
                        @endcan
                        @endif

                    </div>
                    @if(Auth::user()->roles->first()->name == 'Cashier')
                    <style>
                        .boxContent {
                            padding-top: 10px
                        }

                        .boxContent .boxSearch {
                            width: 100%;

                        }
                    </style>
                    <div class="col-12 boxContent">
                        @else
                        <div class="col-4 boxContent">
                            @endif
                            <div class="boxSearch _form-group">
                                <input name="keyword" value="{{ request('keyword') }}" type="search"
                                    class="form-control" placeholder="Search for data.."
                                    style="border-top-left-radius: 5px; border-bottom-left-radius: 5px; height: 100%">
                            </div>
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                </form>
                {{-- filter:end --}}
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr class="head-report">
                        <th class="center-text">No <span class="dividerHr"></span></th>
                        <th class="center-text">Tanggal <span class="dividerHr"></span></th>
                        <th class="heightHr">Nama Kasir <span class="dividerHr"></span></th>
                        <th class="heightHr">No. Invoice <span class="dividerHr"></span></th>
                        <th class="heightHr center-text">Pembayaran <span class="dividerHr"></span></th>
                        <th class="center-text" class="heightHr">Total Harga <span class="dividerHr"></span></th>
                        <th class="heightHr center-text">Status <span class="dividerHr"></span></th>
                        <th class="center-text">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($transactions))
                    @forelse ($transactions as $transaction)
                    {{-- @if($transaction->status == 'DRAFT')
                    <style>
                        .tr-list td {
                            background: yellow !important;
                            color: #fff !important;
                        }
                    </style>
                    @else
                    <style>
                        .tr-list td {
                            background: transparent !important;
                            color: #000 !important;
                        }
                    </style>
                    @endif --}}

                    <tr class="tr-list">
                        <td style="width: 5%;" class="center-text">{{ $loop->iteration }}</td>
                        <td class="center-text" style="width: 15%; vertical-align: middle">
                            {{ $transaction->trans_date }}
                        </td>
                        <td style="width: 15%; vertical-align: middle">{{ $transaction->user->name }}</td>
                        <td style="width: 20%; vertical-align: middle">
                            #{{ $transaction->invoice_no }}
                        </td>
                        <td class="center-text" style="width: 10%; vertical-align: middle">
                            {{ $transaction->status == 'DRAFT' ? '' : $transaction->payment_method }}</td>
                        <td class="center-text" style="width: 15%; vertical-align: middle">
                            @if ($transaction->status == 'FINISH')
                            @currency($transaction->total_price)
                            @endif
                        </td>
                        <td class="center-text" style="width: 10%; vertical-align: middle">
                            {{ $transaction->status }}
                        </td>
                        <td style="width: 10%;" class="center-text boxAction fontField">
                            <div class="boxInside">
                                @if ($transaction->status == 'FINISH')
                                <div class="boxEdit">
                                    <a href="javascript:void(0)"
                                        data-url="{{ route('transaction.show', $transaction->invoice_no) }}"
                                        class="btn-sm btn-info btn-show-post" role="button">
                                        <i class='bx bx-show'></i>
                                    </a>
                                </div>
                                <div class="boxEdit">
                                    <a href="{{ route('transaction.receipt', ['transaction' => $transaction]) }}"
                                        class="btn-sm btn-info" role="button" target="_blank">
                                        <i class='bx bx-receipt'></i>
                                    </a>
                                </div>
                                <div class="boxEdit">
                                    <a href="javascript:void(0)"
                                        onclick="adminConfirmation(`{{ route('transaction.edit', ['transaction' => $transaction]) }}`)"
                                        class="btn-sm btn-info" role="button">
                                        <i class="bx bx-edit"></i>
                                    </a>
                                </div>
                                <div class="boxDelete">
                                    <form id="form-delete-{{ $transaction->invoice_no }}"
                                        action="{{ route('transaction.destroy', ['transaction' => $transaction]) }}"
                                        method="POST" role="alert">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="del_emp_appr"
                                            id="del_emp_appr_delete-{{ $transaction->invoice_no }}">
                                        <input type="hidden" name="del_reason"
                                            id="del_reason_delete-{{ $transaction->invoice_no }}">
                                        <button type="button" class="btn btn-sm btn-danger"
                                            onclick="adminConfirmation(``, 'delete-{{ $transaction->invoice_no }}')">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>
                                </div>
                                @endif

                                @if ($transaction->status == 'DRAFT')
                                <div class="boxEdit">
                                    <a href="{{ route('transaction.edit', ['transaction' => $transaction]) }}"
                                        class="btn-sm btn-info" role="button">
                                        <i class="bx bx-edit"></i>
                                    </a>
                                </div>
                                @endif

                            </div>

                        </td>
                    </tr>
                    @endforeach
                    @else
                    <table></table>
                    <p style="text-align: center; padding-top: 50px;">
                        @if (request()->get('keyword'))
                        <strong> Search not found</strong>
                        @else
                        <strong> No data yet</strong>
                        @endif
                    </p>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="boxFooter">

                <div class="boxPagination">
                    @if ($transactions->hasPages())
                    <div class="boxPagination">
                        {{ $transactions->links('vendor.pagination.bootstrap-4') }}
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal" id="modal-edit-transaction" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TRANSAKSI</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="modal-table">
                    <thead>
                        <tr>
                            <th colspan="2">INPUT KODE PIN ATASAN</th>
                        </tr>
                        <tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="hidden" id="confirmation-url">
                                <input id="confirmation-pin" type="text" class="form-control">
                            </td>
                            <td>
                                <div class="form-group">
                                    <input class="form-control" type="text" style="display: none" id="reason"
                                        placeholder="Masukkan alasan penghapusan transaksi disini">
                                </div>
                                <button id="confirmation-pin-btn" class="btn btn-primary">CONFIRM</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('javascript-internal')
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.0/jquery.fancybox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function adminConfirmation(url, action = 'edit') {
        $("#reason").hide();
        $("#confirmation-url").val(url);
        if (action != 'edit') {
            $("#reason").show();
            $("#confirmation-url").val(action);  
        }
        $("#confirmation-pin").val('');
        $("#reason").val('');
        $("#modal-edit-transaction").modal('show');
        $("#confirmation-pin").focus();
    }

    $('#confirmation-pin-btn').click(function() {
        let pin = $("#confirmation-pin").val();
        let url = $("#confirmation-url").val();
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
                    return Swal.fire({
                        title: 'Oops...',
                        text: "Wrong PIN!",
                        icon: 'error'
                    });
                }
                
                if (url.includes("delete-")) {
                    let reason = $("#reason").val();
                    if (reason == '') {
                        return Swal.fire({
                            title: 'Oops...',
                            text: "Alasan penghapusan transaksi wajib diisi!",
                            icon: 'error'
                        });
                    }
                    $("#del_reason_" + url).val(reason);
                    $("#del_emp_appr_" + url).val(response.employee_id);
                    setTimeout(() => {
                        $("#form-" + url).submit();
                    }, 1500);
                    
                } else {
                    setTimeout(() => {
                        window.open(url, '_self');
                    }, 1500);
                    return Swal.fire({
                        title: 'Success',
                        text: "Waiting for redirect",
                        icon: 'success'
                    });
                }
            }
        });
    });
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

<script>
    $('.close').on('click', function () {
        $('#modal-edit').removeClass("show");
        $('#modal-edit').modal("hide");
        });
</script>
@include('admin.transaction.show')

@endpush