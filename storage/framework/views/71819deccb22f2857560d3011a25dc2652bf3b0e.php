

<?php $__env->startSection('title'); ?>
CMS | Edit Team
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/image-style.css')); ?>">
<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/select2.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Edit Team</h3>
<?php $__env->endSlot(); ?>
<?php echo e(Breadcrumbs::render('edit_team', $team)); ?>

<?php echo $__env->renderComponent(); ?>

<!-- Container-fluid starts-->
<div class="container-fluid">

  <div class="row">
    <div class="col-12">

      <form action="<?php echo e(route('teams.update', ['team' => $team])); ?>" method="POST" enctype="multipart/form-data">
        <?php echo method_field('PUT'); ?>
        <?php echo csrf_field(); ?>
        <div class="card _card">
          <div class="card-body _card-body">
            <div class="row d-flex align-items-stretch">
              <div class="col-12">

                <div class="row">
                  <div class="col-6">
                    <!-- title -->
                    <div class="form-group _form-group">
                      <label for="input_post_title" class="font-weight-bold">
                        Name <span class="wajib">* </span>
                      </label>
                      <input id="input_post_title" value="<?php echo e(old('team_name', $team->team_name)); ?>" name="team_name" type="text" class="form-control <?php $__errorArgs = ['team_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write title here.." />
                      <?php $__errorArgs = ['team_name'];
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
                      <label for="input_post_slug" class="font-weight-bold">
                        Slug
                      </label>
                      <input id="input_post_slug" value="<?php echo e(old('team_slug', $team->team_slug)); ?>" name="team_slug" type="text" class="form-control <?php $__errorArgs = ['team_slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Auto Generate" readonly />
                      <?php $__errorArgs = ['team_slug'];
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
                </div>

                <div class="row">
                  <div class="col-6">
                    <!-- sequence -->
                    <div class="form-group _form-group">
                      <label for="input_post_title" class="font-weight-bold">
                        Sequence
                      </label>
                      <input value="<?php echo e(old('team_seq', $team->team_seq)); ?>" placeholder="0" name="team_seq" class="form-control <?php $__errorArgs = ['team_seq'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="number" value="0" />
                      <?php $__errorArgs = ['team_seq'];
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
                    <!-- end sequence -->
                  </div>
                  <div class="col-6">

                    <!-- position -->
                    <div class="form-group _form-group">
                      <label for="input_post_title" class="font-weight-bold">
                        Position <span class="wajib">* </span>
                      </label>
                      <input id="input_post_title" value="<?php echo e(old('team_position', $team->team_position)); ?>" name="team_position" type="text" class="form-control <?php $__errorArgs = ['team_position'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write position here.." />
                      <?php $__errorArgs = ['team_position'];
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
                    <!-- end twitter -->

                  </div>
                </div>

                <!-- image -->
                <div class="form-group _form-group">
                  <label for="upload_img" class="font-weight-bold">
                    Image <span class="wajib">* </span>
                  </label>
                  <input type="hidden" name="oldImage" value="<?php echo e(old('team_image', $team->team_image)); ?>">
                  
                  <?php if($team->team_image): ?>
                    <img src="<?php echo e(env('MEDIA_URL') . $team->team_image); ?>" alt="<?php echo e($team->team_name); ?>" class="img-preview img-fluid mb-3 col-sm-5 d-block">
                  <?php else: ?>
                    <img class="img-preview img-fluid mb-3 col-sm-5">
                  <?php endif; ?> 
                  
                  <input type="file" name="team_image" require class="form-control <?php $__errorArgs = ['team_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="upload_img" onchange="previewImage()">
                  <?php $__errorArgs = ['team_image'];
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
                <!-- end image -->

                <div class="row">
                  <div class="col-6">
                    <!-- facebook -->
                    <div class="form-group _form-group">
                      <label for="input_post_title" class="font-weight-bold">
                        Facebook
                      </label>
                      <input id="input_post_title" value="<?php echo e(old('team_facebook', $team->team_facebook)); ?>" name="team_facebook" type="text" class="form-control <?php $__errorArgs = ['team_facebook'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="ex: https://brandztory.com" />
                      <?php $__errorArgs = ['team_facebook'];
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
                    <!-- end facebook -->
                  </div>
                  <div class="col-6">
                    <!-- instagram -->
                    <div class="form-group _form-group">
                      <label for="input_post_title" class="font-weight-bold">
                        Instagram
                      </label>
                      <input id="input_post_title" value="<?php echo e(old('team_instagram', $team->team_instagram)); ?>" name="team_instagram" type="text" class="form-control <?php $__errorArgs = ['team_instagram'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="ex: https://brandztory.com" />
                      <?php $__errorArgs = ['team_instagram'];
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
                    <!-- end instagram -->
                  </div>
                </div>

                <div class="row">
                  <div class="col-6">
                    <!-- twitter -->
                    <div class="form-group _form-group">
                      <label for="input_post_title" class="font-weight-bold">
                        Twitter
                      </label>
                      <input id="input_post_title" value="<?php echo e(old('team_twitter', $team->team_twitter)); ?>" name="team_twitter" type="text" class="form-control <?php $__errorArgs = ['team_twitter'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="ex: https://brandztory.com" />
                      <?php $__errorArgs = ['team_twitter'];
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
                    <!-- end twitter -->
                  </div>
                  <div class="col-6">
                    <!-- linkedin -->
                    <div class="form-group _form-group">
                      <label for="input_post_title" class="font-weight-bold">
                        Linked In
                      </label>
                      <input id="input_post_title" value="<?php echo e(old('team_linkedin', $team->team_linkedin)); ?>" name="team_linkedin" type="text" class="form-control <?php $__errorArgs = ['team_linkedin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="ex: https://brandztory.com" />
                      <?php $__errorArgs = ['team_linkedin'];
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
                    <!-- end linkedin -->
                  </div>
                </div>

                <!-- status -->
                <div class="form-group <?php echo e($errors->has('is_active') ? ' has-error' : ''); ?> _form-group" style="display: flex;">
                  <label for="input_banner_status" class="font-weight-bold" style="padding: 7px 0px; margin-right: 20px;">
                    Status
                  </label>
                  <div class="col-2">
                    <div class="media">
                      <div class="media-body text-end icon-state">
                        <label class="switch">
                          <input type="checkbox" name="is_active" <?php echo e(old("is_active", $team->is_active) == 1  ? "checked"  : null); ?>><span class="switch-state"></span>
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
                  <a class="btn btn-outline-secondary _btn-secondary px-4" href="<?php echo e(route('teams.index')); ?>">Back</a>
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
  });

  // Event listener to preview image
  function previewImage() {            
    const image = document.querySelector('#upload_img');
    const imgPreview = document.querySelector('.img-preview');
      
    imgPreview.style.display = 'block';

    const oFReader = new FileReader();            
    oFReader.readAsDataURL(image.files[0]);
          
      oFReader.onload = function(oFREvent) {
        imgPreview.src = oFREvent.target.result;  
      }
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\user01\Documents\CMS\bz-cms\resources\views/admin/teams/edit.blade.php ENDPATH**/ ?>