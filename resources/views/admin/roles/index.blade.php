@extends('layouts.admin.master')

@section('title')
CMS | Roles
@endsection

@push('css')
<link href="{{ asset('/assets/css/sweetalert2.css') }}" rel="stylesheet">
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Roles</h3>
@endslot
{{ Breadcrumbs::render('roles') }}
@endcomponent

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <div class="boxHeader">
                {{-- filter:start --}}
                <form class="row" method="GET">
                    <div class="col-8">
                        @can('Role Create')
                        <a href="{{ route('roles.create') }}" class="btn btn-primary _btn" role="button">
                            <i class='bx bx-plus'></i> Create Role
                        </a>
                        @endcan
                    </div>
                    <div class="col-4 boxContent">
                        <div class="boxSearch _form-group">
                            <input name="keyword" value="{{ request('keyword') }}" type="search" class="form-control" placeholder="Search for role.." style="border-top-left-radius: 5px; border-bottom-left-radius: 5px; height: 100%">
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
                        <th class="center-text">Role Name <span class="dividerHr"></span></th>
                        <th class="center-text">Description <span class="dividerHr"></span></th>
                        {{-- <th class="center-text">User <span class="dividerHr"></span></th> --}}
                        <th class="center-text">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($roles))
                    @forelse ($roles as $role)
                    <tr>
                        <td style="width: 5%;" class="center-text">{{ $loop->iteration }}</td>
                        <td style="width: 30%;" class="center-text">{{ $role->name }}</td>
                        <td style="width: 55%;" class="center-text">{{ $role->description }}</td>
                        {{-- <td style="width: 20%;" class="center-text">5 users</td> --}}
                        <td style="width: 10%;" class="center-text boxAction fontField">
                            <div class="boxInside">
                                @can('Role Update')
                                <div class="boxEdit">
                                    <a href="{{ route('roles.edit', ['role' => $role]) }}" class="btn-sm btn-info" role="button">
                                        <i class="bx bx-edit"></i>
                                    </a>
                                </div>
                                @endcan

                                @can('Role Delete')
                                <div class="boxDelete">
                                    <form role="alert" action="{{ route('roles.destroy', ['role' => $role]) }}" method="POST">
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
                        <strong> No Role data yet</strong>
                        @endif
                    </p>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="boxFooter">
                @if ($roles->hasPages())
                <div class="boxPagination">
                    {{ $roles->links('vendor.pagination.bootstrap-4') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('/assets/js/sweet-alert/sweetalert.min.js') }}"></script>
<script>
    $('.show_confirm').click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
                title: `Are you sure you want to delete this Role?`,
                text: "the Permission in this Role will be deleted.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
    });
</script>
@endpush