

<?php $__env->startSection('title'); ?>
CMS | Edit Client
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/image-style.css')); ?>">
<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/select2.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Website Settings</h3>
<?php $__env->endSlot(); ?>
<?php echo e(Breadcrumbs::render('website')); ?>

<?php echo $__env->renderComponent(); ?>

<!-- Container-fluid starts-->
<div class="container-fluid">

  <div class="row">
    <div class="col-12">

      <form action="<?php echo e(route('website-settings.update', 1)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo method_field('PUT'); ?>
        <?php echo csrf_field(); ?>
        <div class="card _card ">
          <div class="card-body _card-body">

            <div class="mb-3 row">
              <?php $__currentLoopData = $settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if($attribute['type'] == 'text'): ?>
              <label for="input_copyright" class="col-sm-2 col-form-label"><?php echo e($attribute['name']); ?></label>
              <div class="col-sm-10">
                <input class="form-control" value="<?php echo e($attribute['value']); ?>" name="<?php echo e($attribute['key']); ?>" type="text" id="input_copyright">
              </div>
              <?php elseif($attribute['type'] == 'number'): ?>
              <label for="input_copyright" class="col-sm-2 col-form-label"><?php echo e($attribute['name']); ?></label>
              <div class="col-sm-10">
                <input class="form-control" value="<?php echo e($attribute['value']); ?>" name="<?php echo e($attribute['key']); ?>" type="number" id="input_copyright">
              </div>
              <?php elseif($attribute['type'] == 'file'): ?>
              <label for="input_copyright" class="col-sm-2 col-form-label"><?php echo e($attribute['name']); ?></label>
              <div class="col-sm-10">
                <input class="form-control" value="<?php echo e($attribute['value']); ?>" name="<?php echo e($attribute['key']); ?>" type="file" id="input_copyright">
              </div>
              <?php elseif($attribute['type'] == 'email'): ?>
              <label for="input_copyright" class="col-sm-2 col-form-label"><?php echo e($attribute['name']); ?></label>
              <div class="col-sm-10">
                <input class="form-control" value="<?php echo e($attribute['value']); ?>" name="<?php echo e($attribute['key']); ?>" type="email" id="input_copyright">
              </div>
              <?php elseif($attribute['type'] == 'textarea'): ?>
              <label for="input_copyright" class="col-sm-2 col-form-label"><?php echo e($attribute['name']); ?></label>
              <div class="col-sm-10">
                <textarea class="form-control" name="<?php echo e($attribute['key']); ?>" id="input_copyright" rows="5"><?php echo e($attribute['value']); ?></textarea>
              </div>
              <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="row">
              <div class="col-12">
                <div class="float-right mTop">
                  <a class="btn btn-outline-primary _btn-primary px-4" href="<?php echo e(route('website-settings.index')); ?>">Back</a>
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
<script>
  $(document).ready(function() {
    $("#input_post_title").change(function(event) {
      $("#input_post_slug").val(
        event.target.value
        .trim()
        .toLowerCase()
        .replace(/[^a-z\d-]/gi, "-")
        .replace(/-+/g, "-")
        .replace(/^-|-$/g, "")
      );
    });

    //select2 tag
    $('#select_post_tag').select2({
      theme: 'bootstrap4',
      language: "",
      allowClear: true,
      ajax: {
        url: "<?php echo e(route('clientcategories.select')); ?>",
        dataType: 'json',
        delay: 250,
        processResults: function(data) {
          return {
            results: $.map(data, function(item) {
              return {
                text: item.cat_name,
                id: item.id
              }
            })
          };
        }
      }
    });

  });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Brandztory Projects\brandztory-website\bz-cms\resources\views/admin/website/edit.blade.php ENDPATH**/ ?>