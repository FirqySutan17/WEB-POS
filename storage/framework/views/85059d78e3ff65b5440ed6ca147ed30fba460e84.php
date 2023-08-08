

<?php $__env->startSection('title'); ?>
CMS | Company Profile
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/image-style.css')); ?>">
<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/select2.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Contact</h3>
<?php $__env->endSlot(); ?>
<?php echo e(Breadcrumbs::render('contact')); ?>

<?php echo $__env->renderComponent(); ?>

<!-- Container-fluid starts-->
<div class="container-fluid">

  <div class="row">
    <div class="col-12">

      <form action="<?php echo e(route('contact.update', 1)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo method_field('PUT'); ?>
        <?php echo csrf_field(); ?>
        <div class="card _card ">
          <div class="card-body _card-body">
            <div class="row">
              <div class="col-6">
                <?php $__currentLoopData = $email_ones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="form-group _form-group">
                  <label for="input_copyright" class="font-weight-bold"><?php echo e($attribute['name']); ?></label>
                  <input class="form-control" placeholder="Write here.." value="<?php echo e($attribute['value']); ?>" name="<?php echo e($attribute['key']); ?>" type="email" id="input_copyright">
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
              <div class="col-6">
                <?php $__currentLoopData = $email_seconds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="form-group _form-group">
                  <label for="input_copyright" class="font-weight-bold"><?php echo e($attribute['name']); ?></label>
                  <input class="form-control" placeholder="Write here.." value="<?php echo e($attribute['value']); ?>" name="<?php echo e($attribute['key']); ?>" type="email" id="input_copyright">
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                <?php $__currentLoopData = $phone_ones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="form-group _form-group">
                  <label for="input_copyright" class="font-weight-bold"><?php echo e($attribute['name']); ?></label>
                  <input class="form-control" placeholder="Write here.." value="<?php echo e($attribute['value']); ?>" name="<?php echo e($attribute['key']); ?>" type="number" id="input_copyright">
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
              <div class="col-6">
                <?php $__currentLoopData = $phone_seconds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="form-group _form-group">
                  <label for="input_copyright" class="font-weight-bold"><?php echo e($attribute['name']); ?></label>
                  <input class="form-control" placeholder="Write here.." value="<?php echo e($attribute['value']); ?>" name="<?php echo e($attribute['key']); ?>" type="number" id="input_copyright">
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>

            <?php $__currentLoopData = $settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="form-group _form-group">
              <?php if($attribute['type'] == 'text'): ?>
              <label for="input_copyright" class="font-weight-bold"><?php echo e($attribute['name']); ?></label>
              <input class="form-control" placeholder="Write here.." value="<?php echo e($attribute['value']); ?>" name="<?php echo e($attribute['key']); ?>" type="text" id="input_copyright">
              <?php elseif($attribute['type'] == 'number'): ?>
              <label for="input_copyright" class="font-weight-bold"><?php echo e($attribute['name']); ?></label>
              <input class="form-control" placeholder="Write here.." value="<?php echo e($attribute['value']); ?>" name="<?php echo e($attribute['key']); ?>" type="number" id="input_copyright">

              <?php elseif($attribute['type'] == 'file'): ?>
              <label for="input_copyright" class="font-weight-bold"><?php echo e($attribute['name']); ?></label>
              <input class="form-control" value="<?php echo e($attribute['value']); ?>" name="<?php echo e($attribute['key']); ?>" type="file" id="input_copyright">
              <div class="imgBox" style="margin-top: 10px">
                <img src="<?php echo e(env('MEDIA_URL') . $attribute['value']); ?>" alt="" style="width: 250px; height: 125px;object-fit: cover;">
              </div>

              <?php elseif($attribute['type'] == 'email'): ?>
              <label for="input_copyright" class="font-weight-bold"><?php echo e($attribute['name']); ?></label>
              <input class="form-control" placeholder="Write here.." value="<?php echo e($attribute['value']); ?>" name="<?php echo e($attribute['key']); ?>" type="email" id="input_copyright">

              <?php elseif($attribute['type'] == 'textarea'): ?>
              <label for="input_copyright" class="font-weight-bold"><?php echo e($attribute['name']); ?></label>
              <textarea class="form-control" placeholder="Write here.." name="<?php echo e($attribute['key']); ?>" id="input_copyright" rows="5"><?php echo e($attribute['value']); ?></textarea>

              <?php endif; ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="row">
              <div class="col-12">
                <div class="float-right mTop">
                  <a class="btn btn-outline-primary _btn-primary px-4" href="<?php echo e(route('contact.index')); ?>">Back</a>
                  <button type="submit" class="btn btn-primary _btn-primary px-4">
                    Save
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-external'); ?>
<link rel="stylesheet" href="<?php echo e(asset('vendor/select2/css/select2.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('vendor/select2/css/select2-bootstrap4.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('javascript-external'); ?>
<script src="<?php echo e(asset('vendor/laravel-filemanager/js/stand-alone-button.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/tinymce5/jquery.tinymce.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/tinymce5/tinymce.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/select2/js/select2.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/select2/js/' . app()->getLocale() . '.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('javascript-internal'); ?>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Brandztory Projects\brandztory-website\bz-cms\resources\views/admin/website/contact/edit.blade.php ENDPATH**/ ?>