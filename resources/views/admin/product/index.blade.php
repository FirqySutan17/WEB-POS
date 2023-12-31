@extends('layouts.admin.master')

@section('title')
CMS | Product
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
<h3>Product</h3>
@endslot
{{ Breadcrumbs::render('product') }}
@endcomponent

<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<div class="boxHeader">
				{{-- filter:start --}}
				<form class="row" method="GET">
					<div class="col-8">
						@can('P Create')
						<a href="{{ route('product.create') }}" class="btn btn-primary _btn" role="button">
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
						<th class="heightHr">Supplier <span class="dividerHr"></span></th>
						<th class="heightHr">Name <span class="dividerHr"></span></th>
						<th class="heightHr">Price <span class="dividerHr"></span></th>
						{{-- <th class="heightHr">Stock <span class="dividerHr"></span></th> --}}
						<th class="center-text">Action</th>
					</tr>
				</thead>
				<tbody>
					@if (count($products))
					@forelse ($products as $product)
					@php
					$low_stock = "";
					if ($product->stock < 5) { $low_stock="bg-danger" ; } @endphp <tr>
						{{-- {{dd($product) }} --}}
						<td style="width: 5%;" class="center-text {{ $low_stock }}">{{ $loop->iteration }}</td>
						<td style="width: 25%; vertical-align: middle;" class="{{ $low_stock }}">{{
							$product->supplier?->name }} </td>
						<td style="width: 40%; vertical-align: middle;" class="{{ $low_stock }}">{{ $product->name.' |
							'.$product->code }}</td>
						<td style="width: 20%; vertical-align: middle" class="{{ $low_stock }}">
							Store : Rp {{ number_format($product->price_store) }} ( {{ $product->discount_store }} %)
							<br>
							OLShop : Rp {{ number_format($product->price_olshop) }} ( {{ $product->discount_olshop }} %)
						</td>
						{{-- <td style="width: 10%; vertical-align: middle" class="{{ $low_stock }}">
							{{ number_format($product->stock) }}
						</td> --}}
						<td style="width: 10%;" class="center-text boxAction fontField {{ $low_stock }}">
							<div class="boxInside">
								@can('P Update')
								<div class="boxEdit">
									<a href="{{ route('product.edit', ['product' => $product]) }}"
										class="btn-sm btn-info" role="button">
										<i class="bx bx-edit"></i>
									</a>
								</div>
								@endcan

								@can('P Update')
								<div class="boxEdit">
									<a href="javascript:void(0)"
										data-url="{{ route('product.show', ['product' => $product]) }}"
										class="btn-sm btn-info btn-show-product" role="button">
										<i class='bx bx-show'></i>
									</a>
								</div>
								@endcan

								<div class="boxEdit">
									<a href="{{ route('product.print', ['product' => $product]) }}" target="_blank"
										class="btn-sm btn-info" role="button">
										<i class='bx bxs-printer'></i>
									</a>
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
				@if ($products->hasPages())
				<div class="boxPagination">
					{{ $products->links('vendor.pagination.bootstrap-4') }}
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

@include('admin.product.detail')
@endpush