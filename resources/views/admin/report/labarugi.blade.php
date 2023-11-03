@extends('layouts.admin.master')

@section('title')
CMS | Best Seller
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
<h3>Report Margin Item</h3>
@endslot
{{-- {{ Breadcrumbs::render('margin_item') }} --}}
@endcomponent

<div class="container-fluid">
    <div class="card">
        <div class="tr-shadow" style="border-bottom-left-radius: 0px; border-bottom-right-radius: 0px">
            <div class="boxHeader" style="margin-bottom: 0px">
                {{-- filter:start --}}
                <form action="{{ route('report.labarugi') }}" class="row" method="POST">
                    @csrf
                    <div class="col-5">
                        <input name="search" value="{{ empty($search) ? "" : $search }}" type="text"
                            class="form-control" placeholder="Search item by name or code"
                            style="border-top-left-radius: 5px; border-bottom-left-radius: 5px; height: 100%">
                    </div>
                    {{-- <div class="col-2">
                        <input type="month" class="form-control" name="sdate"
                            value="{{ empty($sdate) ? date('Y-m') : $sdate }}"
                            style="height: 100%; text-align: center; font-size: 14px">
                    </div> --}}
                    {{-- <div class="col-2">
                        <input type="month" class="form-control" name="edate"
                            value="{{ empty($sdate) ? date('Y-m') : $sdate }}"
                            style="height: 100%; text-align: center; font-size: 14px">
                    </div> --}}
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
                    <div class="col-1">
                        <button type="submit" class="btn btn-primary _btn" role="button">FILTER</button>
                    </div>
                </form>
                {{-- filter:end --}}
            </div>
        </div>
        <div class="table-responsive"
            style="box-shadow: 0 5px 10px rgb(0 0 0 / 0.2); border-bottom-right-radius: 10px; border-bottom-left-radius: 10px;">
            <table class="table table-striped table-hover">
                <thead>
                    <tr class="head-report">
                        <th class="center-text">NO <span class="dividerHr"></span></th>
                        <th class="center-text">ITEM <span class="dividerHr"></span></th>
                        <th class="heightHr center-text">TANGGAL</th>
                        <th class="heightHr center-text">QTY</th>
                        <th class="heightHr center-text">HARGA BELI <span class="dividerHr"></span></th>
                        <th class="heightHr center-text">HARGA JUAL <span class="dividerHr"></span></th>
                        <th class="heightHr center-text">SELISIH <span class="dividerHr"></span></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $grand_total_qty = 0; $grand_total_selisih = 0; ?>
                    @if (!empty($data))
                    
                    @foreach ($data as $item)
                        <?php 
                            $detail     = array_values($item['detail']);
                            $total_detail    = count($detail);

                            $sum_beli = 0;
                            $sum_jual = 0;
                            $sum_selisih = 0;
                            $sum_qty = 0;
                        ?>
                        <tr>
                            <td rowspan="{{ $total_detail }}" style="width: 5%;" class="center-text">{{ $loop->iteration }}</td>
                            <td rowspan="{{ $total_detail }}" style="width: 30%; vertical-align: middle">
                                {{ $item['product_name'] }}
                            </td>
                            @if ($total_detail > 0)
                            <?php
                                $sub_total_harga_beli   = $detail[0]['harga_beli'] * $detail[0]['quantity'];
                                $sub_total_harga_jual   = $detail[0]['harga_jual'] * $detail[0]['quantity'];
                                $sub_selisih            = $sub_total_harga_jual - $sub_total_harga_beli;
                                $sum_qty += $detail[0]['quantity'];
                                $sum_selisih += $sub_selisih;
                                
                            ?>
                            <td class="center-text" style="width: 10%; vertical-align: middle">{{ $detail[0]['tanggal'] }}</td>
                            <td style="width: 5%; vertical-align: middle; text-align:right">{{ number_format($detail[0]['quantity']) }}</td>
                            <td style="width: 20%; vertical-align: middle; text-align:right"> @currency($sub_total_harga_beli) (@currency($detail[0]['harga_beli']))</td>
                            <td style="width: 20%; vertical-align: middle; text-align:right"> @currency($sub_total_harga_jual) (@currency($detail[0]['harga_jual']))</td>
                            <td style="width: 10%; vertical-align: middle; text-align:right">
                                <span class="{{ $sub_selisih >= 0 ? "text-success" : "text-danger" }}">@currency($sub_selisih)</span>
                            </td>
                            <?php unset($detail[0]); ?>
                            @endif
                        </tr>
                        @foreach ($detail as $dtl)
                        <?php
                            $sub_total_harga_beli   = $dtl['harga_beli'] * $dtl['quantity'];
                            $sub_total_harga_jual   = $dtl['harga_jual'] * $dtl['quantity'];
                            $sub_selisih            = $sub_total_harga_jual - $sub_total_harga_beli;
                            $sum_qty += $dtl['quantity'];
                            $sum_selisih += $sub_selisih;
                        ?>
                        <tr>
                            <td class="center-text" style="width: 10%; vertical-align: middle">{{ $dtl['tanggal'] }}</td>
                            <td style="width: 5%; vertical-align: middle; text-align:right">{{ number_format($dtl['quantity']) }}</td>
                            <td style="width: 20%; vertical-align: middle; text-align:right"> @currency($sub_total_harga_beli) (@currency($dtl['harga_beli']))</td>
                            <td style="width: 20%; vertical-align: middle; text-align:right"> @currency($sub_total_harga_jual) (@currency($dtl['harga_jual']))</td>
                            <td style="width: 10%; vertical-align: middle; text-align:right">
                                <span class="{{ $sub_selisih >= 0 ? "text-success" : "text-danger" }}">@currency($sub_selisih)</span>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="3" style="text-align: right"><strong>Sub Total</strong></td>
                            <td style="text-align: right"><strong>{{ number_format($sum_qty) }}</strong></td>
                            <td colspan="2" style="text-align: right"></td>
                            <td style="text-align: right"><strong>@currency($sum_selisih)</strong></td>
                        </tr>
                        <?php $grand_total_qty += $sum_qty; $grand_total_selisih += $sum_selisih; ?>
                    @endforeach
                    @endif

                </tbody>
                <tfoot>
                    <tr>
                        <th style="text-align: center" colspan="3">GRAND TOTAL</th>
                        <th style="text-align: center">{{ number_format($grand_total_qty) }}</th>
                        <th style="text-align: center" colspan="2"></th>
                        <th style="text-align: center">@currency($grand_total_selisih)</th>
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