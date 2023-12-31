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
                <form action="{{ route('report.transactioncashier') }}" class="row" method="POST">
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
                        <th rowspan="2" class="heightHr center-text" style="vertical-align: middle">Cashier ID <span
                                class="dividerHr"></span>
                        </th>
                        <th rowspan="2" class="center-text">Cashier Name<span class="dividerHr"></span></th>
                        <th colspan="4" class="heightHr center-text" style="vertical-align: middle">Invoice <span
                                class="dividerHr"></span></th>

                    </tr>
                    <tr class="head-report">
                        <th class="heightHr" style="vertical-align: middle">No. Invoice <span class="dividerHr"></span>
                        <th class="center-text">Tanggal<span class="dividerHr"></span></th>
                        <th class="heightHr center-text">Metode Pembayaran <span class="dividerHr"></span></th>
                        <th class="center-text" class="heightHr">Total Harga <span class="dividerHr"></span></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; ?>
                    @if (!empty($data))
                    @foreach ($data as $item)
                    <?php $sub_total = 0; $rowspan = 1 + count($item['details']) ?>
                    <div class="rt-invoice">
                        <tr>
                            <td rowspan="{{ $rowspan }}" class="center-text">
                                {{ $loop->iteration }}
                            </td>
                            <td rowspan="{{ $rowspan }}" class="center-text" style="vertical-align: middle">
                                {{ $item['code'] }}
                            </td>
                            <td rowspan="{{ $rowspan }}" class="center-text" style=" vertical-align: middle">
                                {{ $item['name'] }}
                            </td>

                            <td colspan="5" style="vertical-align: middle; padding: 0px">

                            </td>
                        </tr>
                        @foreach ($item['details'] as $invoice)
                        <tr>
                            <td style="vertical-align: middle">{{ $invoice['invoice_no'] }}</td>
                            <td class="center-text">{{ $invoice['trans_date'] }}</td>
                            <td class="center-text">{{ $invoice['payment_method'] }}</td>
                            <td class="center-text">@currency($invoice['total_price'])</td>
                        </tr>
                        <?php $total += $invoice['total_price']; $sub_total += $invoice['total_price']; ?>
                        @endforeach
                        <tr>
                            <td colspan="6" style="vertical-align: middle; text-align:right;"><strong>Sub Total</strong></td>
                            <td style="text-align: right"><strong>@currency($sub_total)</strong></td>
                        </tr>
                    </div>
                    @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="6" style="text-align: right"><strong>Total</strong></th>
                        <th style="text-align: right"><strong>@currency($total)</strong></th>
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
@endpush