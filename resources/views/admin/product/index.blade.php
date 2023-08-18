@extends('layouts.admin.master')

@section('title')
CMS | Product
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.0/jquery.fancybox.min.css" rel="stylesheet" />
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
						@can('Portfolio Create')
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
			<table class="table table-striped">
				<thead>
					<tr>
						<th class="center-text">No <span class="dividerHr"></span></th>
						<th class="heightHr">Name <span class="dividerHr"></span></th>
						<th class="heightHr">Price <span class="dividerHr"></span></th>
						<th class="heightHr">Stock <span class="dividerHr"></span></th>
						<th class="center-text">Action</th>
					</tr>
				</thead>
				<tbody>
					@if (count($products))
					@forelse ($products as $product)
					<tr>
						<td style="width: 5%;" class="center-text">{{ $loop->iteration }}</td>
						<td style="width: 45%; vertical-align: middle">{{ $product->name.' | '.$product->code }}</td>
						<td style="width: 20%; vertical-align: middle">
							Offline Store : Rp {{ number_format($product->price_store) }}
							<br>
							Online Store : Rp {{ number_format($product->price_olshop) }}
						</td>
						<td style="width: 20%; vertical-align: middle">
							Offline Store : {{ number_format($product->stock_store) }}
							<br>
							Online Store : {{ number_format($product->stock_olshop) }}
						</td>
						<td style="width: 10%;" class="center-text boxAction fontField">
							<div class="boxInside">
								@can('Portfolio Update')
								<div class="boxEdit">
									<a href="{{ route('product.edit', ['product' => $product]) }}"
										class="btn-sm btn-info" role="button">
										<i class="bx bx-edit"></i>
									</a>
								</div>
								@endcan

								@can('Portfolio Delete')
								<div class="boxDelete">
									<form action="{{ route('product.destroy', ['product' => $product]) }}"
										method="POST" role="alert">
										@csrf
										@method('DELETE')
										<button type="submit" class="btn btn-sm btn-danger">
											<i class="bx bx-trash"></i>
										</button>
									</form>
								</div>
								@endcan
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.0/jquery.fancybox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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