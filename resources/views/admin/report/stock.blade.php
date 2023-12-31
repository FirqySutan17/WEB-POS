@extends('layouts.admin.master')

@section('title')
CMS | Report Stock
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
<h3>Report Stock</h3>
@endslot
{{ Breadcrumbs::render('report_stock') }}
@endcomponent

<div class="container-fluid">
    <div class="card">
        <div class="tr-shadow" style="border-bottom-left-radius: 0px; border-bottom-right-radius: 0px">
            <div class="boxHeader" style="margin-bottom: 0px">
                {{-- filter:start --}}
                <form action="{{ route('report.stock') }}" class="row" method="POST">
                    @csrf
                    <div class="col-2">
                        <input name="search" value="{{ empty($search) ? "" : $search }}" type="text"
                            class="form-control" placeholder="Search item"
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
                    <div class="col-2">
                        <select name="categories" class="form-control" style="height: 100%; font-size: 14px">
                            <option {{ $categories=='ALL' ? "selected" : "" }} value="ALL">All Categories</option>
                            <option {{ $categories=='Internal' ? "selected" : "" }} value="Internal">Internal</option>
                            <option {{ $categories=='External' ? "selected" : "" }} value="External">External</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <select name="order" class="form-control" style="height: 100%; font-size: 14px">
                            <option {{ $order=="DESC" ? "selected" : "" }} value="DESC">Terbesar ke Terkecil</option>
                            <option {{ $order=="ASC" ? "selected" : "" }} value="ASC">Terkecil ke Terbesar</option>
                        </select>
                    </div>
                    <div class="col-1">
                        <button type="submit" class="btn btn-primary _btn" role="button">FILTER</button>
                    </div>
                    <div class="col-1">
                        <button type="submit" class="btn btn-primary _btn" role="button"
                            formaction="{{ route('report.stock.excel') }}">EXCEL</button>
                    </div>
                    <div class="col-1">
                        <button type="submit" class="btn btn-primary _btn" role="button"
                            formaction="{{ route('report.stock.pdf') }}" formtarget="_blank">PDF</button>
                    </div>
                </form>
                {{-- filter:end --}}
            </div>
        </div>
        <div class="table-responsive"
            style="box-shadow: 0 5px 10px rgb(0 0 0 / 0.2); border-bottom-right-radius: 10px; border-bottom-left-radius: 10px;">
            <table class="table">
                <thead>
                    <tr class="head-report">
                        <th class="center-text">No <span class="dividerHr"></span></th>
                        <th>Item <span class="dividerHr"></span></th>
                        <th class="heightHr center-text">Begin <span class="dividerHr"></span></th>
                        <th class="heightHr center-text">In <span class="dividerHr"></span></th>
                        <th class="heightHr center-text">In Adj<span class="dividerHr"></span></th>
                        <th class="heightHr center-text">Out <span class="dividerHr"></span></th>
                        <th class="heightHr center-text">Out Adj<span class="dividerHr"></span></th>
                        <th class="heightHr center-text">End <span class="dividerHr"></span></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                         $sum_begin = 0;
                    $sum_in = 0;
                    $sum_in_adj = 0;
                    $sum_out = 0;
                    $sum_out_adj = 0;
                    $sum_end = 0;
                     ?>
                    @if (!empty($data))

                    @foreach ($data as $item)
                    <?php $low_stock = $item->qty_end < 5 ? "bg-danger" : ""; ?>
                    <?php
                   

                    $sum_begin += $item->qty_begin;
                    $sum_in += $item->qty_in;
                    $sum_in_adj += $item->IN_adj;
                    $sum_out += $item->qty_out;
                    $sum_out_adj += $item->out_adj;
                    $sum_end += $item->qty_end;
                    ?>
                    <tr>
                        <td style="width: 5%;" class="center-text {{ $low_stock }}">{{ $loop->iteration }}</td>
                        <td class="{{ $low_stock }}" style="width: 35%; vertical-align: middle">
                            {{ $item->name." - ".$item->code }}
                        </td>
                        <td class="center-text {{ $low_stock }}" style="width: 10%; vertical-align: middle">{{
                            number_format($item->qty_begin) }}</td>
                        <td class="center-text {{ $low_stock }}" style="width: 10%; vertical-align: middle">
                            {{ number_format($item->qty_in) }}
                        </td>
                        <td class="center-text {{ $low_stock }}" style="width: 10%; vertical-align: middle">
                            {{ number_format($item->IN_adj) }}
                        </td>
                        <td class="center-text {{ $low_stock }}" style="width: 10%; vertical-align: middle">
                            {{ number_format($item->qty_out) }}
                        </td>
                        <td class="center-text {{ $low_stock }}" style="width: 10%; vertical-align: middle">
                            {{ number_format($item->out_adj) }}
                        </td>
                        <td class="center-text {{ $low_stock }}" style="width: 10%; vertical-align: middle">
                            {{ number_format($item->qty_end) }}
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2" class="bg-grey">Total</th>
                        <th class="center-text bg-grey">{{ $sum_begin }}</th>
                        <th class="center-text bg-grey">{{ $sum_in }}</th>
                        <th class="center-text bg-grey">{{ $sum_in_adj }}</th>
                        <th class="center-text bg-grey">{{ $sum_out }}</th>
                        <th class="center-text bg-grey">{{ $sum_out_adj }}</th>
                        <th class="center-text bg-grey">{{ $sum_end }}</th>
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