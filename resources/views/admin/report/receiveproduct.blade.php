@extends('layouts.admin.master')

@section('title')
CMS | Report Stock
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.0/jquery.fancybox.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">

<style>
    .head-report th {
        background: #f3f2f7 !important;
    }
</style>
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Report Receive</h3>
@endslot
{{ Breadcrumbs::render('report_stock') }}
@endcomponent

<div class="container-fluid">
    <div class="menu-rt">
        <a class="{{routeActive('report.receive')}}" href="{{ route('report.receive') }}">By Date</a>
        <a class="{{routeActive('report.receiveno')}}" href="{{ route('report.receiveno') }}">By
            Receive No</a>
        <a class="{{routeActive('report.receiveproduct')}}" href="{{ route('report.receiveproduct') }}">By
            Product</a>
    </div>
    <div class="card border-add">
        <div class="tr-shadow" style="border-bottom-left-radius: 0px; border-bottom-right-radius: 0px">
            <div class="boxHeader" style="margin-bottom: 0px">
                {{-- filter:start --}}
                <form action="{{ route('report.receiveproduct') }}" class="row" method="POST">
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
                        <th rowspan="2" class="center-text">Product <span class="dividerHr"></span></th>
                        <th colspan="5" class="heightHr center-text" style="vertical-align: middle">Receive <span class="dividerHr"></span>
                        </th>
                    </tr>
                    <tr class="head-report">
                        <th class="heightHr center-text" style="vertical-align: middle">Qty<span
                            class="dividerHr"></span>
                        </th>
                        <th class="center-text">PIC<span class="dividerHr"></span></th>
                        <th class="center-text">Delivery No<span class="dividerHr"></span></th>
                        <th class="center-text">Receive Date<span class="dividerHr"></span></th>
                        <th class="center-text">Receive Code<span class="dividerHr"></span></th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($data))
                        @foreach ($data as $item)
                        <?php $rowspan = 1 + count($item['details']) ?>
                            <div class="rt-invoice">
                                <tr>
                                    <td rowspan="{{ $rowspan }}" class="center-text">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td rowspan="{{ $rowspan }}" class="center-text" style="vertical-align: middle">
                                        {{ $item['product'] }}
                                    </td>
                                    <td colspan="5" style="vertical-align: middle; padding: 0px">

                                    </td>
                                </tr>
                                @foreach ($item['details'] as $rcv)
                                    <tr>
                                        <td class="center-text">{{ $rcv['quantity'] }}</td>
                                        <td class="center-text">{{ $rcv['pic'] }}</td>
                                        <td class="center-text">{{ $rcv['delivery_no'] }}</td>
                                        <td class="center-text">{{ $rcv['receive_date'] }}</td>
                                        <td class="center-text">{{ $rcv['receive_code'] }}</td>
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