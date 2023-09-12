@extends('layouts.admin.master')

@section('title')
CMS | Closing Date
@endsection

@section('content')

@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Closing Date</h3>
@endslot
{{ Breadcrumbs::render('closing_date') }}
@endcomponent

<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <form action="{{ route('closing-date.update', 1) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="card _card" style="margin: auto; padding-bottom: 20px; width: 35%">
          <div class="card-body _card-body">
            <div class="row d-flex align-items-stretch">

              <div class="col-12">

                <!-- current password -->
                <div class="form-group _form-group">
                  <label for="input_start_date" class="font-weight-bold">
                    Start Date
                  </label>
                  <input type="date" class="form-control" name="start_date" value="{{ $closingDate->start_date}}"
                    style="height: 100%; text-align: center; font-size: 14px">
                </div>
                <!-- end current password -->

                <!-- password -->
                <div class="form-group _form-group">
                  <label for="input_end_date" class="font-weight-bold">
                    End Date
                  </label>
                  <input type="date" class="form-control" name="end_date" value="{{ $closingDate->end_date}}"
                    style="height: 100%; text-align: center; font-size: 14px">
                </div>
                <!-- end password -->

              </div>

            </div>

            <div class="row">
              <div class="col-12">
                <div style="width: 100%; display: flex; align-items: center; justify-content: center;">
                  <a style="width: 50%; margin-right: 5px" class="btn btn-outline-primary _btn-primary px-4"
                    href="{{ route('cashflow.index') }}">Back</a>
                  <button style="width: 50%; margin-left: 5px" type="submit" class="btn btn-primary _btn-primary px-4">
                    Save
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

</div>


@endsection