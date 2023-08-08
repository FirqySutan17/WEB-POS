

<?php $__env->startSection('title'); ?>
CMS | Add Client Category
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link href="<?php echo e(asset('/assets/css/sweetalert2.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Add Client Category</h3>
<?php $__env->endSlot(); ?>
<?php echo e(Breadcrumbs::render('add_client_category')); ?>

<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <form action="<?php echo e(route('client-categories.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="card _card ">
          <div class="card-body _card-body">
            <div class="row d-flex align-items-stretch">
              <div class="col-12">

                <div class="row">
                  <div class="col-6">
                    <!-- title -->
                    <div class="form-group _form-group">
                      <label for="input_banner_title" class="font-weight-bold">
                        Name <span class="wajib">* </span>
                      </label>
                      <input id="input_banner_title" value="<?php echo e(old('cat_name')); ?>" name="cat_name" type="text" class="form-control <?php $__errorArgs = ['cat_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write name here.." />
                      <?php $__errorArgs = ['cat_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($message); ?></strong>
                      </span>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <!-- end title -->
                  </div>
                  <div class="col-6">
                    <!-- slug -->
                    <div class="form-group _form-group">
                      <label for="input_banner_slug" class="font-weight-bold">
                        Slug
                      </label>
                      <input id="input_banner_slug" value="<?php echo e(old('cat_slug')); ?>" name="cat_slug" type="text" class="form-control <?php $__errorArgs = ['cat_slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Auto Generate" readonly />
                      <?php $__errorArgs = ['cat_slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($message); ?></strong>
                      </span>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <!-- end slug -->
                  </div>

                  <!-- status -->
                  <div class="form-group<?php echo e($errors->has('is_active') ? ' has-error' : ''); ?> _form-group" style="display: flex;">
                    <label for="input_post_status" class="font-weight-bold" style="padding: 7px 0px; margin-right: 20px;">
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
                </div>

                <div class="row d-flex align-items-stretch mt-4">
                  <div class="col-12">
                    <nav>
                      <div class="nav nav-tabs justify-content-center nav-primary" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-id-tab" data-bs-toggle="tab" data-bs-target="#nav-id" type="button" role="tab" aria-controls="nav-id" aria-selected="true">Bahasa</button>
                        <button class="nav-link" id="nav-en-tab" data-bs-toggle="tab" data-bs-target="#nav-en" type="button" role="tab" aria-controls="nav-en" aria-selected="false">English</button>
                      </div>
                    </nav>

                    <div class="tab-content" id="nav-tabContent">
                      <!-- Main Language -->
                      <div class="tab-pane fade show active tab-custom" id="nav-id" role="tabpanel" aria-labelledby="nav-id-tab">
                        <div class="row">
                          <div class="col-6">
                            <!-- title -->
                            <div class="form-group _form-group">
                              <label for="input_idname_title" class="font-weight-bold">
                                Name <span class="wajib">* </span>
                              </label>
                              <input id="input_idname_title" value="<?php echo e(old('id_category_title')); ?>" name="id_category_title" type="text" class="form-control <?php $__errorArgs = ['id_category_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write name here.." />
                              <?php $__errorArgs = ['id_category_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                              <span class="" role="alert">
                                <strong><?php echo e($message); ?></strong>
                              </span>
                              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                          </div>

                          <div class="col-6">
                            <!-- slug -->
                            <div class="form-group _form-group">
                              <label for="input_idname_slug" class="font-weight-bold">
                                Slug
                              </label>
                              <input id="input_idname_slug" value="<?php echo e(old('id_category_slug')); ?>" name="id_category_slug" type="text" class="form-control <?php $__errorArgs = ['id_category_slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Auto Generate" readonly />
                              <?php $__errorArgs = ['id_category_slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                              <span class="" role="alert">
                                <strong><?php echo e($message); ?></strong>
                              </span>
                              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-12">
                            <!-- description -->
                            <div class="form-group _form-group">
                              <label for="input_category_description" class="font-weight-bold">
                                Description
                              </label>
                              <textarea id="input_category_description" name="id_category_desc" class="form-control <?php $__errorArgs = ['id_category_desc'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="5" placeholder="Write desc here.."><?php echo e(old('id_category_desc')); ?></textarea>
                              <?php $__errorArgs = ['id_category_desc'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                              <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($message); ?></strong>
                              </span>
                              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                          </div>
                        </div>

                      </div>
                      <!-- End Main Language -->

                      <!-- Other Language -->
                      <div class="tab-pane fade tab-custom" id="nav-en" role="tabpanel" aria-labelledby="nav-en-tab">
                        <div class="row">
                          <div class="col-6">
                            <!-- title -->
                            <div class="form-group _form-group">
                              <label for="input_enname_title" class="font-weight-bold">
                                Name <span class="wajib">* </span>
                              </label>
                              <input id="input_enname_title" value="<?php echo e(old('en_category_title')); ?>" name="en_category_title" type="text" class="form-control <?php $__errorArgs = ['en_category_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write name here.." />
                              <?php $__errorArgs = ['en_category_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                              <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($message); ?></strong>
                              </span>
                              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                          </div>

                          <div class="col-6">
                            <!-- slug -->
                            <div class="form-group _form-group">
                              <label for="input_enname_slug" class="font-weight-bold">
                                Slug
                              </label>
                              <input id="input_enname_slug" value="<?php echo e(old('en_category_slug')); ?>" name="en_category_slug" type="text" class="form-control <?php $__errorArgs = ['en_category_slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Auto Generate" readonly />
                              <?php $__errorArgs = ['en_category_slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                              <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($message); ?></strong>
                              </span>
                              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-12">
                            <!-- description -->
                            <div class="form-group _form-group">
                              <label for="input_category_description" class="font-weight-bold">
                                Description
                              </label>
                              <textarea id="input_category_description" name="en_category_desc" class="form-control <?php $__errorArgs = ['en_category_desc'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="5" placeholder="Write desc here.."><?php echo e(old('en_category_desc')); ?></textarea>
                              <?php $__errorArgs = ['en_category_desc'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                              <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($message); ?></strong>
                              </span>
                              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                          </div>
                        </div>

                      </div>
                      <!-- End Other Language -->
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-12">
                    <div class="float-right mTop">
                      <a class="btn btn-outline-primary _btn-primary px-4" href="<?php echo e(route('client-categories.index')); ?>">Back</a>
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
<script src="<?php echo e(asset('vendor/select2/js/select2.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/select2/js/' . app()->getLocale() . '.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/laravel-filemanager/js/stand-alone-button.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('javascript-internal'); ?>
<script>
  $(document).ready(function() {
    $("#input_banner_title").change(function(event) {
      $("#input_banner_slug").val(
        event.target.value
        .trim()
        .toLowerCase()
        .replace(/[^a-z\d-]/gi, "-")
        .replace(/-+/g, "-")
        .replace(/^-|-$/g, "")
      );
    });

    $('#button_banner_image').filemanager('image');

  });

  $(document).ready(function() {
    $("#input_idname_title").change(function(event) {
      $("#input_idname_slug").val(
        event.target.value
        .trim()
        .toLowerCase()
        .replace(/[^a-z\d-]/gi, "-")
        .replace(/-+/g, "-")
        .replace(/^-|-$/g, "")
      );
    });
  });

  $(document).ready(function() {
    $("#input_enname_title").change(function(event) {
      $("#input_enname_slug").val(
        event.target.value
        .trim()
        .toLowerCase()
        .replace(/[^a-z\d-]/gi, "-")
        .replace(/-+/g, "-")
        .replace(/^-|-$/g, "")
      );
    });
  });
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Brandztory Projects\brandztory-website\bz-cms\resources\views/admin/client-categories/create.blade.php ENDPATH**/ ?>