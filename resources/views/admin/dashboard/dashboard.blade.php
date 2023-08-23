@extends('layouts.admin.master')

@section('title')
CMS | Dashboard
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/chartist.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/date-picker.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/prism.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vector-map.css')}}">
<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
@endpush

@section('content')

<div id="dashboard" class="container-fluid" style="padding-bottom: 20px; display: flex; align-items: center;">
  <div class="wrapper-dashboard" style="display: block; text-align: center; width: 100%">
    <div class="db-tab">
      <div class="db-box">
        <h2>0</h2>
        <p>Montly</p>
        <i class='bx bx-dollar'></i>
      </div>
      <div class="db-box">
        <h2>0</h2>
        <p>Today</p>
        <i class='bx bx-dollar'></i>
      </div>
      <div class="db-box">
        <h2>Rp 0</h2>
        <p>Montly Revenue</p>
        <i class='bx bx-dollar'></i>
      </div>
      <div class="db-box">
        <h2>Rp 0</h2>
        <p>Total Revenue</p>
        <i class='bx bx-dollar'></i>
      </div>
    </div>
    <div class="db-table">
      <div class="db-box">
        <h4>Today Purchase</h4>
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th class="center-text">No <span class="dividerHr"></span></th>
                <th class="heightHr" style="text-align: left">Invoice <span class="dividerHr"></span></th>
                <th class="heightHr" style="text-align: right">Total <span class="dividerHr"></span></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="width: 5%;" class="center-text">1</td>
                <td style="width: 25%; vertical-align: middle; text-align: left">#INV00006</td>
                <td style="width: 60%; vertical-align: middle; text-align: right">
                  Rp 120.000,-
                </td>
              </tr>

              <tr>
                <td style="width: 5%;" class="center-text">2</td>
                <td style="width: 25%; vertical-align: middle; text-align: left">#INV00005</td>
                <td style="width: 60%; vertical-align: middle; text-align: right">
                  Rp 120.000,-
                </td>
              </tr>

              <tr>
                <td style="width: 5%;" class="center-text">3</td>
                <td style="width: 25%; vertical-align: middle; text-align: left">#INV00004</td>
                <td style="width: 60%; vertical-align: middle; text-align: right">
                  Rp 120.000,-
                </td>
              </tr>

              <tr>
                <td style="width: 5%;" class="center-text">4</td>
                <td style="width: 25%; vertical-align: middle; text-align: left">#INV00003</td>
                <td style="width: 60%; vertical-align: middle; text-align: right">
                  Rp 120.000,-
                </td>
              </tr>

              <tr>
                <td style="width: 5%;" class="center-text">5</td>
                <td style="width: 25%; vertical-align: middle; text-align: left">#INV00002</td>
                <td style="width: 60%; vertical-align: middle; text-align: right">
                  Rp 120.000,-
                </td>
              </tr>

              <tr>
                <td style="width: 5%;" class="center-text">6</td>
                <td style="width: 25%; vertical-align: middle; text-align: left">#INV00001</td>
                <td style="width: 60%; vertical-align: middle; text-align: right">
                  Rp 120.000,-
                </td>
              </tr>

              {{-- <table></table>
              <p style="text-align: center; padding-top: 50px;">

                <strong> Search not found</strong>

                <strong> No data yet</strong>

              </p> --}}

            </tbody>
          </table>
        </div>
      </div>
      <div class="db-box">
        <h4>Montly Purchase</h4>
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th class="center-text">No <span class="dividerHr"></span></th>
                <th class="heightHr" style="text-align: left">Invoice <span class="dividerHr"></span></th>
                <th class="heightHr" style="text-align: right">Total <span class="dividerHr"></span></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="width: 5%;" class="center-text">1</td>
                <td style="width: 25%; vertical-align: middle; text-align: left">#INV00006</td>
                <td style="width: 60%; vertical-align: middle; text-align: right">
                  Rp 120.000,-
                </td>
              </tr>

              <tr>
                <td style="width: 5%;" class="center-text">2</td>
                <td style="width: 25%; vertical-align: middle; text-align: left">#INV00005</td>
                <td style="width: 60%; vertical-align: middle; text-align: right">
                  Rp 120.000,-
                </td>
              </tr>

              <tr>
                <td style="width: 5%;" class="center-text">3</td>
                <td style="width: 25%; vertical-align: middle; text-align: left">#INV00004</td>
                <td style="width: 60%; vertical-align: middle; text-align: right">
                  Rp 120.000,-
                </td>
              </tr>

              <tr>
                <td style="width: 5%;" class="center-text">4</td>
                <td style="width: 25%; vertical-align: middle; text-align: left">#INV00003</td>
                <td style="width: 60%; vertical-align: middle; text-align: right">
                  Rp 120.000,-
                </td>
              </tr>

              <tr>
                <td style="width: 5%;" class="center-text">5</td>
                <td style="width: 25%; vertical-align: middle; text-align: left">#INV00002</td>
                <td style="width: 60%; vertical-align: middle; text-align: right">
                  Rp 120.000,-
                </td>
              </tr>

              <tr>
                <td style="width: 5%;" class="center-text">6</td>
                <td style="width: 25%; vertical-align: middle; text-align: left">#INV00001</td>
                <td style="width: 60%; vertical-align: middle; text-align: right">
                  Rp 120.000,-
                </td>
              </tr>

              {{-- <table></table>
              <p style="text-align: center; padding-top: 50px;">

                <strong> Search not found</strong>

                <strong> No data yet</strong>

              </p> --}}

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection