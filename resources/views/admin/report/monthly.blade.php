@extends('layouts.admin.master')

@section('title')
CMS | Monthly
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
<h3>Report Monthly</h3>
@endslot
{{-- {{ Breadcrumbs::render('margin_item') }} --}}
@endcomponent

<div class="container-fluid">
    <div class="card">
        <div class="tr-shadow" style="border-bottom-left-radius: 0px; border-bottom-right-radius: 0px">
            <div class="boxHeader" style="margin-bottom: 0px">
                {{-- filter:start --}}
                <form action="{{ route('report.monthly') }}" class="row" method="POST">
                    @csrf
                    <div class="col-4">
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
                    <div class="col-1">
                        <button type="submit" class="btn btn-primary _btn" role="button"
                            formaction="{{ route('report.transaction.excel') }}">EXCEL</button>
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
                        <th style="border: 2px solid #e6edef;" rowspan="2" class="center-text">Item</th>
                        <th style="border: 2px solid #e6edef;" class="center-text" rowspan="2">Receive</th>
                        <th style="border: 2px solid #e6edef;" class="center-text" rowspan="2">IN <br> Adjust</th>
                        <th style="border: 2px solid #e6edef;" class="center-text" rowspan="2">OUT <br> Adjust</th>
                        <th style="border: 2px solid #e6edef;" class="center-text" rowspan="2">End</th>
                        <th style="border: 2px solid #e6edef;" class="center-text" rowspan="2">Sales</th>
                        <th style="border: 2px solid #e6edef;" class="center-text" colspan="2">Buying</th>
                        <th style="border: 2px solid #e6edef;" class="center-text" colspan="2">Selling</th>
                    </tr>
                    <tr class="head-report">
                        <th style="border: 2px solid #e6edef;" class="center-text">Price</th>
                        <th style="border: 2px solid #e6edef;" class="center-text">Amount</th>
                        <th style="border: 2px solid #e6edef;" class="center-text">Price</th>
                        <th style="border: 2px solid #e6edef;" class="center-text">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total_receive = 0; $total_adjust_in = 0; $total_adjust_out = 0; $total_end = 0; $total_sales = 0; $total_harga_beli = 0; $total_harga_jual = 0 ; ?>
                    @if (!empty($data))
                    @foreach ($data as $item)
                    <tr>
                        <?php 
                                $total_receive += $item->receive; $total_adjust_in += $item->adjust_in; $total_adjust_out += $item->adjust_out; $total_sales += $item->sales;  
                                $end = $item->receive + $item->adjust_in - $item->adjust_out;
                                $total_end += $end; $total_harga_beli += $item->total_harga_beli; $total_harga_jual += $item->total_harga_jual;
                            ?>
                        <td style="border: 2px solid #e6edef;">{{ $item->name.' | '.$item->product_code }}</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">{{ $item->receive }}</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">{{ $item->adjust_in }}</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">{{ $item->adjust_out }}</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">{{ $end }}</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">{{ $item->sales }}</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">
                            @currency(round($item->up_harga_beli))</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">
                            @currency(round($item->total_harga_beli))</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">
                            @currency(round($item->up_harga_jual))</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">
                            @currency(round($item->total_harga_jual))</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <th style="border: 2px solid #e6edef;text-align: left; background: #f3f2f7 ">GRAND TOTAL</th>
                        <th style="border: 2px solid #e6edef;text-align: center; background: #f3f2f7">{{ $total_receive
                            }}</th>
                        <th style="border: 2px solid #e6edef;text-align: center; background: #f3f2f7">{{
                            $total_adjust_in }}</th>
                        <th style="border: 2px solid #e6edef;text-align: center; background: #f3f2f7">{{
                            $total_adjust_out }}</th>
                        <th style="border: 2px solid #e6edef;text-align: center; background: #f3f2f7">{{ $total_sales }}
                        </th>
                        <th style="border: 2px solid #e6edef;text-align: center; background: #f3f2f7">{{ $total_end }}
                        </th>
                        <th style="border: 2px solid #e6edef;text-align: center; background: #f3f2f7">
                            @if ($total_harga_beli > 0 && $total_receive > 0)
                            @currency(round($total_harga_beli / $total_receive))
                            @else
                            0
                            @endif
                        </th>
                        <th style="border: 2px solid #e6edef;text-align: center; background: #f3f2f7">
                            @currency(round($total_harga_beli))</th>
                        <th style="border: 2px solid #e6edef;text-align: center; background: #f3f2f7">
                            @if ($total_harga_jual > 0 && $total_sales > 0)
                            @currency(round($total_harga_jual / $total_sales))
                            @else
                            0
                            @endif
                        </th>
                        <th style="border: 2px solid #e6edef;text-align: center; background: #f3f2f7">
                            @currency(round($total_harga_jual))</th>
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