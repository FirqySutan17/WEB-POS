@extends('layouts.admin.master')

@section('title')
CMS | Receive
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.0/jquery.fancybox.min.css" rel="stylesheet" />
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Receive</h3>
@endslot
{{ Breadcrumbs::render('receive') }}
@endcomponent

<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<div class="boxHeader">
				{{-- filter:start --}}
				<form class="row" method="GET">
					<div class="col-8">
						@can('R Create')
						<a href="{{ route('receive.create') }}" class="btn btn-primary _btn" role="button">
							<i class='bx bx-plus'></i> Add new
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
						<th class="heightHr">Receive Code <span class="dividerHr"></span></th>
						<th class="heightHr">Receive Date <span class="dividerHr"></span></th>
						<th class="heightHr">PIC <span class="dividerHr"></span></th>
						<th class="heightHr">Delivery No <span class="dividerHr"></span></th>
						<th class="heightHr">Driver <span class="dividerHr"></span></th>
						<th class="heightHr">Action <span class="dividerHr"></span></th>
					</tr>
				</thead>
				<tbody>
					@if (count($receives))
					@forelse ($receives as $receive)
					<tr>
						<td style="width: 5%;" class="center-text">{{ $loop->iteration }}</td>
						<td style="width: 20%; vertical-align: middle">{{ $receive->receive_code }}</td>
						<td style="width: 15%; vertical-align: middle">{{ $receive->receive_date }}</td>
						<td style="width: 15%; vertical-align: middle">{{ $receive->user->name }}</td>
						<td style="width: 15%; vertical-align: middle"><a
								href="{{ asset('file_upload/'.$receive->delivery_file) }}">{{ $receive->delivery_no
								}}</a></td>
						<td style="width: 20%; vertical-align: middle">{!! empty($receive->driver) ? "Delivery from
							Warehouse" : $receive->driver."<br />".$receive->driver_phone."<br />".$receive->plate_no
							!!}</td>
						<td style="width: 10%; vertical-align: middle">
							<div class="boxEdit">
								<a href="javascript:void(0)"
									data-url="{{ route('receive.show', $receive->receive_code) }}"
									class="btn-sm btn-info btn-show-receive" role="button">
									<i class='bx bx-show'></i>
								</a>
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
				@if ($receives->hasPages())
				<div class="boxPagination">
					{{ $receives->links('vendor.pagination.bootstrap-4') }}
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

@include('admin.receive.show')

@endpush