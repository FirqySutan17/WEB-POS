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
{{ Breadcrumbs::render('report_receive_by_product') }}
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
                <form action="{{ route('report.receiveproduct') }}" class="row" method="POST">
                    @csrf
                    <div class="col-5">
                        <input name="search" value="{{ empty($search) ? "" : $search }}" type="text"
                            class="form-control" placeholder="Search product name or code"
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
                            formaction="{{ route('report.receiveproduct.excel') }}">EXCEL</button>
                    </div>
                    <div class="col-1">
                        <button type="submit" class="btn btn-primary _btn" role="button"
                            formaction="{{ route('report.receiveproduct.pdf') }}" formtarget="_blank">PDF</button>
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
                        <th class="center-text">Item <span class="dividerHr"></span></th>
                        <th class="center-text">Supplier <span class="dividerHr"></span></th>
                        <th class="center-text">Qty <span class="dividerHr"></span></th>
                        <th class="center-text">Unit Price <span class="dividerHr"></span></th>
                        <th class="center-text">Amount <span class="dividerHr"></span></th>
                    </tr>
                </thead>
                <?php $total_qty = 0; $total_amount = 0; ?>
                <tbody>
                    @if (!empty($data))
                    @foreach ($data as $item)
                    <?php $rowspan = 1 + count($item['details']) ?>
                    <div class="rt-invoice">
                        <tr>
                            <td class="center-text">
                                {{ $loop->iteration }}
                            </td>
                            <td style="vertical-align: middle; text-align:left">
                                {{ $item['product'] }}
                            </td>
                            <td style="vertical-align: middle; text-align:left">
                                {{ $item['supplier'] }}
                            </td>
                            <?php 
                                $qty        = 0;
                                $amount     = 0;
                                foreach ($item['details'] as $v) {
                                    $qty    += $v['quantity'];
                                    $amount += str_replace(".", "", $v['amount']);
                                } 
                                $unit_price = round($amount / $qty);
                                $total_qty += $qty;
                                $total_amount += $amount;
                            ?>
                            <td style="vertical-align: middle; text-align:right">{{ number_format($qty) }}</td>
                            <td style="vertical-align: middle; text-align:right">{{ number_format($unit_price) }}</td>
                            <td style="vertical-align: middle; text-align:right">{{ number_format($amount) }}</td>
                            
                        </tr>
                    </div>
                    @endforeach
                    @endif
                </tbody>
                <tr>
                    <th colspan="2" style="text-align:right" colspan="2">Total</th>
                    <th style="text-align:right">{{ number_format($total_qty) }}</th>
                    <td></td>
                        <td style="vertical-align: middle; text-align: right"><strong>{{ number_format($total_amount) }}</strong></td>
                </tr>
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
@endpush