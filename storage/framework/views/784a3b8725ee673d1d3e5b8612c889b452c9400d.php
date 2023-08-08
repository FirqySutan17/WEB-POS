

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
<h3>Edit Client</h3>
<?php $__env->endSlot(); ?>
<?php echo e(Breadcrumbs::render('edit_client', $client)); ?>

<?php echo $__env->renderComponent(); ?>

<!-- Container-fluid starts-->
<div class="container-fluid">

  <div class="row">
    <div class="col-12">

      <form action="<?php echo e(route('clients.update', ['client' => $client])); ?>" method="POST" enctype="multipart/form-data">
        <?php echo method_field('PUT'); ?>
        <?php echo csrf_field(); ?>
        <div class="card _card ">
          <div class="card-body _card-body">
            
            <div class="row">
              <div class="col-6">
                <!-- title -->
                <div class="form-group _form-group">
                  <label for="input_post_title" class="font-weight-bold">
                    Name <span class="wajib">* </span>
                  </label>
                  <input id="input_post_title" value="<?php echo e(old('client_name', $client->client_name)); ?>" name="client_name" type="text" class="form-control <?php $__errorArgs = ['client_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write name here.." />
                  <?php $__errorArgs = ['client_name'];
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
                  <input id="input_post_slug" value="<?php echo e(old('client_slug', $client->client_slug)); ?>" name="client_slug" type="text" class="form-control <?php $__errorArgs = ['client_slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Auto Generate" readonly />
                  <?php $__errorArgs = ['client_slug'];
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
                    Sequence <span class="wajib">* </span>
                  </label>
                  <input value="<?php echo e(old('client_seq', $client->client_seq)); ?>" placeholder="0" name="client_seq" class="form-control <?php $__errorArgs = ['client_seq'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="number" value="0" />
                  <?php $__errorArgs = ['client_seq'];
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
                <!-- tag -->
                <div class="form-group _form-group">
                  <label for="select_post_tag" class="font-weight-bold">
                    Category
                  </label>
                  <select id="select_post_tag" name="category[]" data-placeholder="" class="custom-select" multiple>
                    <?php if(old('category', $client->categories)): ?>
                    <?php $__currentLoopData = old('category', $client->categories); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>" selected><?php echo e($category->cat_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                  </select>
                </div>
              </div>
            </div>

            <!-- image -->
            <div class="form-group _form-group">
              <label for="upload_img" class="font-weight-bold">
                Featured Image <span class="wajib">* </span>
              </label>
              <input type="hidden" name="oldImage" value="<?php echo e(old('client_image', $client->client_image)); ?>">
              <?php if($client->client_image): ?>
                <img src="<?php echo e(env('MEDIA_URL') . $client->client_image); ?>" alt="<?php echo e($client->client_name); ?>" class="img-preview img-fluid mb-3 col-sm-5 d-block">
              <?php else: ?>
                <img class="img-preview img-fluid mb-3 col-sm-5">
              <?php endif; ?>
              
              <input type="file" name="client_image" require class="form-control <?php $__errorArgs = ['client_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="upload_img" onchange="previewImage()">
              <?php $__errorArgs = ['client_image'];
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

            <!-- status -->
            <div class="form-group <?php echo e($errors->has('is_active') ? ' has-error' : ''); ?> _form-group" style="display: flex;">
              <label for="input_banner_status" class="font-weight-bold" style="padding: 7px 0px; margin-right: 20px;">
                Status
              </label>
              <div class="col-2">
                <div class="media">
                  <div class="media-body text-end icon-state">
                    <label class="switch">
                      <input type="checkbox" name="is_active" <?php echo e(old("is_active", $client->is_active) == 1  ? "checked"  : null); ?>><span class="switch-state"></span>
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <!-- end status -->

            <div class="row">
              <div class="col-12">
                <div class="float-right mTop">
                  <a class="btn btn-outline-primary _btn-primary px-4" href="<?php echo e(route('clients.index')); ?>">Back</a>
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
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Brandztory Projects\brandztory-website\bz-cms\resources\views/admin/clients/edit.blade.php ENDPATH**/ ?>