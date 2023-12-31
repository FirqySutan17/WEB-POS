@extends('layouts.admin.master')

@section('title')
CMS | Users
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Users</h3>
@endslot
{{ Breadcrumbs::render('users') }}
@endcomponent

<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<div class="boxHeader">
				{{-- filter:start --}}
				<form class="row" method="GET">
					<div class="col-8">

						<a href="{{ route('users.create') }}" class="btn btn-primary _btn" role="button">
							<i class='bx bx-plus'></i> Add User
						</a>

					</div>
					<div class="col-4 boxContent">
						<div class="boxSearch _form-group">
							<input name="keyword" value="{{ request('keyword') }}" type="search" class="form-control"
								placeholder="Search for user.."
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
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th class="center-text">No <span class="dividerHr"></span></th>
						<th class="center-text">Employee ID <span class="dividerHr"></span></th>
						<th class="center-text heightHr">Name <span class="dividerHr"></span></th>
						<th class="center-text heightHr">Email <span class="dividerHr"></span></th>
						<th class="center-text heightHr">Role <span class="dividerHr"></span></th>
						<th class="center-text heightHr">Status <span class="dividerHr"></span></th>
						<th class="center-text">Action</th>
					</tr>
				</thead>
				<tbody>
					@if (count($users))
					@forelse ($users as $user)
					<tr>
						<td style="width: 5%;" class="center-text">{{ $loop->iteration }}</td>
						<td style="width: 15%;" class="center-text">{{ $user->employee_id }}</td>
						<td style="width: 25%;" class="center-text">{{ $user->name }}</td>
						<td style="width: 15%;" class="center-text">{{ $user->email }}</td>
						<td style="width: 15%;" class="center-text">{{ $user->roles->first()->name??null }}</td>
						<td style="width: 15%;" class="center-text">
							@if ($user->status == 1)
							<span class="status-active">Active</span>
							@else
							<span class="status-nonactive">Suspended</span>
							@endif
						</td>
						<td style="width: 10%;" class="center-text boxAction fontField">
							<div class="boxInside">
								@can('User Update')
								<div class="boxEdit">
									<a href="{{ route('users.edit', ['user' => $user]) }}" class="btn-sm btn-info"
										role="button">
										<i class="bx bx-edit"></i>
									</a>
								</div>
								@endcan

								@can('User Delete')
								<div class="boxDelete">
									<form role="alert" action="{{ route('users.destroy', ['user' => $user]) }}"
										method="POST">
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
						<strong> search not found</strong>
						@else
						<strong> No User data yet</strong>
						@endif
					</p>
					@endif
				</tbody>
			</table>
		</div>
		<div class="card-footer">
			<div class="boxFooter">
				@if ($users->hasPages())
				<div class="boxPagination">
					{{ $users->links('vendor.pagination.bootstrap-4') }}
				</div>
				@endif
			</div>
		</div>
	</div>
</div>

@endsection

@push('javascript-internal')
<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>

<script>
	$(document).ready(function() {
		$("form[role='alert']").submit(function(event) {
			event.preventDefault();
			Swal.fire({
				title: 'Delete User',
				text: 'Are you sure want to remove User?',
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