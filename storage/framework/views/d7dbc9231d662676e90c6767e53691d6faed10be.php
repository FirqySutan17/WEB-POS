

<?php $__env->startSection('title'); ?>
CMS | Edit Event
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Edit Event</h3>
<?php $__env->endSlot(); ?>
<?php echo e(Breadcrumbs::render('edit_event', $event)); ?>

<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<form action="<?php echo e(route('event.update', ['event' => $event])); ?>" method="POST" enctype="multipart/form-data">
				<?php echo method_field('PUT'); ?>
				<?php echo csrf_field(); ?>
				<div class="card _card" style="width: 60%; margin: auto; padding-bottom: 20px">
                    <div class="card-body _card-body">
                        <div class="row d-flex align-items-stretch">

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-6">
                                                <!-- title -->
                                                <div class="form-group _form-group">
                                                    <label for="input_post_title" class="font-weight-bold">
                                                        Name <span class="wajib">* </span>
                                                    </label>
                                                    <input id="input_post_title" value="<?php echo e(old('name', $event->name)); ?>" name="name" type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write name here.." />
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

                                                <!-- title -->
                                                <div class="form-group _form-group">
                                                    <label for="input_post_title" class="font-weight-bold">
                                                        Date <span class="wajib">* </span>
                                                    </label>
                                                    <input id="input_post_title" value="<?php echo e(old('date', $event->date)); ?>" name="date" type="date" class="form-control <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write date here.." />
                                                    <?php $__errorArgs = ['date'];
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
                                                    <label for="input_post_slug" class="font-weight-bold">
                                                        Slug
                                                    </label>
                                                    <input id="input_post_slug" value="<?php echo e(old('slug', $event->slug)); ?>" name="slug" type="text" class="form-control <?php $__errorArgs = ['slug'];
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

                                                <!-- Phone Number -->
                                                <div class="form-group _form-group">
                                                    <label for="input_user_alt" class="font-weight-bold">
                                                        Alt Text <span class="wajib">*</span>
                                                    </label>
                                                    <input id="input_user_alt" value="<?php echo e(old('alt_text_cover', $event->alt_text_cover)); ?>" name="alt_text_cover" type="text" class="form-control <?php $__errorArgs = ['alt_text_cover'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Input alt text" />
                                                    <?php $__errorArgs = ['alt_text_cover'];
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
                                                <!-- end name -->
                                            </div>
                                        </div>
                                        
                                        
                                        <!-- thumbnail -->
                                        <div class="form-group _form-group">
                                            <label for="input_post_description" class="font-weight-bold">
                                                Image <span class="wajib">* </span>
                                            </label>
                                            <input name="image_cover" type="file" value="<?php echo e(old('image_cover', $event->image_cover)); ?>" class="form-control" />
                                            <?php if (!empty($event->image_cover)): ?>
                                                <br>
                                                <a href="<?php echo e(asset('file_upload/'.$event->image_cover)); ?>" target="_blank" class="btn btn-primary">Lihat File</a>
                                            <?php endif ?>
                                        </div>

                                        <!-- description -->
                                        <div class="form-group _form-group">
                                            <label for="input_post_description_yes" class="font-weight-bold">
                                                Description <span class="wajib">* </span>
                                            </label>
                                            <textarea id="input_post_description_yes" name="description" placeholder="Write description here.." class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="20"><?php echo e(old('description', $event->description)); ?></textarea>
                                            <?php $__errorArgs = ['description'];
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

                                <!-- description -->
                                <button onclick="add_image()" type="button" class="btn btn-success _btn-success px-4">
                                    Add Image
                                </button>
                                <div class="mt-2" id="images_group">
                                    <?php if (!empty($event_image)): ?>
                                        <?php foreach ($event_image as $key => $img): ?>
                                            <?php
                                                $id = $key + 1;
                                                $txtarea_id = "element_desc_".$id;
                                                $item_id = "item_".$id;
                                            ?>
                                            <div id="<?php echo e($item_id); ?>">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <input type="hidden" name="old_file[]" value="<?php echo e($img->image); ?>">
                                                        <div class="form-group _form-group">
                                                            <label for="input_post_description" class="font-weight-bold">
                                                                Image <span class="wajib">* </span>
                                                            </label>
                                                            <div class="float-right">
                                                                <button onclick="delete_row('<?php echo e($item_id); ?>')" type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                                                            </div>
                                                            <input name="image[]" type="file" class="form-control images_data" />
                                                            <?php if (!empty($img->image)): ?>
                                                                <br>
                                                                <a href="<?php echo e(asset('file_upload/'.$img->image)); ?>" target="_blank" class="btn btn-primary">Lihat File</a>
                                                            <?php endif ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div  class="form-group _form-group">
                                                            <label for="input_post_description" class="font-weight-bold">
                                                                Alt Text 
                                                            </label>
                                                            <input name="alt_text[]" type="text" class="form-control" placeholder="Input alt text" value="<?php echo e($img->alt_text); ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div  class="form-group _form-group">
                                                            <label for="input_post_description" class="font-weight-bold">
                                                                Hover Text 
                                                            </label>
                                                            <input name="hover_text[]" type="text" class="form-control" placeholder="Input hover text" value="<?php echo e($img->hover_text); ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </div>
                                

                            </div>
                        </div>
                        <div class="row">

                            <div class="col-12">
                                <div class="float-right">
                                    <a class="btn btn-outline-primary _btn-primary px-4" href="<?php echo e(route('event.index')); ?>">Back</a>
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
    function add_image() {
        var id = $('.images_data').length + 1;
        var txtarea_id = "element_desc_" + id;
        var item_id = "item_" + id;
        var html = `
            <div id="${item_id}">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group _form-group">
                            <label for="input_post_description" class="font-weight-bold">
                                Image <span class="wajib">* </span>
                            </label>
                            <div class="float-right">
                                <button onclick="delete_row('${item_id}')" type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                            </div>
                            <input name="image[]" type="file" class="form-control images_data" />
                        </div>
                    </div>
                    <div class="col-4">
                        <div  class="form-group _form-group">
                            <label for="input_post_description" class="font-weight-bold">
                                Alt Text 
                            </label>
                            <input name="alt_text[]" type="text" class="form-control" placeholder="Input alt text" />
                        </div>
                    </div>
                    <div class="col-4">
                        <div  class="form-group _form-group">
                            <label for="input_post_description" class="font-weight-bold">
                                Hover Text 
                            </label>
                            <input name="hover_text[]" type="text" class="form-control" placeholder="Input hover text" />
                        </div>
                    </div>
                </div>
            </div>
        `;
        $("#images_group").append(html);

    }

    function delete_row(eid) {
        $("#" + eid).remove();
    }

</script>

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
  
          $("#input_post_description_yes").tinymce({
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Personal\Github\laravel-cms\resources\views/admin/event/edit.blade.php ENDPATH**/ ?>