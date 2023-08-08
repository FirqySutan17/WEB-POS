<?php $__env->startSection('title'); ?>
CMS | Edit Post Category
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link href="<?php echo e(asset('/assets/css/sweetalert2.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Edit Post Category</h3>
<?php $__env->endSlot(); ?>
<?php echo e(Breadcrumbs::render('edit_post_category', $postCategory)); ?>

<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <form action="<?php echo e(route('post-categories.update', ['post_category' => $postCategory])); ?>" method="POST">
                <?php echo method_field('PUT'); ?>
                <?php echo csrf_field(); ?>
                <div class="card ">
                    <div class="card-body _card-body">
                        <div class="row d-flex align-items-stretch">
                            <div class="col-12">
                                <!-- title -->
                                <div class="form-group _form-group">
                                    <label for="input_banner_title" class="font-weight-bold">
                                        Name <span class="wajib">* </span>
                                    </label>
                                    <input id="input_banner_title" value="<?php echo e(old('category_title', $postCategory->category_title)); ?>" name="category_title" type="text" class="form-control <?php $__errorArgs = ['category_title'];
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
                                                                                                                                                                                                        unset($__errorArgs, $__bag); ?>" placeholder="" />
                                    <?php $__errorArgs = ['category_title'];
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

                                <!-- slug -->
                                <div class="form-group _form-group">
                                    <label for="input_banner_slug" class="font-weight-bold">
                                        Slug
                                    </label>
                                    <input id="input_banner_slug" name="category_slug" type="text" class="form-control <?php $__errorArgs = ['category_slug'];
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
                                                                                                                        unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('category_slug', $postCategory->category_slug)); ?>" readonly />
                                    <?php $__errorArgs = ['category_slug'];
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

                                <!-- description -->
                                <div class="form-group _form-group">
                                    <label for="input_category_caption" class="font-weight-bold">
                                        Description <span class="wajib">* </span>
                                    </label>
                                    <textarea id="input_category_caption" value="" name="category_desc" placeholder="" class="form-control <?php $__errorArgs = ['category_desc'];
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
                                                                                                                                            unset($__errorArgs, $__bag); ?>" rows="3"><?php echo e(old('category_desc', $postCategory->category_desc)); ?></textarea>
                                    <?php $__errorArgs = ['category_desc'];
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

                                <!-- status -->
                                <div class="form-group<?php echo e($errors->has('is_active') ? ' has-error' : ''); ?> _form-group" style="display: flex;">
                                    <label for="input_banner_status" class="font-weight-bold" style="padding: 7px 0px; margin-right: 20px;">
                                        Status
                                    </label>
                                    <div class="col-2">
                                        <div class="media">
                                            <div class="media-body text-end icon-state">
                                                <label class="switch">
                                                    <input type="checkbox" name="is_active" <?php echo e(old('is_active', $postCategory->is_active) == 1  ? 'checked'  : null); ?>><span class="switch-state"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="float-right mTop">
                                    <a class="btn btn-outline-secondary _btn-secondary px-4" href="<?php echo e(route('post-categories.index')); ?>">Back</a>
                                    <button type="submit" class="btn btn-primary _btn-primary px-4">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
        </div>
        </form>
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

        $("#input_banner_description").tinymce({
            relative_urls: false,
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

    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Brandztory Projects\Check Coding\admin-cms\resources\views/admin/posts-categories/edit.blade.php ENDPATH**/ ?>