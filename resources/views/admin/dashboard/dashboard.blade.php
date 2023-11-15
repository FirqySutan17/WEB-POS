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
    grid-template-columns: repeat(8, 1fr);
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
        <p>November 2023</p>
        <div class="table-responsive">
          <ul class="calendar-dashboard">
            <li class="calendar-item"><time datetime="2022-02-01">1</time>Rp 230.000</li>
            <li class="calendar-item"><time datetime="2022-02-02">2</time>Rp 230.000</li>
            <li class="calendar-item"><time datetime="2022-02-03">3</time>Rp 230.000</li>
            <li class="calendar-item"><time datetime="2022-02-04">4</time>Rp 230.000</li>
            <li class="calendar-item"><time datetime="2022-02-05">5</time>Rp 230.000</li>
            <li class="calendar-item"><time datetime="2022-02-06">6</time>Rp 230.000</li>
            <li class="calendar-item"><time datetime="2022-02-07">7</time>Rp 230.000</li>
            <li class="calendar-item"><time datetime="2022-02-08">8</time>Rp 230.000</li>
            <li class="calendar-item"><time datetime="2022-02-09">9</time>Rp 230.000</li>
            <li class="calendar-item"><time datetime="2022-02-10">10</time>Rp 230.000</li>
            <li class="calendar-item"><time datetime="2022-02-11">11</time>Rp 230.000</li>
            <li class="calendar-item"><time datetime="2022-02-12">12</time>Rp 230.000</li>
            <li class="calendar-item"><time datetime="2022-02-13">13</time>Rp 230.000</li>
            <li class="calendar-item"><time datetime="2022-02-14">14</time>Rp 230.000</li>
            <li class="calendar-item"><time datetime="2022-02-15">15</time>Rp 230.000</li>
            <li class="calendar-item"><time datetime="2022-02-16">16</time>Rp 230.000</li>
            <li class="calendar-item"><time datetime="2022-02-17">17</time>Rp 230.000</li>
            <li class="calendar-item"><time datetime="2022-02-18">18</time>Rp 230.000</li>
            <li class="today calendar-item"><time datetime="2022-02-19">19</time>Rp 230.000</li>
            <li class="calendar-item"><time datetime="2022-02-20">20</time>-</li>
            <li class="calendar-item"><time datetime="2022-02-21">21</time>-</li>
            <li class="calendar-item"><time datetime="2022-02-22">22</time>-</li>
            <li class="calendar-item"><time datetime="2022-02-23">23</time>-</li>
            <li class="calendar-item"><time datetime="2022-02-24">24</time>-</li>
            <li class="calendar-item"><time datetime="2022-02-25">25</time>-</li>
            <li class="calendar-item"><time datetime="2022-02-26">26</time>-</li>
            <li class="calendar-item"><time datetime="2022-02-27">27</time>-</li>
            <li class="calendar-item"><time datetime="2022-02-28">28</time>-</li>
            <li class="calendar-item"><time datetime="2022-02-29">29</time>-</li>
            <li class="calendar-item"><time datetime="2022-02-30">30</time>-</li>
            <li class="calendar-item"><time datetime="2022-02-31">31</time>-</li>
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