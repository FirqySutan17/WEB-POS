@extends('layouts.admin.master')

@section('title')
CMS | Report Cash Flow
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
<h3>Report Cash Flow</h3>
@endslot
{{ Breadcrumbs::render('report_cashflow') }}
@endcomponent

<div class="container-fluid">
    <div class="card border-add">
        <div class="tr-shadow"
            style="border-bottom-left-radius: 0px; border-bottom-right-radius: 0px; border-top-left-radius: 0px">
            <div class="boxHeader" style="margin-bottom: 0px">
                {{-- filter:start --}}
                <form action="{{ route('report.cashflow') }}" class="row" method="POST">
                    @csrf
                    <div class="col-5">
                        <input name="search" value="{{ $column['search'] }}" type="text"
                            class="form-control" placeholder="Search employee name or id"
                            style="border-top-left-radius: 5px; border-bottom-left-radius: 5px; height: 100%">
                    </div>
                    <div class="col-2">
                        <input type="date" class="form-control" name="sdate"
                            value="{{ empty($column['sdate']) ? date('Y-m-d') : $column['sdate'] }}"
                            style="height: 100%; text-align: center; font-size: 14px">
                    </div>
                    <div class="col-2">
                        <input type="date" class="form-control" name="edate"
                            value="{{ empty($column['edate']) ? date('Y-m-d') : $column['edate'] }}"
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
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr class="head-report">
                        <th class="center-text">No <span class="dividerHr"></span></th>
                        <th class="center-text">Tanggal<span class="dividerHr"></span></th>
                        <th class="heightHr" style="vertical-align: middle">Kasir <span class="dividerHr"></span></th>
                        <th class="heightHr" style="vertical-align: middle">Penanggung Jawab <span class="dividerHr"></span></th>
                        <th class="center-text" class="heightHr">Deskripsi<span class="dividerHr"></span></th>
                        <th class="center-text" class="heightHr">Total<span class="dividerHr"></span></th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($data))
                        @foreach ($data as $item)
                            <tr>
                                <td class="center-text">{{ $loop->iteration }}</td>
                                <td class="center-text" style="vertical-align: middle">{{ $item->cash_date }}</td>
                                <td style="vertical-align: middle">{{ $item->created_by }}</td>
                                <td style="vertical-align: middle">{{ $item->approved_by }}</td>
                                <td style="vertical-align: middle">{{ $item->description }}</td>
                                <td style="width: 15%;" class="center-text boxAction fontField">
                                    @if ($item->category == "IN")
                                        <span class="text-success">+ @currency($item->amount)</span>
                                    @else
                                        <span class="text-danger">- @currency($item->amount)</span>
                                    @endif
                                </td>
                            </tr>  
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            <div class="boxFooter">
                <div class="boxPagination">
                    {{-- @if ($transactions->hasPages())
                    <div class="boxPagination">
                        {{ $transactions->links('vendor.pagination.bootstrap-4') }}
                    </div>
                    @endif --}}
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