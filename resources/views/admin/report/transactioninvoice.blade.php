@extends('layouts.admin.master')

@section('title')
CMS | Report Transaction
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.0/jquery.fancybox.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">

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
<h3>Report Transaction</h3>
@endslot
{{ Breadcrumbs::render('report_transaction_by_invoice') }}
@endcomponent

<div class="container-fluid">
    <div class="menu-rt">
        <a class="{{routeActive('report.transaction')}}" href="{{ route('report.transaction') }}">By Date</a>
        <a class="{{routeActive('report.transactioninvoice')}}" href="{{ route('report.transactioninvoice') }}">By
            Invoice</a>
        <a class="{{routeActive('report.transactionproduct')}}" href="{{ route('report.transactionproduct') }}">By
            Product</a>
    </div>
    <div class="card border-add">
        <div class="tr-shadow"
            style="border-bottom-left-radius: 0px; border-bottom-right-radius: 0px; border-top-left-radius: 0px">
            <div class="boxHeader" style="margin-bottom: 0px">
                {{-- filter:start --}}
                <form action="{{ route('report.transactioninvoice') }}" class="row" method="POST">
                    @csrf
                    <div class="col-5">
                        <input name="search" value="{{ empty($search) ? "" : $search }}" type="text" class="form-control"
                                placeholder="Search employee name or id"
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
                        <button type="submit" class="btn btn-primary _btn" role="button" formaction="{{ route('report.transactioninvoice.excel') }}">EXCEL</button>
                    </div>
                    <div class="col-1">
                        <button type="submit" class="btn btn-primary _btn" role="button" formaction="{{ route('report.transactioninvoice.pdf') }}">PDF</button>
                    </div>
                </form>
                {{-- filter:end --}}
            </div>
        </div>
        <div class="table-responsive"
            style="box-shadow: 0 5px 10px rgb(0 0 0 / 0.2); border-bottom-right-radius: 10px; border-bottom-left-radius: 10px;">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr class="head-report">
                        <th rowspan="2" class="center-text">No <span class="dividerHr"></span></th>
                        <th rowspan="2" class="heightHr center-text" style="vertical-align: middle">No. Invoice <span
                                class="dividerHr"></span>
                        </th>
                        <th rowspan="2" class="center-text">Tanggal<span class="dividerHr"></span></th>
                        <th rowspan="2" class="heightHr center-text" style="vertical-align: middle">Kasir <span
                            class="dividerHr"></span>
                        </th>
                        <th rowspan="2" class="heightHr center-text">Pembayaran <span class="dividerHr"></span></th>
                        <th colspan="4" class="heightHr center-text" style="vertical-align: middle">Item <span
                                class="dividerHr"></span></th>
                    </tr>
                    <tr class="head-report">

                        <th class="heightHr center-text" style="vertical-align: middle">Produk <span
                                class="dividerHr"></span>

                        </th>
                        <th class="heightHr center-text" style="vertical-align: middle">Harga/@<span
                                class="dividerHr"></span>

                        </th>
                        <th class="heightHr center-text" style="vertical-align: middle">Qty <span
                                class="dividerHr"></span>

                        </th>
                        <th class="heightHr center-text" style="vertical-align: middle">(%)<span
                                class="dividerHr"></span></th>

                    </tr>
                </thead>
                <tbody>
                    @if (!empty($data))
                        @foreach ($data as $item)
                        <?php $rowspan = 1 + count($item['products']) ?>
                            <div class="rt-invoice">
                                <tr>
                                    <td rowspan="{{ $rowspan }}" class="center-text">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td rowspan="{{ $rowspan }}" class="center-text" style="vertical-align: middle">
                                        {{ $item['invoice_no'] }}
                                    </td>
                                    <td rowspan="{{ $rowspan }}" class="center-text" style=" vertical-align: middle">
                                        {{ $item['trans_date'] }}
                                    </td>
                                    <td rowspan="{{ $rowspan }}" class="center-text" style="vertical-align: middle">
                                        {{ $item['pic'] }}
                                    </td>
                                    <td rowspan="{{ $rowspan }}" class="center-text" style="vertical-align: middle">
                                        {{ $item['payment_method'] }}
                                    </td>

                                    <td colspan="4" style="vertical-align: middle; padding: 0px">

                                    </td>
                                    {{-- <td rowspan="3" class="center-text" style="vertical-align: middle;">
                                        Rp 270.000
                                    </td> --}}
                                </tr>
                                @foreach ($item['products'] as $product)
                                    <tr>
                                        <td style="vertical-align: middle">
                                            {{ $product['name'] }}
                                        </td>
                                        <td class="center-text"> 
                                            @if ($product['discount'] > 0)
                                                <span style="text-decoration: line-through; font-size: 12px"> @currency($product['price'])</span> <br>
                                            @endif
                                            @currency($product['price'])
                                        </td>
                                        <td class="center-text">{{ $product['quantity'] }}</td>
                                        <td class="center-text">{{ $product['discount'] }}</td>
                                    </tr>
                                @endforeach
                            </div>
                        @endforeach
                    @endif
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>

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