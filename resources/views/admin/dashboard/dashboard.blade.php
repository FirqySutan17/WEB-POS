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
    {{-- <div class="db-tab">
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
    </div> --}}
    <div class="db-table">
      <div class="db-box">
        <h4>Today Sales</h4>
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
              <?php $total = 0; ?>
              @if (!empty($transactions))
                  @foreach ($transactions as $transaction)
                  <?php $total += $transaction->total_price; ?>
                    <tr class="tr-list">
                      <td style="width: 5%;" class="center-text">{{ $loop->iteration }}</td>
                      <td style="width: 30%; vertical-align: middle; text-align: left">
                          <a href="{{ route('transaction.query', ['transaction' => $transaction]) }}" class="text-primary" target="_blank">
                            {{ $transaction->invoice_no }}
                          </a>
                      </td>
                      <td style="width: 55%; vertical-align: middle; text-align: right">
                        @currency($transaction->total_price)
                      </td>
                    </tr>
                  @endforeach
              @endif

            </tbody>
            <tfoot>
              <tr>
                <th  align="left" colspan="2" style="text-align: left">Grand Total</th>
                <th style="text-align: right">@currency($total)</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <div class="db-box">
        <h4>Montly Sales {{ date('Y') }}</h4>
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th class="center-text">No <span class="dividerHr"></span></th>
                <th class="heightHr" style="text-align: left">Month <span class="dividerHr"></span></th>
                <th class="heightHr" style="text-align: right">Total <span class="dividerHr"></span></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="width: 5%;" class="center-text">1</td>
                <td style="width: 25%; vertical-align: middle; text-align: left">Januari</td>
                <td style="width: 60%; vertical-align: middle; text-align: right">@currency($monthly_sales[1])</td>
              </tr>
              <tr>
                <td style="width: 5%;" class="center-text">2</td>
                <td style="width: 25%; vertical-align: middle; text-align: left">Februari</td>
                <td style="width: 60%; vertical-align: middle; text-align: right">@currency($monthly_sales[2])</td>
              </tr>
              <tr>
                <td style="width: 5%;" class="center-text">3</td>
                <td style="width: 25%; vertical-align: middle; text-align: left">Maret</td>
                <td style="width: 60%; vertical-align: middle; text-align: right">@currency($monthly_sales[3])</td>
              </tr>
              <tr>
                <td style="width: 5%;" class="center-text">4</td>
                <td style="width: 25%; vertical-align: middle; text-align: left">April</td>
                <td style="width: 60%; vertical-align: middle; text-align: right">@currency($monthly_sales[4])</td>
              </tr>
              <tr>
                <td style="width: 5%;" class="center-text">5</td>
                <td style="width: 25%; vertical-align: middle; text-align: left">Mei</td>
                <td style="width: 60%; vertical-align: middle; text-align: right">@currency($monthly_sales[5])</td>
              </tr>
              <tr>
                <td style="width: 5%;" class="center-text">6</td>
                <td style="width: 25%; vertical-align: middle; text-align: left">Juni</td>
                <td style="width: 60%; vertical-align: middle; text-align: right">@currency($monthly_sales[6])</td>
              </tr>
              <tr>
                <td style="width: 5%;" class="center-text">7</td>
                <td style="width: 25%; vertical-align: middle; text-align: left">Juli</td>
                <td style="width: 60%; vertical-align: middle; text-align: right">@currency($monthly_sales[7])</td>
              </tr>
              <tr>
                <td style="width: 5%;" class="center-text">8</td>
                <td style="width: 25%; vertical-align: middle; text-align: left">Agustus</td>
                <td style="width: 60%; vertical-align: middle; text-align: right">@currency($monthly_sales[8])</td>
              </tr>
              <tr>
                <td style="width: 5%;" class="center-text">9</td>
                <td style="width: 25%; vertical-align: middle; text-align: left">September</td>
                <td style="width: 60%; vertical-align: middle; text-align: right">@currency($monthly_sales[9])</td>
              </tr>
              <tr>
                <td style="width: 5%;" class="center-text">10</td>
                <td style="width: 25%; vertical-align: middle; text-align: left">Oktober</td>
                <td style="width: 60%; vertical-align: middle; text-align: right">@currency($monthly_sales[10])</td>
              </tr>
              <tr>
                <td style="width: 5%;" class="center-text">11</td>
                <td style="width: 25%; vertical-align: middle; text-align: left">November</td>
                <td style="width: 60%; vertical-align: middle; text-align: right">@currency($monthly_sales[11])</td>
              </tr>
              <tr>
                <td style="width: 5%;" class="center-text">12</td>
                <td style="width: 25%; vertical-align: middle; text-align: left">Desember</td>
                <td style="width: 60%; vertical-align: middle; text-align: right">@currency($monthly_sales[12])</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection