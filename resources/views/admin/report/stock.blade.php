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
<h3>Report Stock</h3>
@endslot
{{ Breadcrumbs::render('report_stock') }}
@endcomponent

<div class="container-fluid">
    <div class="card">
        <div class="tr-shadow" style="border-bottom-left-radius: 0px; border-bottom-right-radius: 0px">
            <div class="boxHeader" style="margin-bottom: 0px">
                {{-- filter:start --}}
                <form class="row" method="GET">
                    <div class="col-2">
                        <input type="date" class="form-control" name="sdate"
                            value="{{ empty(old('sdate')) ? date('d-m-Y') : old('sdate') }}"
                            style="height: 100%; text-align: center; font-size: 14px">
                    </div>
                    <div class="col-2">
                        <input type="date" class="form-control" name="sdate"
                            value="{{ empty(old('edate')) ? date('d-m-Y') : old('edate') }}"
                            style="height: 100%; text-align: center; font-size: 14px">
                    </div>
                    <div class="col-1">
                        <a href="#" class="btn btn-primary _btn" role="button">
                            FILTER
                        </a>
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
            <table class="table table-striped table-hover">
                <thead>
                    <tr class="head-report">
                        <th class="center-text">NO <span class="dividerHr"></span></th>
                        <th class="center-text">TANGGAL <span class="dividerHr"></span></th>
                        <th>ITEM <span class="dividerHr"></span></th>
                        <th class="heightHr center-text">BEGIN <span class="dividerHr"></span></th>
                        <th class="heightHr center-text">IN <span class="dividerHr"></span></th>
                        <th class="heightHr center-text">OUT <span class="dividerHr"></span></th>
                        <th class="heightHr center-text">END <span class="dividerHr"></span></th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td style="width: 5%;" class="center-text">1</td>
                        <td class="center-text" style="width: 15%; vertical-align: middle">
                            24-08-2023
                        </td>
                        <td style="width: 35%; vertical-align: middle">
                            Lorem Ipsum Dolor Sit Amet
                        </td>
                        <td class="center-text" style="width: 10%; vertical-align: middle">1.000</td>
                        <td class="center-text" style="width: 10%; vertical-align: middle">
                            1.000
                        </td>
                        <td class="center-text" style="width: 10%; vertical-align: middle">
                            900
                        </td>
                        <td class="center-text" style="width: 10%; vertical-align: middle">
                            1.500
                        </td>
                    </tr>

                    <tr>
                        <td style="width: 5%;" class="center-text">2</td>
                        <td class="center-text" style="width: 15%; vertical-align: middle">
                            24-08-2023
                        </td>
                        <td style="width: 35%; vertical-align: middle">
                            Lorem Ipsum Dolor Sit Amet
                        </td>
                        <td class="center-text" style="width: 10%; vertical-align: middle">1.000</td>
                        <td class="center-text" style="width: 10%; vertical-align: middle">
                            1.000
                        </td>
                        <td class="center-text" style="width: 10%; vertical-align: middle">
                            900
                        </td>
                        <td class="center-text" style="width: 10%; vertical-align: middle">
                            1.500
                        </td>
                    </tr>

                    <tr>
                        <td style="width: 5%;" class="center-text">3</td>
                        <td class="center-text" style="width: 15%; vertical-align: middle">
                            24-08-2023
                        </td>
                        <td style="width: 35%; vertical-align: middle">
                            Lorem Ipsum Dolor Sit Amet
                        </td>
                        <td class="center-text" style="width: 10%; vertical-align: middle">1.000</td>
                        <td class="center-text" style="width: 10%; vertical-align: middle">
                            1.000
                        </td>
                        <td class="center-text" style="width: 10%; vertical-align: middle">
                            900
                        </td>
                        <td class="center-text" style="width: 10%; vertical-align: middle">
                            1.500
                        </td>
                    </tr>

                    <tr>
                        <td style="width: 5%;" class="center-text">4</td>
                        <td class="center-text" style="width: 15%; vertical-align: middle">
                            24-08-2023
                        </td>
                        <td style="width: 35%; vertical-align: middle">
                            Lorem Ipsum Dolor Sit Amet
                        </td>
                        <td class="center-text" style="width: 10%; vertical-align: middle">1.000</td>
                        <td class="center-text" style="width: 10%; vertical-align: middle">
                            1.000
                        </td>
                        <td class="center-text" style="width: 10%; vertical-align: middle">
                            900
                        </td>
                        <td class="center-text" style="width: 10%; vertical-align: middle">
                            1.500
                        </td>
                    </tr>

                    <tr>
                        <td style="width: 5%;" class="center-text">5</td>
                        <td class="center-text" style="width: 15%; vertical-align: middle">
                            24-08-2023
                        </td>
                        <td style="width: 35%; vertical-align: middle">
                            Lorem Ipsum Dolor Sit Amet
                        </td>
                        <td class="center-text" style="width: 10%; vertical-align: middle">1.000</td>
                        <td class="center-text" style="width: 10%; vertical-align: middle">
                            1.000
                        </td>
                        <td class="center-text" style="width: 10%; vertical-align: middle">
                            900
                        </td>
                        <td class="center-text" style="width: 10%; vertical-align: middle">
                            1.500
                        </td>
                    </tr>

                    <tr>
                        <td style="width: 5%;" class="center-text">6</td>
                        <td class="center-text" style="width: 15%; vertical-align: middle">
                            24-08-2023
                        </td>
                        <td style="width: 35%; vertical-align: middle">
                            Lorem Ipsum Dolor Sit Amet
                        </td>
                        <td class="center-text" style="width: 10%; vertical-align: middle">1.000</td>
                        <td class="center-text" style="width: 10%; vertical-align: middle">
                            1.000
                        </td>
                        <td class="center-text" style="width: 10%; vertical-align: middle">
                            900
                        </td>
                        <td class="center-text" style="width: 10%; vertical-align: middle">
                            1.500
                        </td>
                    </tr>

                    <tr>
                        <td style="width: 5%;" class="center-text">7</td>
                        <td class="center-text" style="width: 15%; vertical-align: middle">
                            24-08-2023
                        </td>
                        <td style="width: 35%; vertical-align: middle">
                            Lorem Ipsum Dolor Sit Amet
                        </td>
                        <td class="center-text" style="width: 10%; vertical-align: middle">1.000</td>
                        <td class="center-text" style="width: 10%; vertical-align: middle">
                            1.000
                        </td>
                        <td class="center-text" style="width: 10%; vertical-align: middle">
                            900
                        </td>
                        <td class="center-text" style="width: 10%; vertical-align: middle">
                            1.500
                        </td>
                    </tr>

                    <tr>
                        <td style="width: 5%;" class="center-text">8</td>
                        <td class="center-text" style="width: 15%; vertical-align: middle">
                            24-08-2023
                        </td>
                        <td style="width: 35%; vertical-align: middle">
                            Lorem Ipsum Dolor Sit Amet
                        </td>
                        <td class="center-text" style="width: 10%; vertical-align: middle">1.000</td>
                        <td class="center-text" style="width: 10%; vertical-align: middle">
                            1.000
                        </td>
                        <td class="center-text" style="width: 10%; vertical-align: middle">
                            900
                        </td>
                        <td class="center-text" style="width: 10%; vertical-align: middle">
                            1.500
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 5%;" class="center-text">9</td>
                        <td class="center-text" style="width: 15%; vertical-align: middle">
                            24-08-2023
                        </td>
                        <td style="width: 35%; vertical-align: middle">
                            Lorem Ipsum Dolor Sit Amet
                        </td>
                        <td class="center-text" style="width: 10%; vertical-align: middle">1.000</td>
                        <td class="center-text" style="width: 10%; vertical-align: middle">
                            1.000
                        </td>
                        <td class="center-text" style="width: 10%; vertical-align: middle">
                            900
                        </td>
                        <td class="center-text" style="width: 10%; vertical-align: middle">
                            1.500
                        </td>
                    </tr>

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