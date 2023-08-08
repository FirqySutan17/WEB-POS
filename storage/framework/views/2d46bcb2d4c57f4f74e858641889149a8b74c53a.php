

<?php $__env->startSection('title'); ?>
CMS | Add Career
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/image-style.css')); ?>">
<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/select2.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Add Career</h3>
<?php $__env->endSlot(); ?>
<?php echo e(Breadcrumbs::render('add_career')); ?>

<?php echo $__env->renderComponent(); ?>

<!-- Container-fluid starts-->
<div class="container-fluid">

  <div class="row">
    <div class="col-12">

      <form action="<?php echo e(route('careers.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="card _card">
          <div class="card-body _card-body">

            <div class="row">
              <div class="col-6 pr">
                <!-- Name -->
                <div class="form-group _form-group">
                  <label for="input_project_title" class="font-weight-bold">
                    Name <span class="wajib">* </span>
                  </label>
                  <input id="input_project_title" value="<?php echo e(old('career_name')); ?>" name="career_name" type="text" class="form-control <?php $__errorArgs = ['career_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write name here.." />
                  <?php $__errorArgs = ['career_name'];
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
                <!-- end name -->

                <div class="row">
                  <div class="col-6">
                    <!-- Location -->
                    <div class="form-group _form-group">
                      <label for="input_project_location" class="font-weight-bold">
                        Location <span class="wajib">* </span>
                      </label>
                      <input id="input_project_title" value="<?php echo e(old('career_location')); ?>" name="career_location" type="text" class="form-control <?php $__errorArgs = ['career_location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="ex: Jakarta, Indonesia" />
                      <?php $__errorArgs = ['career_location'];
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
                    <!-- end Location -->
                  </div>
                  <div class="col-6">
                    <!-- Additional -->
                    <div class="form-group _form-group">
                      <label for="input_project_location" class="font-weight-bold">
                        Additional Information
                      </label>
                      <input id="input_project_title" value="<?php echo e(old('career_info')); ?>" name="career_info" type="text" class="form-control <?php $__errorArgs = ['career_info'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="ex: Internship" />
                      <?php $__errorArgs = ['career_info'];
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
                    <!-- end Additional -->
                  </div>
                </div>

              </div>

              <div class="col-6">
                <!-- slug -->
                <div class="form-group _form-group">
                  <label for="input_project_slug" class="font-weight-bold">
                    Slug
                  </label>
                  <input id="input_project_slug" value="<?php echo e(old('career_slug')); ?>" name="career_slug" type="text" class="form-control <?php $__errorArgs = ['career_slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Auto Generate" readonly />
                  <?php $__errorArgs = ['career_slug'];
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

                <!-- category -->
                <div class="form-group">
                  <label class="<?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" for="select_banner_category">Category</label> <span class="wajib">* </span>
                  <select id="select_banner_category" name="category" data-placeholder="Choose Role" class="js-example-placeholder-multiple">
                    <option value="0">None</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(old('category') == $category->id): ?>
                    <option value="<?php echo e($category->id); ?>" selected><?php echo e($category->category_name); ?></option>
                    <?php else: ?>
                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->category_name); ?></option>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                  <?php $__errorArgs = ['category'];
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
                <!-- end category -->
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
                        <input type="checkbox" name="is_active" <?php echo e(old("is_active") == 1  ? "checked"  : null); ?>><span class="switch-state"></span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end status -->
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
                      <div class="col-12">

                        <!-- Job Description -->
                        <div class="form-group _form-group">
                          <label for="input_post_caption" class="font-weight-bold">
                            Job Description <span class="wajib">* </span>
                          </label>
                          <textarea id="input_post_excerpt" name="id_job_description" placeholder="Write short description here.." class="form-control <?php $__errorArgs = ['id_job_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="3"><?php echo e(old('id_job_description')); ?></textarea>
                          <?php $__errorArgs = ['id_job_description'];
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
                        <!-- end Job Description -->

                        <!-- Job Desk -->
                        <div class="form-group _form-group">
                          <label for="input_post_description" class="font-weight-bold">
                            Job Desk <span class="wajib">* </span>
                          </label>
                          <textarea id="input_post_description" name="id_job_desk" placeholder="Write description here.." class="form-control <?php $__errorArgs = ['id_job_desk'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="20"><?php echo e(old('id_job_desk')); ?></textarea>
                          <?php $__errorArgs = ['id_job_desk'];
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
                        <!-- end Job Desk -->

                        <!-- Job Requirements -->
                        <div class="form-group _form-group">
                          <label for="input_post_caption" class="font-weight-bold">
                            Job Requirements <span class="wajib">* </span>
                          </label>
                          <textarea id="input_post_requirement" name="id_job_requirements" placeholder="Write short description here.." class="form-control <?php $__errorArgs = ['id_job_requirements'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="3"><?php echo e(old('id_job_requirements')); ?></textarea>
                          <?php $__errorArgs = ['id_job_requirements'];
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
                        <!-- end Job Description -->

                      </div>

                    </div>
                  </div>
                  <!-- End Main Language -->

                  <!-- Other Language -->
                  <div class="tab-pane fade tab-custom" id="nav-en" role="tabpanel" aria-labelledby="nav-en-tab">
                    <div class="row">
                      <div class="col-12">

                        <!-- Job Description -->
                        <div class="form-group _form-group">
                          <label for="input_post_caption" class="font-weight-bold">
                            Job Description <span class="wajib">* </span>
                          </label>
                          <textarea id="input_project_excerpt" name="en_job_description" placeholder="Write short description here.." class="form-control <?php $__errorArgs = ['en_job_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="3"><?php echo e(old('en_job_description')); ?></textarea>
                          <?php $__errorArgs = ['en_job_description'];
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
                        <!-- end Job Description -->

                        <!-- Job Desk -->
                        <div class="form-group _form-group">
                          <label for="input_project_description" class="font-weight-bold">
                            Job Desk <span class="wajib">* </span>
                          </label>
                          <textarea id="input_project_description" name="en_job_desk" placeholder="Write description here.." class="form-control <?php $__errorArgs = ['en_job_desk'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="20" style="height: 404px;"><?php echo e(old('en_job_desk')); ?></textarea>
                          <?php $__errorArgs = ['en_job_desk'];
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
                        <!-- end Job Desk -->

                        <!-- Job Requirement -->
                        <div class="form-group _form-group">
                          <label for="input_project_description" class="font-weight-bold">
                            Job Requirement <span class="wajib">* </span>
                          </label>
                          <textarea id="input_project_requirement" name="en_job_requirements" placeholder="Write description here.." class="form-control <?php $__errorArgs = ['en_job_requirements'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="20" style="height: 404px;"><?php echo e(old('en_job_requirements')); ?></textarea>
                          <?php $__errorArgs = ['en_job_requirements'];
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
                        <!-- end Job Requirement -->

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
                  <a class="btn btn-outline-primary _btn-primary px-4" href="<?php echo e(route('careers.index')); ?>">Back</a>
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
    $("#input_project_title").change(function(event) {
      $("#input_project_slug").val(
        event.target.value
        .trim()
        .toLowerCase()
        .replace(/[^a-z\d-]/gi, "-")
        .replace(/-+/g, "-")
        .replace(/^-|-$/g, "")
      );
    });

    $('#button_post_thumbnail').filemanager('image');

    $("#input_post_excerpt").tinymce({
      relative_urls: false,
      content_style: "body {font-size: 14px; font-family: 'Montserrat', sans-serif; }.mce-content-body[data-mce-placeholder]:not(.mce-visualblocks)::before {color: #bfbfbf; font-size: 14px}",
      language: "en",
      height: "300",
      plugins: [
        "lists link hr anchor pagebreak",
        "searchreplace wordcount code",
        "emoticons paste",
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

    $("#input_post_description").tinymce({
      relative_urls: false,
      content_style: "body {font-size: 14px; font-family: 'Montserrat', sans-serif; }.mce-content-body[data-mce-placeholder]:not(.mce-visualblocks)::before {color: #bfbfbf; font-size: 14px}",
      language: "en",
      height: "300",
      plugins: [
        "lists link hr anchor pagebreak",
        "searchreplace wordcount code",
        "emoticons paste",
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

    $("#input_post_requirement").tinymce({
      relative_urls: false,
      content_style: "body {font-size: 14px; font-family: 'Montserrat', sans-serif; }.mce-content-body[data-mce-placeholder]:not(.mce-visualblocks)::before {color: #bfbfbf; font-size: 14px}",
      language: "en",
      height: "300",
      plugins: [
        "lists link hr anchor pagebreak",
        "searchreplace wordcount code",
        "emoticons paste",
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

    $("#input_project_excerpt").tinymce({
      relative_urls: false,
      content_style: "body {font-size: 14px; font-family: 'Montserrat', sans-serif; }.mce-content-body[data-mce-placeholder]:not(.mce-visualblocks)::before {color: #bfbfbf; font-size: 14px}",
      language: "en",
      height: "300",
      plugins: [
        "lists link hr anchor pagebreak",
        "searchreplace wordcount code",
        "emoticons paste",
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

    $("#input_project_description").tinymce({
      relative_urls: false,
      content_style: "body {font-size: 14px; font-family: 'Montserrat', sans-serif; }.mce-content-body[data-mce-placeholder]:not(.mce-visualblocks)::before {color: #bfbfbf; font-size: 14px}",
      language: "en",
      height: "300",
      plugins: [
        "lists link hr anchor pagebreak",
        "searchreplace wordcount code",
        "emoticons paste",
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

    $("#input_project_requirement").tinymce({
      relative_urls: false,
      content_style: "body {font-size: 14px; font-family: 'Montserrat', sans-serif; }.mce-content-body[data-mce-placeholder]:not(.mce-visualblocks)::before {color: #bfbfbf; font-size: 14px}",
      language: "en",
      height: "300",
      plugins: [
        "lists link hr anchor pagebreak",
        "searchreplace wordcount code",
        "emoticons paste",
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

    //select2 tag
    $('#select_banner_category').select2({
      theme: 'bootstrap4',
      language: "",
      allowClear: true,
      ajax: {
        url: "<?php echo e(route('careercategories.select')); ?>",
        dataType: 'json',
        delay: 250,
        processResults: function(data) {
          return {
            results: $.map(data, function(item) {
              return {
                text: item.category_name,
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
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Brandztory Projects\brandztory-website\bz-cms\resources\views/admin/careers/create.blade.php ENDPATH**/ ?>