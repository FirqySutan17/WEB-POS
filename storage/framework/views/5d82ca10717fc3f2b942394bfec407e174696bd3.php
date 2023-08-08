

<?php $__env->startSection('title'); ?>
CMS | Add Post
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/image-style.css')); ?>">
<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/select2.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Add Post</h3>
<?php $__env->endSlot(); ?>
<?php echo e(Breadcrumbs::render('add_post')); ?>

<?php echo $__env->renderComponent(); ?>

<!-- Container-fluid starts-->
<div class="container-fluid">

    <div class="row">
        <div class="col-12">

            <form action="<?php echo e(route('posts.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="card">
                    <div class="card-body _card-body">
                        <div class="row d-flex align-items-stretch">

                            <div class="col-6 pr">

                                <!-- title -->
                                <div class="form-group _form-group">
                                    <label for="input_post_title" class="font-weight-bold">
                                        Title <span class="wajib">* </span>
                                    </label>
                                    <input id="input_post_title" value="<?php echo e(old('post_title')); ?>" name="post_title" type="text" class="form-control <?php $__errorArgs = ['post_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write title here.." />
                                    <?php $__errorArgs = ['post_title'];
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

                                <!-- category -->
                                <div class="form-group">
                                    <label class="<?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" for="select_category">Category</label> <span class="wajib">* </span>
                                    <select id="select_post_category" name="category" data-placeholder="Choose Role" class="js-example-placeholder-multiple">
                                        <option value="0">none</option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(old('category') == $category->id): ?>
                                        <option value="<?php echo e($category->id); ?>" selected><?php echo e($category->category_title); ?></option>
                                        <?php else: ?>
                                        <option value="<?php echo e($category->id); ?>"><?php echo e($category->category_title); ?></option>
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

                            <div class="col-6 pl">
                                <!-- slug -->
                                <div class="form-group _form-group">
                                    <label for="input_post_slug" class="font-weight-bold">
                                        Slug
                                    </label>
                                    <input id="input_post_slug" value="<?php echo e(old('post_slug')); ?>" name="post_slug" type="text" class="form-control <?php $__errorArgs = ['post_slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Auto Generate" readonly />
                                    <?php $__errorArgs = ['post_slug'];
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

                                <!-- image -->
                                <div class="form-group _form-group">
                                    <label for="upload_img" class="font-weight-bold">
                                        Featured Image <span class="wajib">* </span>
                                    </label>
                                    <input type="file" value="<?php echo e(old('post_thumbnail')); ?>" name="post_thumbnail" require class="form-control <?php $__errorArgs = ['post_thumbnail'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="upload_img">
                                    <?php $__errorArgs = ['post_thumbnail'];
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
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">

                                <!-- caption -->
                                <div class="form-group _form-group">
                                    <label for="input_post_caption" class="font-weight-bold">
                                        Short Description <span class="wajib">* </span>
                                    </label>
                                    <textarea id="input_post_caption" name="post_excerpt" placeholder="Write short description here.." class="form-control <?php $__errorArgs = ['post_excerpt'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="3"><?php echo e(old('post_excerpt')); ?></textarea>
                                    <?php $__errorArgs = ['post_excerpt'];
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
                                <!-- end caption -->

                                <!-- description -->
                                <div class="form-group _form-group">
                                    <label for="input_post_description" class="font-weight-bold">
                                        Description <span class="wajib">* </span>
                                    </label>
                                    <textarea id="input_post_description" name="post_desc" placeholder="Write description here.." class="form-control <?php $__errorArgs = ['post_desc'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="20"><?php echo e(old('post_desc')); ?></textarea>
                                    <?php $__errorArgs = ['post_desc'];
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
                                <!-- end description -->

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6 pr">
                                <!-- tag -->
                                <div class="form-group _form-group">
                                    <label for="select_post_tag" class="font-weight-bold">
                                        Tag
                                    </label>
                                    <select id="select_post_tag" name="tag[]" data-placeholder="Select tag" class="js-example-placeholder-multiple" multiple>

                                    </select>
                                </div>
                                <!-- end tag -->

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
                            <div class="col-6 pl">

                                <!-- meta_title -->
                                <div class="form-group _form-group">
                                    <label for="input_post_meta_title" class="font-weight-bold">
                                        Meta Title (SEO)
                                    </label>
                                    <input id="input_post_meta_title" value="<?php echo e(old('post_meta_title')); ?>" name="post_meta_title" type="text" class="form-control <?php $__errorArgs = ['post_meta_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write meta title here.." />
                                    <?php $__errorArgs = ['post_meta_title'];
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
                                <!-- end meta title -->

                                <!-- meta_description -->
                                <div class="form-group _form-group">
                                    <label for="input_post_meta_description" class="font-weight-bold">
                                        Meta Description (SEO)
                                    </label>
                                    <textarea id="input_post_meta_description" name="post_meta_description" value="" placeholder="Max 150 Words | Write meta description here.." class="form-control <?php $__errorArgs = ['post_meta_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="3"><?php echo e(old('post_meta_description')); ?></textarea>
                                    <?php $__errorArgs = ['post_meta_description'];
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
                                <!-- end meta description -->

                                <!-- meta_keyword -->
                                <div class="form-group _form-group">
                                    <label for="input_post_meta_keyword" class="font-weight-bold">
                                        Meta Keyword (SEO)
                                    </label>
                                    <textarea id="input_post_meta_keyword" name="post_meta_keyword" value="<?php echo e(old('post_meta_keyword')); ?>" placeholder="Example: jasa, perusahaan, digital marketing, programming" class="form-control <?php $__errorArgs = ['post_meta_keyword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="3"><?php echo e(old('post_meta_keyword')); ?></textarea>
                                    <?php $__errorArgs = ['post_meta_keyword'];
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
                                <!-- end meta keyword -->

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="float-right mTop">
                                    <a class="btn btn-outline-secondary _btn-secondary px-4" href="<?php echo e(route('posts.index')); ?>">Back</a>
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

        $('#button_post_thumbnail').filemanager('image');

        $("#input_post_description").tinymce({
            relative_urls: false,
            content_style: "body {font-size: 14px; font-family: 'Montserrat', sans-serif; }.mce-content-body[data-mce-placeholder]:not(.mce-visualblocks)::before {color: #bfbfbf; font-size: 14px}",
            language: "en",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table directionality",
                "emoticons template paste textpattern",
            ],
            toolbar1: "fullscreen preview",
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
        $('#select_post_tag').select2({
            theme: 'bootstrap4',
            language: "",
            allowClear: true,
            ajax: {
                url: "<?php echo e(route('posttags.select')); ?>",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.tag_title,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });
        //select2 tag
        $('#select_post_category').select2({
            theme: 'bootstrap4',
            language: "",
            allowClear: true,
            ajax: {
                url: "<?php echo e(route('postcategories.select')); ?>",
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
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Brandztory Projects\brandztory-website\bz-cms\resources\views/admin/posts/create.blade.php ENDPATH**/ ?>