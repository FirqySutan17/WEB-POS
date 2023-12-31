

<?php $__env->startSection('title'); ?>
CMS | Edit Portfolio
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Edit Portfolio</h3>
<?php $__env->endSlot(); ?>
<?php echo e(Breadcrumbs::render('edit_portfolio', $portfolio)); ?>

<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <form action="<?php echo e(route('portfolio.update', ['portfolio' => $portfolio])); ?>" method="POST"
                enctype="multipart/form-data">
                <?php echo method_field('PUT'); ?>
                <?php echo csrf_field(); ?>
                <div class="card _card" style="margin: auto; padding-bottom: 20px">
                    <div class="card-body _card-body">
                        <div class="row d-flex align-items-stretch">

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <!-- title -->
                                        <div class="form-group _form-group">
                                            <label for="input_post_title" class="font-weight-bold">
                                                Client Name <span class="wajib">* </span>
                                            </label>
                                            <input id="input_post_title"
                                                value="<?php echo e(old('client_name', $portfolio->client_name)); ?>"
                                                name="client_name" type="text"
                                                class="form-control <?php $__errorArgs = ['client_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                placeholder="Input name here" />
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

                                    </div>
                                    <div class="col-6">
                                        <!-- slug -->
                                        <div class="form-group _form-group">
                                            <label for="input_post_slug" class="font-weight-bold">
                                                Slug
                                            </label>
                                            <input id="input_post_slug" value="<?php echo e(old('slug', $portfolio->slug)); ?>"
                                                name="slug" type="text"
                                                class="form-control <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                placeholder="Auto Generate" readonly />
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

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-3">
                                        <!-- Start Year -->
                                        <div class="form-group _form-group">
                                            <label for="datepicker" class="font-weight-bold">
                                                Start Year <span class="wajib">* </span>
                                            </label>
                                            <input id="datepicker"
                                                value="<?php echo e(old('start_year', $portfolio->start_year)); ?>"
                                                name="start_year" type="text"
                                                class="form-control <?php $__errorArgs = ['start_year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                placeholder="Select start year" readonly />
                                            <?php $__errorArgs = ['start_year'];
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
                                    <div class="col-3">
                                        <!-- End Year -->
                                        <div class="form-group _form-group">
                                            <label for="datepickerend" class="font-weight-bold">
                                                End Year <span class="wajib">* </span>
                                            </label>
                                            <input id="datepickerend"
                                                value="<?php echo e(old('end_year', $portfolio->end_year)); ?>" name="end_year"
                                                type="text" class="form-control <?php $__errorArgs = ['end_year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                placeholder="Select end year" readonly />
                                            <?php $__errorArgs = ['end_year'];
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
                                        
                                        <div class="form-group  _form-group">
                                            <label for="select_portfolio_skill" class="font-weight-bold">
                                                Categories <span class="wajib">*</span>
                                            </label>
                                            <select id="select_portfolio_skill" name="skill[]"
                                                data-placeholder="Choose categories" class="custom-select" multiple>
                                                <?php if(old('skill', $portfolio->skills)): ?>
                                                <?php $__currentLoopData = old('skill', $portfolio->skills); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($skill->id); ?>" selected><?php echo e($skill->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        
                                    </div>
                                </div>



                                <!-- title -->
                                <div class="form-group _form-group">
                                    <label for="input_post_company" class="font-weight-bold">
                                        Project Title <span class="wajib">* </span>
                                    </label>
                                    <input id="input_post_company"
                                        value="<?php echo e(old('project_title', $portfolio->project_title)); ?>"
                                        name="project_title" type="text"
                                        class="form-control <?php $__errorArgs = ['project_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        placeholder="Input project title here" />
                                    <?php $__errorArgs = ['project_title'];
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
                                    <label for="input_post_link" class="font-weight-bold">
                                        Visit Link <span class="wajib">* </span>
                                    </label>
                                    <input id="input_post_link" value="<?php echo e(old('link', $portfolio->link)); ?>" name="link"
                                        type="text" class="form-control <?php $__errorArgs = ['link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        placeholder="Input link here" />
                                    <?php $__errorArgs = ['link'];
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

                                <!-- description -->
                                <div class="form-group _form-group">
                                    <label for="input_post_description" class="font-weight-bold">
                                        Description Line 1 <span class="wajib">* </span>
                                    </label>
                                    <textarea id="input_post_description" name="description"
                                        placeholder="Write description here.."
                                        class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        rows="7"><?php echo e(old('description', $portfolio->description)); ?></textarea>
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

                                <!-- description -->
                                <div class="form-group _form-group">
                                    <label for="input_post_description_2" class="font-weight-bold">
                                        Description Line 2 <span class="wajib">* </span>
                                    </label>
                                    <textarea id="input_post_description_2" name="description_2"
                                        placeholder="Write description here.."
                                        class="form-control <?php $__errorArgs = ['description_2'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        rows="7"><?php echo e(old('description_2', $portfolio->description_2)); ?></textarea>
                                    <?php $__errorArgs = ['description_2'];
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

                                <div class="row req-box">
                                    <div class="col-6">
                                        <p
                                            style="vertical-align: middle; font-weight: 600; color: rgba(0, 0, 0, 0.85); padding: 6px 0px;font-size: 13px">
                                            Project MockUp <span class="wajib">*</span></p>
                                    </div>
                                    <div class="col-6" style="float: right; text-align: right">
                                        <button onclick="add_image()" type="button"
                                            class="btn btn-primary _btn-primary px-4" style="font-weight: 600">
                                            +
                                        </button>
                                    </div>
                                </div>

                                <div class="mt-2" id="images_group">
                                    <?php if (!empty($portfolio_image)): ?>
                                    <?php foreach ($portfolio_image as $key => $img): ?>
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
                                                        <button onclick="delete_row('<?php echo e($item_id); ?>')" type="button"
                                                            class="btn btn-xs btn-danger"><i
                                                                class="fa fa-trash"></i></button>
                                                    </div>
                                                    <input name="image[]" type="file"
                                                        class="form-control images_data" />
                                                    <?php if (!empty($img->image)): ?>
                                                    <br>
                                                    <img style="width: 50px; height: 50px; object-fit: cover;"
                                                        src="<?php echo e(asset('file_upload/'.$img->image)); ?>" alt="">
                                                    
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group _form-group">
                                                    <label for="input_post_description" class="font-weight-bold">
                                                        Alt Text
                                                    </label>
                                                    <input name="alt_text[]" type="text" class="form-control"
                                                        placeholder="Input alt text" value="<?php echo e($img->alt_text); ?>" />
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group _form-group">
                                                    <label for="input_post_description" class="font-weight-bold">
                                                        Hover Text
                                                    </label>
                                                    <input name="hover_text[]" type="text" class="form-control"
                                                        placeholder="Input hover text" value="<?php echo e($img->hover_text); ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php endforeach ?>
                                    <?php endif ?>
                                </div>

                                <div class="row req-box">
                                    <div class="col-6">
                                        <p
                                            style="vertical-align: middle; font-weight: 600; color: rgba(0, 0, 0, 0.85); padding: 6px 0px;font-size: 13px">
                                            Project Slider <span class="wajib">*</span></p>
                                    </div>
                                    <div class="col-6" style="float: right; text-align: right">
                                        <button onclick="add_image_slider()" type="button"
                                            class="btn btn-primary _btn-primary px-4" style="font-weight: 600">
                                            +
                                        </button>
                                    </div>
                                </div>

                                <div class="mt-2" id="images_group_slider">
                                    <?php if (!empty($portfolio_slider)): ?>
                                    <?php foreach ($portfolio_slider as $key_slider => $img_slider): ?>
                                    <?php
                                                $id_slider = $key_slider + 1;
                                                $txtarea_slider_id = "element_desc_slider_".$id_slider;
                                                $item_slider_id = "item_slider_".$id_slider;
                                            ?>
                                    <div id="<?php echo e($item_slider_id); ?>">
                                        <div class="row">
                                            <div class="col-4">
                                                <input type="hidden" name="old_file_slider[]"
                                                    value="<?php echo e($img_slider->image_slider); ?>">
                                                <div class="form-group _form-group">
                                                    <label for="input_post_description" class="font-weight-bold">
                                                        Image <span class="wajib">* </span>
                                                    </label>
                                                    <div class="float-right">
                                                        <button onclick="delete_row_slider('<?php echo e($item_slider_id); ?>')"
                                                            type="button" class="btn btn-xs btn-danger"><i
                                                                class="fa fa-trash"></i></button>
                                                    </div>
                                                    <input name="image_slider[]" type="file"
                                                        class="form-control images_data_slider" />
                                                    <?php if (!empty($img_slider->image_slider)): ?>
                                                    <br>
                                                    <img style="width: 50px; height: 50px; object-fit: cover;"
                                                        src="<?php echo e(asset('file_upload/'.$img_slider->image_slider)); ?>"
                                                        alt="">
                                                    
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group _form-group">
                                                    <label for="input_post_description" class="font-weight-bold">
                                                        Alt Text
                                                    </label>
                                                    <input name="alt_text_slider[]" type="text" class="form-control"
                                                        placeholder="Input alt text"
                                                        value="<?php echo e($img_slider->alt_text_slider); ?>" />
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group _form-group">
                                                    <label for="input_post_description" class="font-weight-bold">
                                                        Hover Text
                                                    </label>
                                                    <input name="hover_text_slider[]" type="text" class="form-control"
                                                        placeholder="Input hover text"
                                                        value="<?php echo e($img_slider->hover_text_slider); ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php endforeach ?>
                                    <?php endif ?>
                                </div>

                                <!-- status -->
                                <div class="form-group <?php echo e($errors->has('is_active') ? ' has-error' : ''); ?> _form-group"
                                    style="display: flex; margin-top: 30px">
                                    <label for="input_banner_status" class="font-weight-bold"
                                        style="padding: 7px 0px; margin-right: 20px;">
                                        Status
                                    </label>
                                    <div class="col-2">
                                        <div class="media">
                                            <div class="media-body text-end icon-state">
                                                <label class="switch">
                                                    <input type="checkbox" name="is_active" <?php echo e(old("is_active",
                                                        $portfolio->is_active) == 1 ? "checked" : null); ?>><span
                                                        class="switch-state"></span>
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
                                    <a class="btn btn-outline-primary _btn-primary px-4"
                                        href="<?php echo e(route('portfolio.index')); ?>">Back</a>
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
              toolbar2: "styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link",
  
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

          $("#input_post_description_2").tinymce({
              relative_urls: false,
              language: "en",
              height: 300,
              plugins: [
                  "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                  "searchreplace wordcount visualblocks visualchars code fullscreen",
                  "insertdatetime media nonbreaking save table directionality",
                  "emoticons template paste textpattern",
              ],
              toolbar2: "styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link",
  
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
      //select2 tag
      $('#select_portfolio_skill').select2({
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
      //select2 tag
      $('#select_user_role').select2({
              theme: 'bootstrap4',
              language: "",
              allowClear: true,
              ajax: {
                  url: "<?php echo e(route('project-type.select')); ?>",
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

      function add_image_slider() {
        var id_slider = $('.images_data_slider').length + 1;
        var txtarea_slider_id = "element_desc_slider_" + id_slider;
        var item_slider_id = "item_slider_" + id_slider;
        var html_slider = `
            <div id="${item_slider_id}">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group _form-group">
                            <label for="input_post_description" class="font-weight-bold">
                                Image <span class="wajib">* </span>
                            </label>
                            <div class="float-right">
                                <button onclick="delete_row_slider('${item_slider_id}')" type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                            </div>
                            <input name="image_slider[]" type="file" class="form-control images_data" />
                        </div>
                    </div>
                    <div class="col-4">
                        <div  class="form-group _form-group">
                            <label for="input_post_description" class="font-weight-bold">
                                Alt Text 
                            </label>
                            <input name="alt_text_slider[]" type="text" class="form-control" placeholder="Input alt text" />
                        </div>
                    </div>
                    <div class="col-4">
                        <div  class="form-group _form-group">
                            <label for="input_post_description" class="font-weight-bold">
                                Hover Text 
                            </label>
                            <input name="hover_text_slider[]" type="text" class="form-control" placeholder="Input hover text" />
                        </div>
                    </div>
                </div>
            </div>
        `;
        $("#images_group_slider").append(html_slider);

    }

    function delete_row_slider(eid_slider) {
        $("#" + eid_slider).remove();
    }
  
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Personal\Github\koontjie-be\resources\views/admin/portfolio/edit.blade.php ENDPATH**/ ?>