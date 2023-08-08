<?php $__env->startSection('title'); ?>
CMS | Edit Banner
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/image-style.css')); ?>">
<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/select2.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Edit Banner</h3>
<?php $__env->endSlot(); ?>
<?php echo e(Breadcrumbs::render('edit_banner', $banner)); ?>

<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <form action="<?php echo e(route('banners.update', ['banner' => $banner])); ?>" method="POST" enctype="multipart/form-data">
        <?php echo method_field('PUT'); ?>
        <?php echo csrf_field(); ?>
        <div class="card ">
          <div class="card-body _card-body">
            <div class="row d-flex align-items-stretch">

              <div class="col-12">

                <!-- title -->
                <div class="form-group _form-group">
                  <label for="input_post_title" class="font-weight-bold">
                    Title <span class="wajib">* </span>
                  </label>
                  <input id="input_post_title" value="<?php echo e(old('banner_title', $banner->banner_title)); ?>" name="banner_title" type="text" class="form-control <?php $__errorArgs = ['banner_title'];
                                                                                                                                                                        $__bag = $errors->getBag($__errorArgs[1] ?? 'default');
                                                                                                                                                                        if ($__bag->has($__errorArgs[0])) :
                                                                                                                                                                          if (isset($message)) {
                                                                                                                                                                            $__messageOriginal = $message;
                                                                                                                                                                          }
                                                                                                                                                                          $message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
                                                                                                                                                                          if (isset($__messageOriginal)) {
                                                                                                                                                                            $message = $__messageOriginal;
                                                                                                                                                                          }
                                                                                                                                                                        endif;
                                                                                                                                                                        unset($__errorArgs, $__bag); ?>" placeholder="Write title here.." />
                  <?php $__errorArgs = ['banner_title'];
                  $__bag = $errors->getBag($__errorArgs[1] ?? 'default');
                  if ($__bag->has($__errorArgs[0])) :
                    if (isset($message)) {
                      $__messageOriginal = $message;
                    }
                    $message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-feedback" role="alert">
                      <strong><?php echo e($message); ?></strong>
                    </span>
                  <?php unset($message);
                    if (isset($__messageOriginal)) {
                      $message = $__messageOriginal;
                    }
                  endif;
                  unset($__errorArgs, $__bag); ?>
                </div>
                <!-- end title -->

                <!-- slug -->
                <div class="form-group _form-group">
                  <label for="input_post_slug" class="font-weight-bold">
                    Slug
                  </label>
                  <input id="input_post_slug" value="<?php echo e(old('banner_slug', $banner->banner_slug)); ?>" name="banner_slug" type="text" class="form-control <?php $__errorArgs = ['banner_slug'];
                                                                                                                                                                    $__bag = $errors->getBag($__errorArgs[1] ?? 'default');
                                                                                                                                                                    if ($__bag->has($__errorArgs[0])) :
                                                                                                                                                                      if (isset($message)) {
                                                                                                                                                                        $__messageOriginal = $message;
                                                                                                                                                                      }
                                                                                                                                                                      $message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
                                                                                                                                                                      if (isset($__messageOriginal)) {
                                                                                                                                                                        $message = $__messageOriginal;
                                                                                                                                                                      }
                                                                                                                                                                    endif;
                                                                                                                                                                    unset($__errorArgs, $__bag); ?>" placeholder="Auto Generate" readonly />
                  <?php $__errorArgs = ['banner_slug'];
                  $__bag = $errors->getBag($__errorArgs[1] ?? 'default');
                  if ($__bag->has($__errorArgs[0])) :
                    if (isset($message)) {
                      $__messageOriginal = $message;
                    }
                    $message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-feedback" role="alert">
                      <strong><?php echo e($message); ?></strong>
                    </span>
                  <?php unset($message);
                    if (isset($__messageOriginal)) {
                      $message = $__messageOriginal;
                    }
                  endif;
                  unset($__errorArgs, $__bag); ?>
                </div>
                <!-- end slug -->

                <div class="row">
                  <div class="col-6">
                    <!-- sequence -->
                    <div class="form-group _form-group">
                      <label for="input_post_title" class="font-weight-bold">
                        Sequence <span class="wajib">* </span>
                      </label>
                      <input value="<?php echo e(old('banner_seq', $banner->banner_seq)); ?>" placeholder="0" name="banner_seq" class="form-control <?php $__errorArgs = ['banner_seq'];
                                                                                                                                                    $__bag = $errors->getBag($__errorArgs[1] ?? 'default');
                                                                                                                                                    if ($__bag->has($__errorArgs[0])) :
                                                                                                                                                      if (isset($message)) {
                                                                                                                                                        $__messageOriginal = $message;
                                                                                                                                                      }
                                                                                                                                                      $message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
                                                                                                                                                      if (isset($__messageOriginal)) {
                                                                                                                                                        $message = $__messageOriginal;
                                                                                                                                                      }
                                                                                                                                                    endif;
                                                                                                                                                    unset($__errorArgs, $__bag); ?>" type="number" value="0" />
                      <?php $__errorArgs = ['banner_seq'];
                      $__bag = $errors->getBag($__errorArgs[1] ?? 'default');
                      if ($__bag->has($__errorArgs[0])) :
                        if (isset($message)) {
                          $__messageOriginal = $message;
                        }
                        $message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" role="alert">
                          <strong><?php echo e($message); ?></strong>
                        </span>
                      <?php unset($message);
                        if (isset($__messageOriginal)) {
                          $message = $__messageOriginal;
                        }
                      endif;
                      unset($__errorArgs, $__bag); ?>
                    </div>
                    <!-- end sequence -->
                  </div>

                  <div class="col-6">
                    <!-- category -->
                    <div class="form-group">
                      <label class="<?php $__errorArgs = ['category'];
                                    $__bag = $errors->getBag($__errorArgs[1] ?? 'default');
                                    if ($__bag->has($__errorArgs[0])) :
                                      if (isset($message)) {
                                        $__messageOriginal = $message;
                                      }
                                      $message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
                                                          if (isset($__messageOriginal)) {
                                                            $message = $__messageOriginal;
                                                          }
                                                        endif;
                                                        unset($__errorArgs, $__bag); ?>" for="select_banner_category">Category</label> <span class="wajib">* </span>
                      <select id="select_banner_category" name="category" data-placeholder="Choose Role" class="js-example-placeholder-multiple">
                        <option value="0">none</option>
                        <?php if (old('category', $categorySelected)) : ?>
                          <option value="<?php echo e(old('category', $categorySelected['id'])); ?>" selected>
                            <?php echo e(old('category', $categorySelected['category_title'])); ?>

                          </option>
                        <?php endif; ?>
                      </select>
                      <?php $__errorArgs = ['category'];
                      $__bag = $errors->getBag($__errorArgs[1] ?? 'default');
                      if ($__bag->has($__errorArgs[0])) :
                        if (isset($message)) {
                          $__messageOriginal = $message;
                        }
                        $message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" role="alert">
                          <strong><?php echo e($message); ?></strong>
                        </span>
                      <?php unset($message);
                        if (isset($__messageOriginal)) {
                          $message = $__messageOriginal;
                        }
                      endif;
                      unset($__errorArgs, $__bag); ?>
                    </div>
                    <!-- end category -->
                  </div>
                </div>

                <!-- image -->
                <div class="form-group _form-group">
                  <label for="upload_img" class="font-weight-bold">
                    Featured Image <span class="wajib">* </span>
                  </label>
                  <input type="file" value="<?php echo e(old('banner_image')); ?>" name="banner_image" require class="form-control <?php $__errorArgs = ['banner_image'];
                                                                                                                                    $__bag = $errors->getBag($__errorArgs[1] ?? 'default');
                                                                                                                                    if ($__bag->has($__errorArgs[0])) :
                                                                                                                                      if (isset($message)) {
                                                                                                                                        $__messageOriginal = $message;
                                                                                                                                      }
                                                                                                                                      $message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
                                                                                                                                      if (isset($__messageOriginal)) {
                                                                                                                                        $message = $__messageOriginal;
                                                                                                                                      }
                                                                                                                                    endif;
                                                                                                                                    unset($__errorArgs, $__bag); ?>" id="upload_img">
                  <img src="<?php echo e(old('banner_image') . env('MEDIA_URL') . $banner->banner_image); ?>" class="d-block" alt="<?php echo e($banner->banner_image); ?>" style="width: 150px; object-fit: cover; margin-top: 10px; border-radius: 5px">
                  <?php $__errorArgs = ['banner_image'];
                  $__bag = $errors->getBag($__errorArgs[1] ?? 'default');
                  if ($__bag->has($__errorArgs[0])) :
                    if (isset($message)) {
                      $__messageOriginal = $message;
                    }
                    $message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-feedback" role="alert">
                      <strong><?php echo e($message); ?></strong>
                    </span>
                  <?php unset($message);
                    if (isset($__messageOriginal)) {
                      $message = $__messageOriginal;
                    }
                  endif;
                  unset($__errorArgs, $__bag); ?>
                </div>
                <!-- end image -->

                <!-- caption -->
                <div class="form-group _form-group">
                  <label for="input_post_caption" class="font-weight-bold">
                    Caption
                  </label>
                  <textarea id="input_post_caption" name="banner_caption" placeholder="Write caption here.." class="form-control <?php $__errorArgs = ['banner_caption'];
                                                                                                                                  $__bag = $errors->getBag($__errorArgs[1] ?? 'default');
                                                                                                                                  if ($__bag->has($__errorArgs[0])) :
                                                                                                                                    if (isset($message)) {
                                                                                                                                      $__messageOriginal = $message;
                                                                                                                                    }
                                                                                                                                    $message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
                                                                                                                                    if (isset($__messageOriginal)) {
                                                                                                                                      $message = $__messageOriginal;
                                                                                                                                    }
                                                                                                                                  endif;
                                                                                                                                  unset($__errorArgs, $__bag); ?>" rows="3"><?php echo e(old('banner_caption', $banner->banner_caption)); ?></textarea>
                  <?php $__errorArgs = ['banner_caption'];
                  $__bag = $errors->getBag($__errorArgs[1] ?? 'default');
                  if ($__bag->has($__errorArgs[0])) :
                    if (isset($message)) {
                      $__messageOriginal = $message;
                    }
                    $message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-feedback" role="alert">
                      <strong><?php echo e($message); ?></strong>
                    </span>
                  <?php unset($message);
                    if (isset($__messageOriginal)) {
                      $message = $__messageOriginal;
                    }
                  endif;
                  unset($__errorArgs, $__bag); ?>
                </div>
                <!-- end caption -->

                <!-- link -->
                <div class="form-group _form-group">
                  <label for="input_post_title" class="font-weight-bold">
                    Link
                  </label>
                  <input id="input_post_title" value="<?php echo e(old('banner_link', $banner->banner_link)); ?>" name="banner_link" type="text" class="form-control <?php $__errorArgs = ['banner_link'];
                                                                                                                                                                      $__bag = $errors->getBag($__errorArgs[1] ?? 'default');
                                                                                                                                                                      if ($__bag->has($__errorArgs[0])) :
                                                                                                                                                                        if (isset($message)) {
                                                                                                                                                                          $__messageOriginal = $message;
                                                                                                                                                                        }
                                                                                                                                                                        $message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
                                                                                                                                                                        if (isset($__messageOriginal)) {
                                                                                                                                                                          $message = $__messageOriginal;
                                                                                                                                                                        }
                                                                                                                                                                      endif;
                                                                                                                                                                      unset($__errorArgs, $__bag); ?>" placeholder="ex: https://brandztory.com" />
                  <?php $__errorArgs = ['banner_link'];
                  $__bag = $errors->getBag($__errorArgs[1] ?? 'default');
                  if ($__bag->has($__errorArgs[0])) :
                    if (isset($message)) {
                      $__messageOriginal = $message;
                    }
                    $message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-feedback" role="alert">
                      <strong><?php echo e($message); ?></strong>
                    </span>
                  <?php unset($message);
                    if (isset($__messageOriginal)) {
                      $message = $__messageOriginal;
                    }
                  endif;
                  unset($__errorArgs, $__bag); ?>
                </div>
                <!-- end link -->

                <!-- status -->
                <div class="form-group <?php echo e($errors->has('is_active') ? ' has-error' : ''); ?> _form-group" style="display: flex;">
                  <label for="input_banner_status" class="font-weight-bold" style="padding: 7px 0px; margin-right: 20px;">
                    Status
                  </label>
                  <div class="col-2">
                    <div class="media">
                      <div class="media-body text-end icon-state">
                        <label class="switch">
                          <input type="checkbox" name="is_active" <?php echo e(old("is_active") == 1  ? "checked"  : null); ?>><span class="switch-state"></span>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end status -->

              </div>
            </div>

            <div class="row">
              <div class="col-12">
                <div class="float-right mTop">
                  <a class="btn btn-outline-secondary _btn-secondary px-4" href="<?php echo e(route('banners.index')); ?>">Back</a>
                  <button type="submit" class="btn btn-primary _btn-primary px-4">
                    Update
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
  });
  //select2 tag
  $('#select_banner_category').select2({
    theme: 'bootstrap4',
    language: "",
    allowClear: true,
    ajax: {
      url: "<?php echo e(route('bannercategories.select')); ?>",
      dataType: 'json',
      delay: 250,
      processResults: function(data) {
        return {
          results: $.map(data, function(item) {
            return {
              text: item.category_title,
              id: item.id
            }
          })
        };
      }
    }
  });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Brandztory Projects\brandztory-website\bz-cms\resources\views/admin/banner/edit.blade.php ENDPATH**/ ?>