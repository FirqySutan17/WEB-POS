<?php $__env->startSection('title'); ?>
CMS | Add Post Tag
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/select2.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Add Post Tag</h3>
<?php $__env->endSlot(); ?>
<?php echo e(Breadcrumbs::render('add_post_tag')); ?>

<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <form action="<?php echo e(route('post-tags.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="card ">
                    <div class="card-body _card-body">
                        <div class="row">
                            <div class="col-12">
                                <!-- title -->
                                <div class="form-group _form-group">
                                    <label for="input_tag_title" class="font-weight-bold">
                                        Name <span class="wajib">*</span>
                                    </label>
                                    <input id="input_tag_title" value="<?php echo e(old('tag_title')); ?>" name="tag_title" type="text" class="form-control <?php $__errorArgs = ['tag_title'];
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
                                                                                                                                                            unset($__errorArgs, $__bag); ?>" placeholder="Write name here.." />
                                    <?php $__errorArgs = ['tag_title'];
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
                                    <label for="input_tag_slug" class="font-weight-bold">
                                        Slug
                                    </label>
                                    <input id="input_tag_slug" value="<?php echo e(old('tag_slug')); ?>" name="tag_slug" type="text" class="form-control <?php $__errorArgs = ['tag_slug'];
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
                                                                                                                                                            unset($__errorArgs, $__bag); ?>" placeholder="Auto Generate" readonly />
                                    <?php $__errorArgs = ['tag_slug'];
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

                                <div class="float-right mTop">
                                    <a class="btn btn-outline-secondary _btn-secondary px-4" href="<?php echo e(route('post-tags.index')); ?>">Back</a>
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
        $("#input_tag_title").change(function(event) {
            $("#input_tag_slug").val(
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
</script>
<script>
    $(function() {
        //parent category
        $('#select_user_role').select2({
            theme: 'bootstrap4',
            language: "<?php echo e(app()->getLocale()); ?>",
            allowClear: true,
            ajax: {
                url: "<?php echo e(route('roles.select')); ?>",
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
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Brandztory Projects\brandztory-website\bz-cms\resources\views/admin/posts-tags/create.blade.php ENDPATH**/ ?>