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
<h3>Report Laba Rugi</h3>
@endslot
{{ Breadcrumbs::render('report_stock') }}
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
                    <div class="col-2">
                        <input type="month" class="form-control" name="sdate"
                            value="{{ empty($sdate) ? date('Y-m') : $sdate }}"
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
            <table class="table table-striped table-hover">
                <thead>
                    <tr class="head-report">
                        <th class="center-text">No <span class="dividerHr"></span></th>
                        <th>Item <span class="dividerHr"></span></th>
                        <th class="heightHr center-text">HARGA BELI <span class="dividerHr"></span></th>
                        <th class="heightHr center-text">HARGA JUAL <span class="dividerHr"></span></th>
                        <th class="heightHr center-text">SELISIH <span class="dividerHr"></span></th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($data))
                    <?php 
                    $sum_beli = 0;
                    $sum_jual = 0;
                    $sum_selisih = 0;
                    ?>
                    @foreach ($data as $item)
                    <?php 
                    $sum_beli += $item['harga_beli'];
                    $sum_jual += $item['price_store'];
                    $sum_selisih += $item['selisih'];
                    ?>
                    <tr>
                        <td style="width: 5%;" class="center-text">{{ $loop->iteration }}</td>
                        <td style="width: 35%; vertical-align: middle">
                            {{ $item['code']." - ".$item['name'] }}
                        </td>
                        <td class="center-text" style="width: 15%; vertical-align: middle">{{
                            number_format($item['harga_beli']) }}</td>
                        <td class="center-text" style="width: 15%; vertical-align: middle">
                            {{ number_format($item['price_store']) }}
                        </td>
                        <td class="center-text" style="width: 15%; vertical-align: middle">
                            @if ($item['type'] == "+")
                            <span class="text-success">+ @currency($item['selisih'])</span>
                            @else
                            <span class="text-danger">- @currency($item['selisih'])</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @endif

                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2">GRAND TOTAL</th>
                        <th>@currency($sum_beli)</th>
                        <th>@currency($sum_jual)</th>
                        <th>@currency($sum_selisih)</th>
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