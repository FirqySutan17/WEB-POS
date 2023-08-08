<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities. laravel/framework: ^8.40">
  <meta name="keywords"
    content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
  <meta name="author" content="pixelstrap">
  <link rel="apple-touch-icon" sizes="180x180" href="{{asset('icon/apple-touch-icon.png')}}" />
  <link rel="icon" type="image/png" sizes="32x32" href="{{asset('icon/favicon-32x32.png')}}" />
  <link rel="icon" type="image/png" sizes="16x16" href="{{asset('icon/favicon-16x16.png')}}" />
  <link rel="manifest" href="{{asset('icon/site.webmanifest')}}" />
  <link rel="mask-icon" href="{{asset('icon/safari-pinned-tab.svg')}}" color="#5bbad5" />
  <meta name="msapplication-TileColor" content="#da532c" />
  <meta name="theme-color" content="#ffffff" />

  <title>@yield('title')</title>
  <!-- Google font-->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
    rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap"
    rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
    rel="stylesheet">
  <!-- Font Awesome-->
  @stack('css')
  @stack('css-internal')
  @stack('css-external')
  @includeIf('layouts.admin.partials.css')

</head>

<body>
  @include('sweetalert::alert')
  <!-- add class="dark-only" for dark themes-->
  <!-- Loader starts-->
  <div class="loader-wrapper">
    <div class="theme-loader"></div>
  </div>
  <!-- Loader ends-->
  <!-- page-wrapper Start-->
  <div class="page-wrapper compact-sidebar" id="pageWrapper">
    <!-- Page Header Start-->
    @includeIf('layouts.admin.partials.header')
    <!-- Page Header Ends -->
    <!-- Page Body Start-->
    <div class="page-body-wrapper sidebar-icon">
      <!-- Page Sidebar Start-->
      @includeIf('layouts.admin.partials.sidebar')
      <!-- Page Sidebar Ends-->
      <div class="page-body" style="transition:none;">
        <!-- Container-fluid starts-->
        @yield('content')
        <!-- Container-fluid Ends-->
      </div>

    </div>
  </div>
  <!-- latest jquery-->
  @includeIf('layouts.admin.partials.js')
  @stack('javascript-internal')
  @stack('javascript-external')
</body>

</html>