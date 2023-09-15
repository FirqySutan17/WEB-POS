@extends('layouts.admin.master')

@section('title')
CMS | Cashflow
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.0/jquery.fancybox.min.css" rel="stylesheet" />
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Cashflow</h3>
@endslot
{{ Breadcrumbs::render('cashflow') }}
@endcomponent

<div class="container-fluid">
    <div class="wrap-cashier">
        @if(Auth::user()->roles->first()->name == 'Cashier')
        <div class="menu-rt">
            <a class="{{routeActive('transaction.create')}}" href="{{ route('transaction.create') }}">Transaction</a>
            <a class="{{routeActive('transaction.listdraft')}}" href="{{ route('transaction.listdraft') }}">Draft</a>
            <a class="{{routeActive('transaction.index')}}" href="{{ route('transaction.index') }}">List</a>
            <a class="{{routeActive('cashflow.index')}}" href="{{ route('cashflow.index') }}">Cash Flow</a>
            <a class="{{routeActive('shift.index')}}" href="{{ route('shift.index') }}">Shift Management</a>

            <button class="btn " type="button">
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class='bx bx-log-out-circle'></i> {{__('Logout') }}
                </a>
            </button>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
        @endif
    </div>
    <div class="card">
        <div class="card-header">
            <div class="boxHeader">
                {{-- filter:start --}}
                <form class="row" method="GET">
                    <div class="col-8">

                        <a href="{{ route('cashflow.create') }}" class="btn btn-primary _btn" role="button">
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
                        <th class="heightHr center-text">Datetime <span class="dividerHr"></span></th>
                        <th class="heightHr">Cashier <span class="dividerHr"></span></th>
                        <th class="heightHr">Categories <span class="dividerHr"></span></th>
                        <th class="heightHr">Description <span class="dividerHr"></span></th>
                        <th class="center-text">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($cashflow))
                    @forelse ($cashflow as $cl)
                    <tr>
                        <td style="width: 5%;" class="center-text">{{ $loop->iteration }}</td>
                        <td class="center-text" style="width: 15%; vertical-align: middle">
                            {{ $cl->date." ".$cl->time }}
                        </td>
                        <td style="width: 20%; vertical-align: middle">{{ $cl->user?->name }}</td>
                        <td style="width: 20%; vertical-align: middle">{{ $cl->categories }}</td>
                        <td style="width: 30%; vertical-align: middle">{!! $cl->description !!}</td>
                        <td style="width: 10%;" class="center-text boxAction fontField">@currency($cl->cash)</td>
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
                @if ($cashflow->hasPages())
                <div class="boxPagination">
                    {{ $cashflow->links('vendor.pagination.bootstrap-4') }}
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