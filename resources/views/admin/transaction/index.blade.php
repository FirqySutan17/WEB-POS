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
                        <td style="width: 20%; vertical-align: middle">{{ $transaction->user->name }}</td>
                        <td style="width: 15%; vertical-align: middle">
                            {{ $transaction->invoice_no }}
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
                                    <a href="{{ route('transaction.show', ['transaction' => $transaction]) }}"
                                        class="btn-sm btn-info" role="button" target="_blank">
                                        <i class="bx bxs-bullseye"></i>
                                    </a>
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

                                {{-- <div class="boxDelete">
                                    <form action="{{ route('transaction.destroy', ['transaction' => $transaction]) }}"
                                        method="POST" role="alert">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>
                                </div> --}}

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

                    {{-- <tr>
                        <td style="width: 5%;" class="center-text">1</td>
                        <td class="center-text" style="width: 20%; vertical-align: middle">24-08-2023</td>
                        <td style="width: 25%; vertical-align: middle">John Doe</td>
                        <td style="width: 20%; vertical-align: middle">
                            #INV-000002
                        </td>
                        <td class="center-text" style="width: 20%; vertical-align: middle">
                            Rp 270.000
                        </td>
                        <td style="width: 10%;" class="center-text boxAction fontField">
                            <div class="boxInside">

                                <div class="boxEdit">
                                    <a href="{{ route('transaction.edite') }}" class="btn-sm btn-info" role="button">
                                        <i class="bx bx-edit"></i>
                                    </a>
                                </div>



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
                        <td class="center-text" style="width: 20%; vertical-align: middle">23-08-2023</td>
                        <td style="width: 25%; vertical-align: middle">Kathrina Doe</td>
                        <td style="width: 20%; vertical-align: middle">
                            #INV-000001
                        </td>
                        <td class="center-text" style="width: 20%; vertical-align: middle">
                            Rp 500.000
                        </td>
                        <td style="width: 10%;" class="center-text boxAction fontField">
                            <div class="boxInside">

                                <div class="boxEdit">
                                    <a href="{{ route('transaction.edite') }}" class="btn-sm btn-info" role="button">
                                        <i class="bx bx-edit"></i>
                                    </a>
                                </div>



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
                    </tr> --}}

                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="boxFooter">

                <div class="boxPagination">

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