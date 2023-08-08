<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities. laravel/framework: ^8.40">
  <meta name="keywords" content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
  <meta name="author" content="pixelstrap">
  <link rel="icon" href="<?php echo e(asset('assets/images/favicon.png')); ?>" type="image/x-icon">
  <link rel="shortcut icon" href="<?php echo e(asset('assets/images/favicon.png')); ?>" type="image/x-icon">
  <title><?php echo $__env->yieldContent('title'); ?></title>
  <!-- Google font-->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
  <!-- Font Awesome-->
  <?php echo $__env->yieldPushContent('css'); ?>
  <?php echo $__env->yieldPushContent('css-internal'); ?>
  <?php echo $__env->yieldPushContent('css-external'); ?>
  <?php if ($__env->exists('layouts.admin.partials.css')) echo $__env->make('layouts.admin.partials.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</head>

<body>
  <?php echo $__env->make('sweetalert::alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <!-- add class="dark-only" for dark themes-->
  <!-- Loader starts-->
  <div class="loader-wrapper">
    <div class="theme-loader"></div>
  </div>
  <!-- Loader ends-->
  <!-- page-wrapper Start-->
  <div class="page-wrapper compact-sidebar" id="pageWrapper">
    <!-- Page Header Start-->
    <?php if ($__env->exists('layouts.admin.partials.header')) echo $__env->make('layouts.admin.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Page Header Ends -->
    <!-- Page Body Start-->
    <div class="page-body-wrapper sidebar-icon">
      <!-- Page Sidebar Start-->
      <?php if ($__env->exists('layouts.admin.partials.sidebar')) echo $__env->make('layouts.admin.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <!-- Page Sidebar Ends-->
      <div class="page-body" style="transition:none;">
        <!-- Container-fluid starts-->
        <?php echo $__env->yieldContent('content'); ?>
        <!-- Container-fluid Ends-->
      </div>

    </div>
  </div>
  <!-- latest jquery-->
  <?php if ($__env->exists('layouts.admin.partials.js')) echo $__env->make('layouts.admin.partials.js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->yieldPushContent('javascript-internal'); ?>
  <?php echo $__env->yieldPushContent('javascript-external'); ?>
</body>

</html><?php /**PATH C:\Brandztory Projects\Check Coding\admin-cms\resources\views/layouts/admin/master.blade.php ENDPATH**/ ?>