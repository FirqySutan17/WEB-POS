@extends('layouts.admin.master')

@section('title')
CMS | Purchase Order
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
<link href="{{ asset('assets/css/fancybox.min.css') }}" rel="stylesheet" />
<style>
    .head-report th {
        background: #f3f2f7 !important;
    }
</style>
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Purchase Order</h3>
@endslot
{{ Breadcrumbs::render('purchase_order') }}
@endcomponent

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <div class="boxHeader">
                {{-- filter:start --}}
                <form class="row" method="GET">
                    <div class="col-8">
                        @can('P Create')
                        <a href="{{ route('purchase-order.create') }}" class="btn btn-primary _btn" role="button">
                            <i class='bx bx-plus'></i> Add New
                        </a>
                        @endcan
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
        <div class="card-body table-responsive">
            <table class="table">
                <thead>
                    <tr class="head-report">
                        <th class="center-text">No <span class="dividerHr"></span></th>
                        <th class="heightHr">Date <span class="dividerHr"></span></th>
                        <th class="heightHr">Purchase Order <span class="dividerHr"></span></th>
                        <th class="heightHr">Supplier <span class="dividerHr"></span></th>
                        <th class="heightHr">Status <span class="dividerHr"></span></th>
                        <th class="center-text">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($purchaseOrders))
                    @forelse ($purchaseOrders as $p)
                    <tr>
                        <td style="width: 5%;" class="center-text">{{ $loop->iteration }}</td>
                        <td style="width: 15%; vertical-align: middle">{{ $p->date_po." ".$p->time_po }}</td>
                        <td style="width: 20%; vertical-align: middle">{{ $p->no_po }}</td>
                        <td style="width: 30%; vertical-align: middle">Supplier name</td>
                        <td style="width: 20%; vertical-align: middle">
                            @if($p->is_po == 0)
                            <span class="on-going">Open</span>
                            @elseif($p->is_po == 1)
                            <span class="finish">Close</span>
                            @endif
                        </td>
                        <td style="width: 10%;" class="center-text boxAction fontField">
                            <div class="boxInside">

                                {{-- <div class="boxEdit" style="padding-top: 4px">
                                    <a href="{{ route('purchase-order.edit', ['purchase_order' => $p]) }}"
                                        class="btn-sm btn-info" role="button">
                                        <i class="bx bx-edit"></i>
                                    </a>
                                </div> --}}

                                <div class="boxDelete">
                                    <form action="{{ route('purchase-order.destroy', ['purchase_order' => $p]) }}"
                                        method="POST" role="alert">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" style="padding-bottom: 0px">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </td>
                    </tr>
                    @endforeach
                    @else
                    <table></table>
                    <p style="text-align: center; padding-top: 50px;">
                        @if (request()->get('keyword'))
                        <strong> Search not found</strong>
                        @else
                        <strong> No data yet</strong>
                        @endif
                    </p>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="boxFooter">
                @if ($purchaseOrders->hasPages())
                <div class="boxPagination">
                    {{ $purchaseOrders->links('vendor.pagination.bootstrap-4') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@push('javascript-internal')
<script src="{{ asset('assets/js/fancybox.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>

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