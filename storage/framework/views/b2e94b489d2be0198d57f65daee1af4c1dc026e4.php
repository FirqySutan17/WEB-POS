

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

<div id="dashboard" class="container-fluid" style="padding-bottom: 20px;">
  <div class="wrapperDashboard">

    <div class="squareContent">
      <div class="boxIcon">
        <i class='bx bx-window'></i>
      </div>
      <div class="boxContent">
        <h5>10</h5>
        <h6>Banner</h6>

        <div class="btnWrap">
          <a href="#">See more <i class='bx bx-right-arrow-circle'></i></a>
        </div>
      </div>
    </div>

    <div class="squareContent">
      <div class="boxIcon">
        <i class='bx bxs-news'></i>
      </div>
      <div class="boxContent">
        <h5>11</h5>
        <h6>Post</h6>

        <div class="btnWrap">
          <a href="#">See more <i class='bx bx-right-arrow-circle'></i></a>
        </div>
      </div>
    </div>

    <div class="squareContent">
      <div class="boxIcon">
        <i class='bx bx-question-mark'></i>
      </div>
      <div class="boxContent">
        <h5>12</h5>
        <h6>Placeholder</h6>

        <div class="btnWrap">
          <a href="#">See more <i class='bx bx-right-arrow-circle'></i></a>
        </div>
      </div>
    </div>

    <div class="squareContent">
      <div class="boxIcon">
        <i class='bx bx-question-mark'></i>
      </div>
      <div class="boxContent">
        <h5>12</h5>
        <h6>Placeholder</h6>

        <div class="btnWrap">
          <a href="#">See more <i class='bx bx-right-arrow-circle'></i></a>
        </div>
      </div>
    </div>

  </div>

  <div class="wrapperContentDashboard">
    <div class="left-side">

      

    </div>
    <div class="divider">

    </div>
    <div class="right-side">


    </div>

  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Personal\Github\laravel-cms\resources\views/admin/dashboard/dashboard.blade.php ENDPATH**/ ?>