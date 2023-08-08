

<?php $__env->startSection('title'); ?>
CMS | Edit Career
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Edit Career</h3>
<?php $__env->endSlot(); ?>
<?php echo e(Breadcrumbs::render('edit_career', $career)); ?>

<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<form action="<?php echo e(route('career.update', ['career' => $career])); ?>" method="POST" enctype="multipart/form-data">
				<?php echo method_field('PUT'); ?>
				<?php echo csrf_field(); ?>
                <div class="card _card" style="width: 60%; margin: auto; padding-bottom: 20px">
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
                                            <input id="input_post_title" value="<?php echo e(old('name', $career->name)); ?>" name="name" type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write title here.." />
                                            <?php $__errorArgs = ['name'];
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

                                        <!-- role -->
                                        <div class="form-group _form-group">
                                            <label for="select_user_type" class="font-weight-bold">
                                                Work Type <span class="wajib">*</span>
                                            </label>
                                            <select id="select_user_type" name="work_type" data-placeholder="Choose work type" class="js-example-placeholder-multiple">
                                                <option value="0" <?php echo e($career->work_type == '0' ? 'selected':''); ?>>Choose work type</option>
                                                <option value="Full-Time" <?php echo e($career->work_type == 'Full-Time' ? 'selected':''); ?>>Full-Time</option>
                                                <option value="Part-Time" <?php echo e($career->work_type == 'Part-Time' ? 'selected':''); ?>>Part-Time</option>
                                                <option value="Freelancer" <?php echo e($career->work_type == 'Freelancer' ? 'selected':''); ?>>Freelancer</option>
                                            </select>
                                            <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback">
                                                <?php echo e($message); ?>

                                            </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            <!-- error message -->
                                        </div>
                                        <!-- end role -->

                                    </div>
                                    <div class="col-6">
                                        <!-- slug -->
                                        <div class="form-group _form-group">
                                            <label for="input_post_slug" class="font-weight-bold">
                                                Slug
                                            </label>
                                            <input id="input_post_slug" value="<?php echo e(old('slug', $career->slug)); ?>" name="slug" type="text" class="form-control <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Auto Generate" readonly />
                                            <?php $__errorArgs = ['slug'];
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

                                        <!-- role -->
                                        <div class="form-group _form-group">
                                            <label for="select_user_location" class="font-weight-bold">
                                                Location <span class="wajib">*</span>
                                            </label>
                                            <select id="select_user_location" name="location" data-placeholder="Choose project type" class="custom-select <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                <?php if(old('location', $locationSelected)): ?>
                                                <option value="<?php echo e(old('location', $locationSelected)->id); ?>" selected>
                                                    <?php echo e(old('location', $locationSelected)->name); ?>

                                                </option>
                                                <?php endif; ?>
                                            </select>
                                            <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback">
                                                <?php echo e($message); ?>

                                            </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            <!-- error message -->
                                        </div>
                                        <!-- end role -->
                                        
                                    </div>
                                </div>

                                
                                <div class="form-group  _form-group">
                                    <label for="select_career_skill" class="font-weight-bold">
                                        Mandatory Skill <span class="wajib">*</span>
                                    </label>
                                    <select id="select_career_skill" name="skill[]" data-placeholder="Choose skill" class="custom-select" multiple>
                                        <?php if(old('skill', $career->skills)): ?>
                                        <?php $__currentLoopData = old('skill', $career->skills); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($skill->id); ?>" selected><?php echo e($skill->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                

                                
                                <div class="row req-box">
                                    <div class="col-6">
                                        <p style="vertical-align: middle; font-weight: 600; color: rgba(0, 0, 0, 0.85); padding: 6px 0px;font-size: 13px">Requirements <span class="wajib">*</span></p>
                                    </div>
                                    <div class="col-6" style="float: right; text-align: right">
                                        <button onclick="add_description()" type="button" class="btn btn-primary _btn-primary px-4" style="font-weight: 600">
                                            +
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="mt-2 line-bottom" id="description_group">
                                    <?php if (!empty($req_description)): ?>
                                        <?php foreach ($req_description as $key => $desc): ?>
                                            <?php
                                                $id_req = $key + 1;
                                                $txtarea_id_req = "element_desc_".$id_req;
                                                $item_id_req = "item_".$id_req;
                                            ?>
                                            <div id="<?php echo e($item_id_req); ?>" class="line-bottom">
                                                <div class="row">
                                                    <div class="col-11">
                                                        <div  class="form-group _form-group">
                                                            <input id="<?php echo e($txtarea_id_req); ?>" name="req_description[]" placeholder="Input job requirement" class="form-control description-textarea" value="<?php echo e($desc->description); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-1">
                                                        <div  class="form-group _form-group">
                                                            <div class="float-right">
                                                                <button onclick="delete_description('<?php echo e($item_id_req); ?>')" type="button" class="btn btn-xs btn-danger" style="margin-top: 5px;"><i class="fa fa-trash"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </div>
                                

                                
                                <div class="row req-box">
                                    <div class="col-6">
                                        <p style="vertical-align: middle; font-weight: 600; color: rgba(0, 0, 0, 0.85); padding: 6px 0px;font-size: 13px">Job Description <span class="wajib">*</span></p>
                                    </div>
                                    <div class="col-6" style="float: right; text-align: right">
                                        <button onclick="add_jobdescription()" type="button" class="btn btn-primary _btn-primary px-4" style="font-weight: 600">
                                            +
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="mt-2 line-bottom" id="jobdescription_group">
                                    <?php if (!empty($job_description)): ?>
                                        <?php foreach ($job_description as $key => $desc): ?>
                                            <?php
                                                $id_job = $key + 1;
                                                $txtarea_id_job = "element_desc_".$id_job;
                                                $item_id_job = "item_job_".$id_job;
                                            ?>
                                            <div id="<?php echo e($item_id_job); ?>" class="line-bottom">
                                                <div class="row">
                                                    <div class="col-11">
                                                        <div  class="form-group _form-group">
                                                            <input id="<?php echo e($txtarea_id_job); ?>" name="job_description[]" placeholder="Input job description" class="form-control description-textarea" value="<?php echo e($desc->description); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-1">
                                                        <div  class="form-group _form-group">
                                                            <div class="float-right">
                                                                <button onclick="delete_jobdescription('<?php echo e($item_id_job); ?>')" type="button" class="btn btn-xs btn-danger" style="margin-top: 5px;"><i class="fa fa-trash"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </div>
                                


                                <div class="row req-box">
                                    <div class="col-6">
                                        <p style="vertical-align: middle; font-weight: 600; color: rgba(0, 0, 0, 0.85); padding: 6px 0px;font-size: 13px">Benefits <span class="wajib">*</span></p>
                                    </div>
                                    <div class="col-6" style="float: right; text-align: right">
                                        <button onclick="add_image()" type="button" class="btn btn-primary _btn-primary px-4" style="font-weight: 600">
                                           +
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="mt-2" id="images_group">
                                    <?php if (!empty($job_images)): ?>
                                        <?php foreach ($job_images as $key => $img): ?>
                                            <?php
                                                $id_img = $key + 1;
                                                $txtarea_id_img = "element_desc_".$id_img;
                                                $item_id_img = "item_img_".$id_img;
                                            ?>
                                            <div id="<?php echo e($item_id_img); ?>">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <input type="hidden" name="old_file[]" value="<?php echo e($img->image); ?>">
                                                        <div class="form-group _form-group">
                                                            <input name="image[]" type="file" class="form-control images_data" />
                                                            <?php if (!empty($img->image)): ?>
                                                                <br>
                                                                <a href="<?php echo e(asset('file_upload/'.$img->image)); ?>" target="_blank" class="btn btn-primary">Lihat File</a>
                                                            <?php endif ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-7">
                                                        <div  class="form-group _form-group">
                                                            <input name="benefit_description[]" type="text" class="form-control" placeholder="Input description here" value="<?php echo e($img->name); ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-1">
                                                        <div  class="form-group _form-group">
                                                            <div class="float-right">
                                                                <button onclick="delete_row('<?php echo e($item_id_img); ?>')" type="button" class="btn btn-xs btn-danger" style="margin-top: 5px;"><i class="fa fa-trash"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </div>

                                <!-- status -->
                                <div class="form-group <?php echo e($errors->has('is_active') ? ' has-error' : ''); ?> _form-group" style="display: flex; margin-top: 30px">
                                    <label for="input_banner_status" class="font-weight-bold" style="padding: 7px 0px; margin-right: 20px;">
                                    Status
                                    </label>
                                    <div class="col-2">
                                    <div class="media">
                                        <div class="media-body text-end icon-state">
                                        <label class="switch">
                                            <input type="checkbox" name="is_active" <?php echo e(old("is_active", $career->is_active) == 1  ? "checked"  : null); ?>><span class="switch-state"></span>
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
                                <div class="float-right">
                                    <a class="btn btn-outline-primary _btn-primary px-4" href="<?php echo e(route('career.index')); ?>">Back</a>
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('javascript-external'); ?>
<script src="<?php echo e(asset('vendor/laravel-filemanager/js/stand-alone-button.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/tinymce5/jquery.tinymce.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/tinymce5/tinymce.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/select2/js/select2.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/select2/js/' . app()->getLocale() . '.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
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
  
          $('#button_post_thumbnail').filemanager('image');
  
          $("#input_post_description").tinymce({
              relative_urls: false,
              language: "en",
              height: 300,
              plugins: [
                  "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                  "searchreplace wordcount visualblocks visualchars code fullscreen",
                  "insertdatetime media nonbreaking save table directionality",
                  "emoticons template paste textpattern",
              ],
              toolbar2: "styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
  
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
  <script>
      $(function() {
          $('#select_user_type').select2({
              theme: 'bootstrap4',
              language: "<?php echo e(app()->getLocale()); ?>",
              allowClear: true,
              // ajax: {
              //     url: "<?php echo e(route('roles.select')); ?>",
              //     dataType: 'json',
              //     delay: 250,
              //     processResults: function(data) {
              //         return {
              //             results: $.map(data, function(item) {
              //                 return {
              //                     text: item.name,
              //                     id: item.id
              //                 }
              //             })
              //         };
              //     }
              // }
          });
      });
  
      $(function() {
          $('#select_user_location').select2({
              theme: 'bootstrap4',
              language: "<?php echo e(app()->getLocale()); ?>",
              allowClear: true,
              ajax: {
                  url: "<?php echo e(route('location.select')); ?>",
                  dataType: 'json',
                  delay: 250,
                  processResults: function(data) {
                      return {
                          results: $.map(data, function(item) {
                              return {
                                  text: item.name,
                                  id: item.id
                              }
                          })
                      };
                  }
              }
          });
      });
      //select2 tag
      $('#select_career_skill').select2({
              theme: 'bootstrap4',
              language: "",
              allowClear: true,
              ajax: {
                  url: "<?php echo e(route('skill.select')); ?>",
                  dataType: 'json',
                  delay: 250,
                  processResults: function(data) {
                      return {
                          results: $.map(data, function(item) {
                              return {
                                  text: item.name,
                                  id: item.id
                              }
                          })
                      };
                  }
              }
          });
  
  </script>
<script>
    function add_description() {
        var id = $('.description-textarea').length + 1;
        var txtarea_id = "element_desc_" + id;
        var item_id = "item_" + id;
        var html = `
            <div id="${item_id}" class="line-bottom">
                <div class="row">
                    <div class="col-11">
                        <div  class="form-group _form-group">
                            <input id="${txtarea_id}" name="req_description[]" placeholder="Input job requirement" class="form-control description-textarea">
                        </div>
                    </div>
                    <div class="col-1">
                        <div  class="form-group _form-group">
                            <div class="float-right">
                                <button onclick="delete_description('${item_id}')" type="button" class="btn btn-xs btn-danger" style="margin-top: 5px;"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        $("#description_group").append(html);

    }

    function delete_description(eid) {
        $("#" + eid).remove();
    }

</script>
<script>
    function add_jobdescription() {
        var id_job = $('.jobdescription-textarea').length + 1;
        var txtarea_id_job = "element_desc_job_" + id_job;
        var item_id_job = "item_job_" + id_job;
        var html = `
            <div id="${item_id_job}" class="line-bottom">
                <div class="row">
                    <div class="col-11">
                        <div  class="form-group _form-group">
                            <input id="${txtarea_id_job}" name="job_description[]" placeholder="Input job description" class="form-control jobdescription-textarea">
                        </div>
                    </div>
                    <div class="col-1">
                        <div  class="form-group _form-group">
                            <div class="float-right">
                                <button onclick="delete_jobdescription('${item_id_job}')" type="button" class="btn btn-xs btn-danger" style="margin-top: 5px;"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        $("#jobdescription_group").append(html);

    }

    function delete_jobdescription(eidi) {
        $("#" + eidi).remove();
    }

</script>
<script>
    function add_image() {
        var id_img = $('.images_data').length + 1;
        var txtarea_id_img = "element_desc_" + id_img;
        var item_id_img = "item_img_" + id_img;
        var html = `
            <div id="${item_id_img}">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group _form-group">
                            <input name="image[]" type="file" class="form-control images_data" />
                        </div>
                    </div>
                    <div class="col-7">
                        <div  class="form-group _form-group">
                            <input name="benefit_description[]" type="text" class="form-control" placeholder="Input description here" />
                        </div>
                    </div>
                    <div class="col-1">
                        <div  class="form-group _form-group">
                            <div class="float-right">
                                <button onclick="delete_row('${item_id_img}')" type="button" class="btn btn-xs btn-danger" style="margin-top: 5px;"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        $("#images_group").append(html);

    }

    function delete_row(eide) {
        $("#" + eide).remove();
    }

</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u551360984/domains/lifetime-studios.com/public_html/cms-rimba/resources/views/admin/career/edit.blade.php ENDPATH**/ ?>