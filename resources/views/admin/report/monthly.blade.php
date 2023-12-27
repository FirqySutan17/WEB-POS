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

                    <tr>
                        <td style="border: 2px solid #e6edef;">89910100001 | AYAM UTUH 600 G</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">10</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">5</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">0</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">120</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">50</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">10.000</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">150.000</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">20.000</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">1.000.000</td>
                    </tr>
                    <tr>
                        <td style="border: 2px solid #e6edef;">89910100001 | AYAM UTUH 600 G</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">10</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">5</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">0</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">120</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">50</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">10.000</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">150.000</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">20.000</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">1.000.000</td>
                    </tr>
                    <tr>
                        <td style="border: 2px solid #e6edef;">89910100001 | AYAM UTUH 600 G</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">10</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">5</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">0</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">120</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">50</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">10.000</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">150.000</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">20.000</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">1.000.000</td>
                    </tr>
                    <tr>
                        <td style="border: 2px solid #e6edef;">89910100001 | AYAM UTUH 600 G</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">10</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">5</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">0</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">120</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">50</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">10.000</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">150.000</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">20.000</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">1.000.000</td>
                    </tr>
                    <tr>
                        <td style="border: 2px solid #e6edef;">89910100001 | AYAM UTUH 600 G</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">10</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">5</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">0</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">120</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">50</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">10.000</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">150.000</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">20.000</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">1.000.000</td>
                    </tr>
                    <tr>
                        <td style="border: 2px solid #e6edef;">89910100001 | AYAM UTUH 600 G</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">10</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">5</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">0</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">120</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">50</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">10.000</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">150.000</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">20.000</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">1.000.000</td>
                    </tr>
                    <tr>
                        <td style="border: 2px solid #e6edef;">89910100001 | AYAM UTUH 600 G</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">10</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">5</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">0</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">120</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">50</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">10.000</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">150.000</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">20.000</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">1.000.000</td>
                    </tr>
                    <tr>
                        <td style="border: 2px solid #e6edef;">89910100001 | AYAM UTUH 600 G</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">10</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">5</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">0</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">120</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">50</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">10.000</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">150.000</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">20.000</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">1.000.000</td>
                    </tr>
                    <tr>
                        <td style="border: 2px solid #e6edef;">89910100001 | AYAM UTUH 600 G</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">10</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">5</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">0</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">120</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">50</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">10.000</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">150.000</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">20.000</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">1.000.000</td>
                    </tr>
                    <tr>
                        <td style="border: 2px solid #e6edef;">89910100001 | AYAM UTUH 600 G</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">10</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">5</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">0</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">120</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">50</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">10.000</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">150.000</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">20.000</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">1.000.000</td>
                    </tr>
                    <tr>
                        <td style="border: 2px solid #e6edef;">89910100001 | AYAM UTUH 600 G</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">10</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">5</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">0</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">120</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">50</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">10.000</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">150.000</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">20.000</td>
                        <td style="border: 2px solid #e6edef;" class="center-text">1.000.000</td>
                    </tr>

                </tbody>
                <tfoot>
                    <tr>
                        <th style="border: 2px solid #e6edef;text-align: left; background: #f3f2f7 ">GRAND TOTAL</th>
                        <th style="border: 2px solid #e6edef;text-align: center; background: #f3f2f7">100</th>
                        <th style="border: 2px solid #e6edef;text-align: center; background: #f3f2f7">20</th>
                        <th style="border: 2px solid #e6edef;text-align: center; background: #f3f2f7">10</th>
                        <th style="border: 2px solid #e6edef;text-align: center; background: #f3f2f7">320</th>
                        <th style="border: 2px solid #e6edef;text-align: center; background: #f3f2f7">500</th>
                        <th style="border: 2px solid #e6edef;text-align: center; background: #f3f2f7">Rp 500.000</th>
                        <th style="border: 2px solid #e6edef;text-align: center; background: #f3f2f7">Rp 17.000.000</th>
                        <th style="border: 2px solid #e6edef;text-align: center; background: #f3f2f7">Rp 9.000.000</th>
                        <th style="border: 2px solid #e6edef;text-align: center; background: #f3f2f7">Rp 12.000.000</th>
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