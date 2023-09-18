@extends('layouts.admin.master')

@section('title')
CMS | Report Transaction
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
<link href="{{ asset('assets/css/fancybox.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/datepicker.min.css') }}" rel="stylesheet">

<style>
    .head-report th {
        background: #f3f2f7 !important;
    }
</style>
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Report Transaction</h3>
@endslot
{{ Breadcrumbs::render('report_transaction') }}
@endcomponent

<div class="container-fluid">
    <div class="menu-rt">
        <a class="{{routeActive('report.transaction')}}" href="{{ route('report.transaction') }}">By Date</a>
        <a class="{{routeActive('report.transactioninvoice')}}" href="{{ route('report.transactioninvoice') }}">By
            Invoice</a>
        <a class="{{routeActive('report.transactionproduct')}}" href="{{ route('report.transactionproduct') }}">By
            Product</a>
        <a class="{{routeActive('report.transactioncashier')}}" href="{{ route('report.transactioncashier') }}">By
            Cashier</a>
    </div>
    <div class="card border-add">
        <div class="tr-shadow"
            style="border-bottom-left-radius: 0px; border-bottom-right-radius: 0px; border-top-left-radius: 0px">
            <div class="boxHeader" style="margin-bottom: 0px">
                {{-- filter:start --}}
                <form action="{{ route('report.transaction') }}" class="row" method="POST">
                    @csrf
                    <div class="col-5">
                        <input name="search" value="{{ empty($search) ? "" : $search }}" type="text"
                            class="form-control" placeholder="Search employee name or id"
                            style="border-top-left-radius: 5px; border-bottom-left-radius: 5px; height: 100%">
                    </div>
                    <div class="col-2">
                        <input type="date" class="form-control" name="sdate"
                            value="{{ empty($sdate) ? date('Y-m-d') : $sdate }}"
                            style="height: 100%; text-align: center; font-size: 14px">
                    </div>
                    <div class="col-2">
                        <input type="date" class="form-control" name="edate"
                            value="{{ empty($edate) ? date('Y-m-d') : $edate }}"
                            style="height: 100%; text-align: center; font-size: 14px">
                    </div>
                    <div class="col-1">
                        <button type="submit" class="btn btn-primary _btn" role="button">FILTER</button>
                    </div>
                    <div class="col-1">
                        <button type="submit" class="btn btn-primary _btn" role="button"
                            formaction="{{ route('report.transaction.excel') }}">EXCEL</button>
                    </div>
                    <div class="col-1">
                        <button type="submit" class="btn btn-primary _btn" role="button"
                            formaction="{{ route('report.transaction.pdf') }}" formtarget="_blank">PDF</button>
                    </div>
                </form>
                {{-- filter:end --}}
            </div>
        </div>
        <div class="table-responsive"
            style="box-shadow: 0 5px 10px rgb(0 0 0 / 0.2); border-bottom-right-radius: 10px; border-bottom-left-radius: 10px;">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr class="head-report">
                        <th class="center-text">No <span class="dividerHr"></span></th>
                        <th class="center-text">Tanggal<span class="dividerHr"></span></th>
                        <th class="heightHr" style="vertical-align: middle">No. Invoice <span class="dividerHr"></span>
                        </th>
                        <th class="heightHr" style="vertical-align: middle">Nama Kasir <span class="dividerHr"></span>
                        </th>
                        <th class="heightHr center-text">Metode Pembayaran <span class="dividerHr"></span></th>
                        <th class="center-text" class="heightHr">Total Harga <span class="dividerHr"></span></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $grand_total = 0; ?>
                    @if (!empty($data))
                    @foreach ($data as $item)
                    <?php $grand_total += $item->total_price; ?>
                    <tr>
                        <td class="center-text">{{ $loop->iteration }}</td>

                        <td class="center-text" style="vertical-align: middle">
                            {{ date('d-m-Y',strtotime($item->trans_date)) }}
                        </td>
                        <td style="vertical-align: middle">
                            {{ $item->invoice_no }}
                        </td>
                        <td style="vertical-align: middle">
                            {{ $item->name." ( ".$item->employee_id." )" }}
                        </td>
                        <td class="center-text" style="vertical-align: middle">
                            {{ $item->payment_method }}
                        </td>
                        <td class="center-text" style="vertical-align: middle;">
                            @currency($item->total_price)
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr class="head-report">
                        <th colspan="5" class="heightHr right-text">Grand Total <span class="dividerHr"></span></th>
                        <th class="center-text" class="heightHr">@currency($grand_total) <span class="dividerHr"></span>
                        </th>
                    </tr>
                </tfoot>
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
<script src="{{ asset('assets/js/fancybox.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/js/datepicker.min.js') }}"></script>

<script>
    $(document).ready(function(){
      $("#startdate").datepicker({
         format: "dd-mm-yyyy",
        //  viewMode: "years", 
        //  minViewMode: "years",
         autoclose:true
      });
      $("#enddate").datepicker({
         format: "dd-mm-yyyy",
        //  viewMode: "years", 
        //  minViewMode: "years",
         autoclose:true
      });     
    })
</script>
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