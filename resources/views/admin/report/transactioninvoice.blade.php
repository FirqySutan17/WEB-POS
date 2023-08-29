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
        <a class="{{routeActive('report.transaction')}}" href="{{ route('report.transaction') }}">Transaction</a>
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
                <form action="{{ route('report.transaction') }}" class="row" method="POST">
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
                        <button type="submit" class="btn btn-primary _btn" role="button">
                            FILTER
                        </button>
                    </div>
                    <div class="col-3">
                        <a href="#" class="btn btn-primary _btn" role="button">
                            EXPORT
                        </a>
                    </div>
                    <div class="col-4 boxContent">
                        <div class="boxSearch _form-group">
                            <input name="keyword" value="{{ request('keyword') }}" type="search" class="form-control"
                                placeholder="Search for data.."
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
        <div class="table-responsive"
            style="box-shadow: 0 5px 10px rgb(0 0 0 / 0.2); border-bottom-right-radius: 10px; border-bottom-left-radius: 10px;">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr class="head-report">
                        <th rowspan="2" class="center-text">No <span class="dividerHr"></span></th>
                        <th rowspan="2" class="center-text">Tanggal<span class="dividerHr"></span></th>
                        <th rowspan="2" class="heightHr center-text" style="vertical-align: middle">No. Invoice <span
                                class="dividerHr"></span>
                        </th>
                        <th colspan="4" class="heightHr center-text" style="vertical-align: middle">Item <span
                                class="dividerHr"></span>

                        </th>
                        <th rowspan="2" class="heightHr center-text" style="vertical-align: middle">Kasir <span
                                class="dividerHr"></span>
                        </th>
                        <th rowspan="2" class="heightHr center-text">Pembayaran <span class="dividerHr"></span></th>
                        <th rowspan="2" class="center-text" class="heightHr">Total Harga <span class="dividerHr"></span>
                        </th>
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
                                class="dividerHr"></span>

                        </th>

                    </tr>
                </thead>
                <tbody>

                    <div class="rt-invoice">
                        <tr>
                            <td rowspan="3" class="center-text">
                                1
                            </td>

                            <td rowspan="3" class="center-text" style=" vertical-align: middle">
                                28-08-2023
                            </td>
                            <td rowspan="3" class="center-text" style="vertical-align: middle">
                                #INV1012200231693190579
                            </td>
                            <td colspan="4" style="vertical-align: middle; padding: 0px">

                            </td>

                            <td rowspan="3" class="center-text" style="vertical-align: middle">
                                Ahmad Suhaidi John Doe
                            </td>
                            <td rowspan="3" class="center-text" style="vertical-align: middle">
                                EDC - BCA
                            </td>
                            <td rowspan="3" class="center-text" style="vertical-align: middle;">
                                Rp 270.000
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: middle">
                                Lorem Ipsum Dolor Sit Amet
                            </td>
                            <td class="center-text"> <span style="text-decoration: line-through; font-size: 12px"> Rp
                                    27.000</span> <br>
                                Rp
                                13.000
                            </td>
                            <td class="center-text">10</td>
                            <td class="center-text">5</td>
                        </tr>
                        <tr>
                            <td style="vertical-align: middle">
                                Lorem Ipsum Dolor Sit Amet
                            </td>
                            <td class="center-text">
                                Rp
                                13.000
                            </td>
                            <td class="center-text">10</td>
                            <td class="center-text">5</td>
                        </tr>
                    </div>

                    <div class="rt-invoice">
                        <tr>
                            <td rowspan="2" class="center-text">
                                2
                            </td>

                            <td rowspan="2" class="center-text" style=" vertical-align: middle">
                                23-08-2023
                            </td>
                            <td rowspan="2" class="center-text" style="vertical-align: middle">
                                #INV1012200231693190579
                            </td>
                            <td colspan="4" style="vertical-align: middle; padding: 0px">

                            </td>

                            <td rowspan="2" class="center-text" style="vertical-align: middle">
                                Ahmad Suhaidi John Doe
                            </td>
                            <td rowspan="2" class="center-text" style="vertical-align: middle">
                                EDC - BCA
                            </td>
                            <td rowspan="2" class="center-text" style="vertical-align: middle;">
                                Rp 270.000
                            </td>
                        </tr>
                        {{-- <tr>
                            <td>
                                Lorem Ipsum Dolor Sit Amet
                            </td>
                            <td> <span style="font-style: 
                                italic"> Rp 27.000</span> <br> Rp 13.000</td>
                            <td class="center-text">10</td>
                            <td class="center-text">5</td>
                        </tr> --}}
                        <tr>
                            <td style="vertical-align: middle">
                                Lorem Ipsum Dolor Sit Amet
                            </td>
                            <td class="center-text"> <span style="text-decoration: line-through; font-size: 12px"> Rp
                                    27.000</span> <br>
                                Rp
                                13.000
                            </td>
                            <td class="center-text">10</td>
                            <td class="center-text">5</td>
                        </tr>
                    </div>

                    <div class="rt-wrapper">
                        <tr>
                            <td rowspan="3" class="center-text">
                                3
                            </td>

                            <td rowspan="3" class="center-text" style=" vertical-align: middle">
                                30-08-2023
                            </td>
                            <td rowspan="3" class="center-text" style="vertical-align: middle">
                                #INV1012200231693190579
                            </td>
                            <td colspan="4" style="vertical-align: middle; padding: 0px">

                            </td>

                            <td rowspan="3" class="center-text" style="vertical-align: middle">
                                Ahmad Suhaidi John Doe
                            </td>
                            <td rowspan="3" class="center-text" style="vertical-align: middle">
                                EDC - BCA
                            </td>
                            <td rowspan="3" class="center-text" style="vertical-align: middle;">
                                Rp 270.000
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: middle">
                                Lorem Ipsum Dolor Sit Amet
                            </td>
                            <td class="center-text"> <span style="text-decoration: line-through; font-size: 12px"> Rp
                                    27.000</span> <br>
                                Rp
                                13.000
                            </td>
                            <td class="center-text">10</td>
                            <td class="center-text">5</td>
                        </tr>
                        <tr>
                            <td style="vertical-align: middle">
                                Lorem Ipsum Dolor Sit Amet
                            </td>
                            <td class="center-text"> <span style="text-decoration: line-through; font-size: 12px"> Rp
                                    27.000</span> <br>
                                Rp
                                13.000
                            </td>
                            <td class="center-text">10</td>
                            <td class="center-text">5</td>
                        </tr>
                    </div>

                    {{-- <tr>
                        <td class="center-text">
                            2
                        </td>

                        <td class="center-text" style=" vertical-align: middle">
                            28-08-2023
                        </td>
                        <td class="center-text" style="vertical-align: middle">
                            #INV1012200231693190526
                        </td>
                        <td style="vertical-align: middle">
                            Lorem Ipsum
                        </td>
                        <td class="center-text" style="vertical-align: middle">
                            10
                        </td>
                        <td class="center-text" style="vertical-align: middle">
                            5
                        </td>
                        <td class="center-text" style="vertical-align: middle">
                            Kathrina June Doe
                        </td>
                        <td class="center-text" style="vertical-align: middle">
                            EDC - QRIS
                        </td>
                        <td class="center-text" style="vertical-align: middle;">
                            Rp 350.000
                        </td>
                    </tr>

                    <tr>
                        <td class="center-text">
                            3
                        </td>

                        <td class="center-text" style=" vertical-align: middle">
                            30-08-2023
                        </td>
                        <td class="center-text" style="vertical-align: middle">
                            #INV1012200231693190102
                        </td>
                        <td style="vertical-align: middle">
                            Lorem Ipsum
                        </td>
                        <td class="center-text" style="vertical-align: middle">
                            10
                        </td>
                        <td class="center-text" style="vertical-align: middle">
                            5
                        </td>
                        <td class="center-text" style="vertical-align: middle">
                            Muhammad Ikhsan Maulana
                        </td>
                        <td class="center-text" style="vertical-align: middle">
                            Tunai
                        </td>
                        <td class="center-text" style="vertical-align: middle;">
                            Rp 1.200.000
                        </td>
                    </tr> --}}
                    {{-- @if (!empty($data))
                    @foreach ($data as $item)
                    <tr>
                        <td style="width: 5%;" class="center-text">{{ $loop->iteration }}</td>

                        <td class="center-text" style="width: 10%; vertical-align: middle">
                            {{ date('d-m-Y',strtotime($item->trans_date)) }}
                            23-08-2023
                        </td>
                        <td style="width: 20%; vertical-align: middle">
                            {{ $item->invoice_no }}
                            #INV1012200231693190579
                        </td>
                        <td style="width: 30%; vertical-align: middle">
                            {{ $item->name." ( ".$item->employee_id." )" }}
                            Ahmad Suhaidi John Doe
                        </td>
                        <td class="center-text" style="width: 15%; vertical-align: middle">
                            {{ $item->payment_method }}
                            EDC - BCA
                        </td>
                        <td class="center-text" style="width: 20%; vertical-align: middle;">
                            Rp {{ number_format($item->total_price) }}
                        </td>
                    </tr>
                    @endforeach
                    @endif --}}

                    {{-- <table></table>
                    <p style="text-align: center; padding-top: 50px;">

                        <strong> Search not found</strong>

                        <strong> No data yet</strong>

                    </p> --}}

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