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

<div id="dashboard" class="container-fluid"
  style="padding-bottom: 20px; display: flex; align-items: center; justify-content: center;">
  <div class="wrapper-content" style="display: block; text-align: center;">
    <h1>WELCOME TO DASHBOARD</h1>
    <h1>KOONTJIE.ID</h1>
  </div>

</div>
@endsection