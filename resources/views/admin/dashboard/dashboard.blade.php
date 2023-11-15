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
<style>
  ul.calendar-dashboard {
    display: grid;
    grid-template-columns: repeat(10, 1fr);
    flex-wrap: wrap;
    list-style: none;
  }

  ul.calendar-dashboard li.calendar-item {
    display: flex;
    width: 100%;
    height: 100%;
    flex-flow: column;
    border-radius: 0.2rem;
    padding: 1rem;
    font-weight: 300;
    font-size: 0.8rem;
    box-sizing: border-box;
    background: rgba(255, 255, 255, 0.25);
    /* box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37); */
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
    border-radius: 10px;
    border: 1px solid rgba(255, 255, 255, 0.18);
    grid-column: span 2;
  }

  ul.calendar-dashboard li.calendar-item time {
    font-size: 20px;
    margin: 0 0 1rem 0;
    font-weight: 500;
  }

  ul.calendar-dashboard li.calendar-item.today {
    background: #a12a2f;
    color: #fff
  }

  ul.calendar-dashboard .today time {
    font-weight: 800;
  }
</style>
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
        <h4>Daily Sales</h4>
        <p>{{ date('M Y') }}</p>
        <div class="table-responsive">
          <ul class="calendar-dashboard">
            @foreach ($daily_sales as $i => $item)
              <li class="{{ $item['date'] == date('Y-m-d') ? 'today' : '' }} calendar-item">
                <a href="{{ $item['date'] == date('Y-m-d') ? route('report.transaction') : 'javascript::void(0)'  }}">
                  <time datetime="{{ $item['date'] }}">
                  {{ $i }}</time>@currency($item["amount"])
                </a>
              </li>
            @endforeach
          </ul>
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