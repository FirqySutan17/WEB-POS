@extends('layouts.admin.master')

@section('title')
CMS | Report Receive
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
<link href="{{ asset('assets/css/fancybox.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/datepicker.min.css') }}" rel="stylesheet">

<style>
    .head-report th {
        background: #f3f2f7 !important;
    }

    .table-bordered td,
    .table-bordered th {
        border: 1px solid !important
    }

    tr {
        background: #fff !important
    }
</style>
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Report Receive</h3>
@endslot
{{ Breadcrumbs::render('report_receive') }}
@endcomponent

<div class="container-fluid">
    <div class="menu-rt">
        <a class="{{routeActive('report.receive')}}" href="{{ route('report.receive') }}">By Date</a>
        <a class="{{routeActive('report.receiveno')}}" href="{{ route('report.receiveno') }}">By
            Receive No</a>
        <a class="{{routeActive('report.receiveproduct')}}" href="{{ route('report.receiveproduct') }}">By
            Item</a>
    </div>
    <div class="card border-add">
        <div class="tr-shadow" style="border-bottom-left-radius: 0px; border-bottom-right-radius: 0px">
            <div class="boxHeader" style="margin-bottom: 0px">
                {{-- filter:start --}}
                <form action="{{ route('report.receive') }}" class="row" method="POST">
                    @csrf
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
                            formaction="{{ route('report.receive.excel') }}">EXCEL</button>
                    </div>
                    <div class="col-1">
                        <button type="submit" class="btn btn-primary _btn" role="button"
                            formaction="{{ route('report.receive.pdf') }}" formtarget="_blank">PDF</button>
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
                        <th rowspan="2" class="center-text">No <span class="dividerHr"></span></th>
                        <th rowspan="2"class="center-text">Tanggal<span class="dividerHr"></span></th>
                        <th colspan="5" class="heightHr center-text" style="vertical-align: middle">Item <span class="dividerHr"></span>
                        </th>
                    </tr>
                    <tr class="head-report">
                        <th class="heightHr center-text" style="vertical-align: middle">Item Name<span class="dividerHr"></span>
                        </th>
                        <th class="heightHr center-text" style="vertical-align: middle">Qty<span class="dividerHr"></span>
                        </th>
                        <th class="heightHr center-text" style="vertical-align: middle">Unit Price<span class="dividerHr"></span>
                        </th>
                        <th class="heightHr center-text" style="vertical-align: middle">Amount<span class="dividerHr"></span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total_amount = 0; $total_qty = 0;?>
                    @if (!empty($data))
                    @foreach ($data as $item)
                    <?php $rowspan = 1 + count($item['details']) ?>
                    <div class="rt-invoice">
                        <tr>
                            <td rowspan="{{ $rowspan }}" style="vertical-align: middle">
                                {{ $loop->iteration }}
                            </td>
                            <td rowspan="{{ $rowspan }}" style="vertical-align: middle">
                                {{ $item['receive_date'] }}
                            </td>

                            <td colspan="4" style="vertical-align: middle; padding: 0px">

                            </td>
                            {{-- <td rowspan="3" class="center-text" style="vertical-align: middle;">
                                Rp 270.000
                            </td> --}}
                        </tr>
                        @foreach ($item['details'] as $rcv)
                        <tr>
                            <td style="vertical-align: middle; text-align: left">{{ $rcv['product_code']." | ".$rcv['product_name'] }}</td>
                            <td style="vertical-align: middle; text-align: right">{{ number_format($rcv['qty']) }}</td>
                            <td style="vertical-align: middle; text-align: right">@currency($rcv['unit_price'])</td>
                            <td style="vertical-align: middle; text-align: right">@currency($rcv['amount'])</td>
                        </tr>
                        <?php $total_qty += $rcv['qty']; $total_amount += $rcv['amount'];?>
                        @endforeach
                    </div>
                    @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <?php $total_up = round($total_amount / $total_qty);?>
                        <td colspan="3" style="text-align: right">Total</td>
                        <td style="vertical-align: middle; text-align: right"><strong>{{ number_format($total_qty) }}</strong></td>
                        {{-- <td style="vertical-align: middle; text-align: right"><strong>{{ number_format($total_up) }}</strong></td>
                        <td style="vertical-align: middle; text-align: right"><strong>{{ number_format($total_amount) }}</strong></td> --}}
                        <td style="vertical-align: middle; text-align: right"></td>
                        <td style="vertical-align: middle; text-align: right"></td>
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
         format: "yyyy-mm-dd",
        //  viewMode: "years", 
        //  minViewMode: "years",
         autoclose:true
      });
      $("#enddate").datepicker({
         format: "yyyy-mm-dd",
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