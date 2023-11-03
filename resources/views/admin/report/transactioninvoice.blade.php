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
            Item</a>
        <a class="{{routeActive('report.transactioncashier')}}" href="{{ route('report.transactioncashier') }}">By
            Cashier</a>
    </div>
    <div class="card border-add">
        <div class="tr-shadow"
            style="border-bottom-left-radius: 0px; border-bottom-right-radius: 0px; border-top-left-radius: 0px">
            <div class="boxHeader" style="margin-bottom: 0px">
                {{-- filter:start --}}
                <form action="{{ route('report.transactioninvoice') }}" class="row" method="POST">
                    @csrf
                    <div class="col-3">
                        <input name="search" value="{{ empty($search) ? "" : $search }}" type="text"
                            class="form-control" placeholder="Search employee name or id"
                            style="border-top-left-radius: 5px; border-bottom-left-radius: 5px; height: 100%">
                    </div>
                    <div class="col-2">
                        <select name="payment_method" class="form-control" style="height: 100%; font-size: 14px">
                            <option {{ $payment_method=='ALL' ? "selected" : "" }} value="ALL">All Payment Method</option>
                            <option {{ $payment_method=='Tunai' ? "selected" : "" }} value="Tunai">Tunai</option>
                            <option {{ $payment_method=='Non-Tunai' ? "selected" : "" }} value="Non-Tunai">Non Tunai</option>
                        </select>
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
                            formaction="{{ route('report.transactioninvoice.excel') }}">EXCEL</button>
                    </div>
                    <div class="col-1">
                        <button type="submit" class="btn btn-primary _btn" role="button"
                            formaction="{{ route('report.transactioninvoice.pdf') }}" formtarget="_blank">PDF</button>
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
                        <th colspan="5" class="heightHr center-text" style="vertical-align: middle">Item <span
                                class="dividerHr"></span></th>
                        <th rowspan="2" class="heightHr center-text">Total <span class="dividerHr"></span></th>

                    </tr>
                    <tr class="head-report">

                        <th class="heightHr center-text" style="vertical-align: middle">Produk <span
                                class="dividerHr"></span>

                        </th>

                        <th class="heightHr center-text" style="vertical-align: middle">(%)<span
                                class="dividerHr"></span></th>
                        <th class="heightHr center-text" style="vertical-align: middle">Harga<span
                                class="dividerHr"></span>

                        </th>
                        <th class="heightHr center-text" style="vertical-align: middle">Qty <span
                                class="dividerHr"></span>

                        </th>
                        <th class="heightHr center-text" style="vertical-align: middle">Total <span
                                class="dividerHr"></span>

                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $pro_price = 0; ?>
                    <?php $disc = 0; ?>
                    <?php $disc_price = 0; ?>
                    <?php $total = 0; $total_qty = 0; ?>
                    @if (!empty($data))
                    @foreach ($data as $i => $item)
                    <?php $sub_total = 0; ?>
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

                            <td colspan="5" style="vertical-align: middle; padding: 0px">

                            </td>
                            <td id="row-{{$i}}-subtotal" rowspan="{{ $rowspan }}" class="center-text" style="vertical-align: middle">
                                @currency($sub_total)
                            </td>
                        </tr>
                        @foreach ($item['products'] as $product)
                        <?php
                            // if ($product['name'] == 'AYAM UTUH 700 GRAM') { dd($product); }
                            $disc_price = $product['price'];
                            $pro_price = $disc_price * $product['quantity'];
                            $sub_total += $pro_price;
                        ?>
                        <tr>
                            <td style="vertical-align: middle">
                                {{ $product['name'] }}
                            </td>
                            <td class="center-text">{{ $product['discount'] }}</td>
                            <td class="center-text">
                                @if ($product['discount'] > 0)
                                <span style="text-decoration: line-through; font-size: 12px">
                                    @currency($product['basic_price'])</span> <br>
                                @endif
                                @currency($disc_price)
                            </td>
                            <td class="center-text">{{ $product['quantity'] }}</td>
                            <td class="center-text">@currency($pro_price)</td>
                        </tr>
                        <?php $total_qty += $product['quantity']; ?>
                        @endforeach
                    </div>
                    <?php $total += $sub_total; ?>
                    <script>
                        document.getElementById("row-{{ $i }}-subtotal").innerHTML="Rp {{ str_replace(',', '.', number_format($sub_total)) }}";
                    </script>
                    @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="8" style="text-align: right">Total</th>>
                        <th style="text-align: right">{{ number_format($total_qty) }}</th>>
                        <th style="text-align: right"></th>
                        <th style="text-align: right">@currency($total)</th>
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