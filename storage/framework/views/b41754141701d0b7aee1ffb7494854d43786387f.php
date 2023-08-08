

<?php $__env->startSection('title'); ?>
CMS | Dashboard
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/animate.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/chartist.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/date-picker.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/prism.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vector-map.css')); ?>">
<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<div id="dashboard" class="container-fluid"
  style="padding-bottom: 20px; display: flex; align-items: center; justify-content: center;">
  <div class="wrapper-content" style="display: block; text-align: center;">
    <h1>WELCOME TO DASHBOARD</h1>
    <h1>KOONTJIE.ID</h1>
  </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Personal\Github\koontjie-be\resources\views/admin/dashboard/dashboard.blade.php ENDPATH**/ ?>