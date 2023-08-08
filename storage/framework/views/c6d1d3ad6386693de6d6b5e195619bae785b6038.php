

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
<h3>Company Profile</h3>
<?php $__env->endSlot(); ?>
<?php echo e(Breadcrumbs::render('company_profile')); ?>

<?php echo $__env->renderComponent(); ?>

<!-- Container-fluid starts-->
<div class="container-fluid">

  <div class="row">
    <div class="col-12">

      <form action="<?php echo e(route('company-profile.update', 1)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo method_field('PUT'); ?>
        <?php echo csrf_field(); ?>
        <div class="card _card ">
          <div class="card-body _card-body">
            <?php $__currentLoopData = $introductions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="form-group _form-group">
              <label for="input_copyright" class="font-weight-bold"><?php echo e($attribute['name']); ?></label>
              <textarea id="input_post_description" class="form-control" placeholder="Write here.." name="<?php echo e($attribute['key']); ?>" id="input_copyright" rows="5"><?php echo e($attribute['value']); ?></textarea>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php $__currentLoopData = $shorts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="form-group _form-group">
              <label for="input_copyright" class="font-weight-bold"><?php echo e($attribute['name']); ?></label>
              <textarea id="input_introduction_short" class="form-control" placeholder="Write here.." name="<?php echo e($attribute['key']); ?>" id="input_copyright" rows="5"><?php echo e($attribute['value']); ?></textarea>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php $__currentLoopData = $visions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="form-group _form-group">
              <label for="input_copyright" class="font-weight-bold"><?php echo e($attribute['name']); ?></label>
              <textarea id="input_visions" class="form-control" placeholder="Write here.." name="<?php echo e($attribute['key']); ?>" id="input_copyright" rows="5"><?php echo e($attribute['value']); ?></textarea>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php $__currentLoopData = $missions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="form-group _form-group">
              <label for="input_copyright" class="font-weight-bold"><?php echo e($attribute['name']); ?></label>
              <textarea id="input_missions" class="form-control" placeholder="Write here.." name="<?php echo e($attribute['key']); ?>" id="input_copyright" rows="5"><?php echo e($attribute['value']); ?></textarea>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="row">
              <div class="col-12">
                <div class="float-right mTop">
                  <a class="btn btn-outline-primary _btn-primary px-4" href="<?php echo e(route('company-profile.index')); ?>">Back</a>
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
    $("#input_post_description").tinymce({
      relative_urls: false,
      content_style: "body {font-size: 14px; font-family: 'Montserrat', sans-serif; }.mce-content-body[data-mce-placeholder]:not(.mce-visualblocks)::before {color: #bfbfbf; font-size: 14px}",
      language: "en",
      height: "350",
      plugins: [
        "advlist autolink lists link charmap print preview hr anchor pagebreak",
      ],
      toolbar2: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",

      file_picker_callback: function(callback, value, meta) {
        let x = window.innerWidth || document.documentElement.clientWidth || document
          .getElementsByTagName('body')[0].clientWidth;
        let y = window.innerHeight || document.documentElement.clientHeight || document
          .getElementsByTagName('body')[0].clientHeight;

        let cmsURL =
          "<?php echo e(route('unisharp.lfm.show')); ?>" +
          '?editor=' + meta.fieldname;
        if (meta.filetype == 'image') {
          cmsURL = cmsURL + "&type=Images";
        } else {
          cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.openUrl({
          url: cmsURL,
          title: 'Filemanager',
          width: x * 0.8,
          height: y * 0.8,
          resizable: "yes",
          close_previous: "no",
          onMessage: (api, message) => {
            callback(message.content);
          }
        });
      }
    });

    $("#input_introduction_short").tinymce({
      relative_urls: false,
      content_style: "body {font-size: 14px; font-family: 'Montserrat', sans-serif; }.mce-content-body[data-mce-placeholder]:not(.mce-visualblocks)::before {color: #bfbfbf; font-size: 14px}",
      language: "en",
      height: "350",
      plugins: [
        "advlist autolink lists link charmap print preview hr anchor pagebreak",
      ],
      toolbar2: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",

      file_picker_callback: function(callback, value, meta) {
        let x = window.innerWidth || document.documentElement.clientWidth || document
          .getElementsByTagName('body')[0].clientWidth;
        let y = window.innerHeight || document.documentElement.clientHeight || document
          .getElementsByTagName('body')[0].clientHeight;

        let cmsURL =
          "<?php echo e(route('unisharp.lfm.show')); ?>" +
          '?editor=' + meta.fieldname;
        if (meta.filetype == 'image') {
          cmsURL = cmsURL + "&type=Images";
        } else {
          cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.openUrl({
          url: cmsURL,
          title: 'Filemanager',
          width: x * 0.8,
          height: y * 0.8,
          resizable: "yes",
          close_previous: "no",
          onMessage: (api, message) => {
            callback(message.content);
          }
        });
      }
    });

    $("#input_visions").tinymce({
      relative_urls: false,
      content_style: "body {font-size: 14px; font-family: 'Montserrat', sans-serif; }.mce-content-body[data-mce-placeholder]:not(.mce-visualblocks)::before {color: #bfbfbf; font-size: 14px}",
      language: "en",
      height: "350",
      plugins: [
        "advlist autolink lists link charmap print preview hr anchor pagebreak",
      ],
      toolbar2: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",

      file_picker_callback: function(callback, value, meta) {
        let x = window.innerWidth || document.documentElement.clientWidth || document
          .getElementsByTagName('body')[0].clientWidth;
        let y = window.innerHeight || document.documentElement.clientHeight || document
          .getElementsByTagName('body')[0].clientHeight;

        let cmsURL =
          "<?php echo e(route('unisharp.lfm.show')); ?>" +
          '?editor=' + meta.fieldname;
        if (meta.filetype == 'image') {
          cmsURL = cmsURL + "&type=Images";
        } else {
          cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.openUrl({
          url: cmsURL,
          title: 'Filemanager',
          width: x * 0.8,
          height: y * 0.8,
          resizable: "yes",
          close_previous: "no",
          onMessage: (api, message) => {
            callback(message.content);
          }
        });
      }
    });

    $("#input_missions").tinymce({
      relative_urls: false,
      content_style: "body {font-size: 14px; font-family: 'Montserrat', sans-serif; }.mce-content-body[data-mce-placeholder]:not(.mce-visualblocks)::before {color: #bfbfbf; font-size: 14px}",
      language: "en",
      height: "350",
      plugins: [
        "advlist autolink lists link charmap print preview hr anchor pagebreak",
      ],
      toolbar2: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",

      file_picker_callback: function(callback, value, meta) {
        let x = window.innerWidth || document.documentElement.clientWidth || document
          .getElementsByTagName('body')[0].clientWidth;
        let y = window.innerHeight || document.documentElement.clientHeight || document
          .getElementsByTagName('body')[0].clientHeight;

        let cmsURL =
          "<?php echo e(route('unisharp.lfm.show')); ?>" +
          '?editor=' + meta.fieldname;
        if (meta.filetype == 'image') {
          cmsURL = cmsURL + "&type=Images";
        } else {
          cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.openUrl({
          url: cmsURL,
          title: 'Filemanager',
          width: x * 0.8,
          height: y * 0.8,
          resizable: "yes",
          close_previous: "no",
          onMessage: (api, message) => {
            callback(message.content);
          }
        });
      }
    });
  });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Brandztory Projects\brandztory-website\bz-cms\resources\views/admin/website/company-profile/edit.blade.php ENDPATH**/ ?>