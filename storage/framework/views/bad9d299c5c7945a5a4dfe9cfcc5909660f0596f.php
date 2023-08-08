

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
        <h5><?php echo e($banner); ?></h5>
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
        <h5><?php echo e($post); ?></h5>
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
        <h5><?php echo e($banner); ?></h5>
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
        <h5><?php echo e($banner); ?></h5>
        <h6>Placeholder</h6>

        <div class="btnWrap">
          <a href="#">See more <i class='bx bx-right-arrow-circle'></i></a>
        </div>
      </div>
    </div>

  </div>

  <div class="wrapperContentDashboard">
    <div class="left-side">

      <div class="card">
        <div class="card-body">
          <h6>Post</h6>
          <table class="display" id="advance-12">
            <thead>
              <tr>
                <th style="width: 23%;">Title <span class="dividerHr"></span></th>
                <th style="width: 45%;">Description <span class="dividerHr"></span></th>
                <th style="width: 15%;" class="center-text">Category <span class="dividerHr"></span></th>
                <th style="width: 12%;" class="center-text">Date <span class="dividerHr"></span></th>
                <th class="center-text widthCustom5">Status</th>
            </thead>
            <tbody>
              <?php if(count($posts)): ?>
              <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <tr>
                <td class="fontField"><?php echo e($post->post_title); ?></td>
                <td class="fontField"><?php echo \Illuminate\Support\Str::limit($post->post_excerpt, 150); ?></td>
                <td class="center-text fontField"><?php echo e($post->category->category_title); ?></td>
                <td class="center-text fontField"><?php echo e($post->created_at->format('D, d M y')); ?></td>
                <td class="center-text fontField">
                  <?php if($post->is_active == 1): ?>
                  <span class="status-active">Published</span>
                  <?php else: ?>
                  <span class="status-nonactive">Draft</span>
                  <?php endif; ?>
                </td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php else: ?>
              <table></table>
              <p style="text-align: center; padding-top: 50px;">
                <strong> No post data yet</strong>
              </p>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <h6>Banner</h6>
          <table class="display" id="advance-112">
            <thead>
              <tr>
                <th style="width: 4%;" class="center-text">Seq <span class="dividerHr"></span></th>
                <th style="width: 31%;">Image <span class="dividerHr"></span></th>
                <th style="width: 45%;">Title <span class="dividerHr"></span></th>
                <th style="width: 10%;" class="center-text">Category <span class="dividerHr"></span></th>
                <th style="width: 10%;" class="center-text">Status</th>
            </thead>
            <tbody>
              <?php if(count($banners)): ?>
              <?php $__empty_2 = true; $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
              <tr>
                <td style="width: 4%;" class="center-text fontField"><?php echo e($banner->banner_seq); ?></td>
                <td style="width: 31%;" class="fontField" style="vertical-align: middle;"> <img src="<?php echo e(env('MEDIA_URL') . $banner->banner_image); ?>" alt="" style="width: 95%; height: 120px; border-radius: 5px; object-fit: cover;"></td>
                <td style="width: 45%;" class="fontField" style="vertical-align: middle;"><?php echo e($banner->banner_title); ?></td>
                <td style="width: 10%;" class="center-text fontField"><?php echo e($banner->category->category_title); ?></td>
                <td style="width: 10%;" class="center-text fontField">
                  <?php if($banner->is_active == 1): ?>
                  <span class="status-active">Published</span>
                  <?php else: ?>
                  <span class="status-nonactive">Draft</span>
                  <?php endif; ?>
                </td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php else: ?>
              <table></table>
              <p style="text-align: center; padding-top: 50px;">
                <strong> No banner data yet</strong>
              </p>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>
    <div class="divider">

    </div>
    <div class="right-side">

      <div class="card" style="height: 100%;">
        <div class="card-body">
          <h6>Member</h6>
          <table class="display" id="advance-113">
            <thead>
              <tr>
                <th style="width: 50%;vertical-align: middle;">Name <span class="dividerHr"></span></th>
                <th style="width: 50%;vertical-align: middle; text-align: center;">Role</th>
              </tr>
            </thead>
            <tbody>
              <?php if(count($users)): ?>
              <?php $__empty_3 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_3 = false; ?>
              <tr>
                <td style="width: 50%; vertical-align: middle;" class="fontField"><?php echo e($user->name); ?></td>
                <td style="width: 50%; vertical-align: middle; text-align: center;" class="fontField"><?php echo e($user->roles->first()->name??null); ?></td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php else: ?>
              <table></table>
              <p style="text-align: center; padding-top: 50px;">
                <strong> No user data yet</strong>
              </p>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\user01\Documents\CMS\bz-cms\resources\views/admin/dashboard/dashboard.blade.php ENDPATH**/ ?>