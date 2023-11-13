@extends('layouts.admin.master')

@section('title')
CMS | Common Code
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
<link href="{{ asset('assets/css/fancybox.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Common Code</h3>
@endslot
{{ Breadcrumbs::render('common_code') }}
@endcomponent

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <div class="boxHeader">
                {{-- filter:start --}}
                <form class="row" method="GET">
                    <div class="col-8">
                        <a href="{{ route('common-code.create') }}" class="btn btn-primary _btn" role="button">
                            <i class='bx bx-plus'></i> Add new
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
        <div class="card-body table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="center-text">No <span class="dividerHr"></span></th>
                        <th class="heightHr center-text">Head <span class="dividerHr"></span></th>
                        <th class="heightHr">Code <span class="dividerHr"></span></th>
                        <th class="heightHr">Name <span class="dividerHr"></span></th>
                        <th class="center-text"></th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($commons))
                    @forelse ($commons as $c)
                    <tr>
                        <td style="width: 5%;" class="center-text">{{ $loop->iteration }}</td>
                        <td style="width: 15%; vertical-align: middle" class="center-text">{{ $c->code_head->head }}
                        </td>
                        <td style="width: 15%; vertical-align: middle">{{ $c->code }}</td>
                        <td style="width: 55%; vertical-align: middle">{{ $c->name }}</td>

                        <td style="width: 10%;" class="center-text boxAction fontField">
                            <div class="boxInside">

                                <div class="boxEdit" style="padding-top: 4px">
                                    <a href="{{ route('common-code.edit', ['common_code' => $c]) }}"
                                        class="btn-sm btn-info" role="button">
                                        <i class="bx bx-edit"></i>
                                    </a>
                                </div>

                                <div class="boxDelete">
                                    <form action="{{ route('common-code.destroy', ['common_code' => $c]) }}"
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
                @if ($commons->hasPages())
                <div class="boxPagination">
                    {{ $commons->links('vendor.pagination.bootstrap-4') }}
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