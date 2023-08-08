<?php $__env->startSection('title'); ?>
CMS | Add User
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/select2.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/sweetalert2.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Add User</h3>
<?php $__env->endSlot(); ?>
<?php echo e(Breadcrumbs::render('add_user')); ?>

<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <form action="<?php echo e(route('users.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="card ">
                    <div class="card-body _card-body">
                        <div class="row d-flex align-items-stretch">

                            <div class="col-12">
                                <!-- name -->
                                <div class="form-group _form-group">
                                    <label for="input_user_name" class="font-weight-bold">
                                        Name <span class="wajib">*</span>
                                    </label>
                                    <input id="input_user_name" value="<?php echo e(old('name')); ?>" name="name" type="text" class="form-control <?php $__errorArgs = ['name'];
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
                                    <?php $__errorArgs = ['name'];
                                    $__bag = $errors->getBag($__errorArgs[1] ?? 'default');
                                    if ($__bag->has($__errorArgs[0])) :
                                        if (isset($message)) {
                                            $__messageOriginal = $message;
                                        }
                                        $message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback">
                                            <?php echo e($message); ?>

                                        </span>
                                    <?php unset($message);
                                        if (isset($__messageOriginal)) {
                                            $message = $__messageOriginal;
                                        }
                                    endif;
                                    unset($__errorArgs, $__bag); ?>
                                    <!-- error message -->
                                </div>
                                <!-- end name -->

                                <div class="row">
                                    <div class="col-6">
                                        <!-- email -->
                                        <div class="form-group _form-group">
                                            <label for="input_user_email" class="font-weight-bold">
                                                Email <span class="wajib">*</span>
                                            </label>
                                            <input id="input_user_email" value="<?php echo e(old('email')); ?>" name="email" type="email" class="form-control <?php $__errorArgs = ['email'];
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
                                                                                                                                                                unset($__errorArgs, $__bag); ?>" placeholder="Write email here.." autocomplete="email" />
                                            <?php $__errorArgs = ['email'];
                                            $__bag = $errors->getBag($__errorArgs[1] ?? 'default');
                                            if ($__bag->has($__errorArgs[0])) :
                                                if (isset($message)) {
                                                    $__messageOriginal = $message;
                                                }
                                                $message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-feedback">
                                                    <?php echo e($message); ?>

                                                </span>
                                            <?php unset($message);
                                                if (isset($__messageOriginal)) {
                                                    $message = $__messageOriginal;
                                                }
                                            endif;
                                            unset($__errorArgs, $__bag); ?>
                                            <!-- error message -->
                                        </div>
                                        <!-- end email -->
                                    </div>
                                    <div class="col-6">
                                        <!-- role -->
                                        <div class="form-group _form-group">
                                            <label for="select_user_role" class="font-weight-bold">
                                                Role <span class="wajib">*</span>
                                            </label>
                                            <select id="select_user_role" name="role" data-placeholder="Choose Role" class="js-example-placeholder-multiple">
                                                <option value="0">Choose Role</option>
                                                <?php $__currentLoopData = $roles;
                                                $__env->addLoop($__currentLoopData);
                                                foreach ($__currentLoopData as $role) : $__env->incrementLoopIndices();
                                                    $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($role->id); ?>">
                                                        <?php echo e($role->name); ?>

                                                    </option>

                                                <?php endforeach;
                                                $__env->popLoop();
                                                $loop = $__env->getLastLoop(); ?>
                                                <!-- <?php if (old('role')) : ?>
                                                <option value="<?php echo e(old('role')->id); ?>" selected>
                                                    <?php echo e(old('role')->name); ?>

                                                </option>
                                                <?php endif; ?> -->
                                            </select>
                                            <?php $__errorArgs = ['role'];
                                            $__bag = $errors->getBag($__errorArgs[1] ?? 'default');
                                            if ($__bag->has($__errorArgs[0])) :
                                                if (isset($message)) {
                                                    $__messageOriginal = $message;
                                                }
                                                $message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-feedback">
                                                    <?php echo e($message); ?>

                                                </span>
                                            <?php unset($message);
                                                if (isset($__messageOriginal)) {
                                                    $message = $__messageOriginal;
                                                }
                                            endif;
                                            unset($__errorArgs, $__bag); ?>
                                            <!-- error message -->
                                        </div>
                                        <!-- end role -->
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <!-- password -->
                                        <div class="form-group _form-group">
                                            <label for="input_user_password" class="font-weight-bold">
                                                Password <span class="wajib">*</span>
                                            </label>
                                            <input id="input_user_password" name="password" type="password" class="form-control <?php $__errorArgs = ['password'];
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
                                                                                                                                unset($__errorArgs, $__bag); ?>" placeholder="Write password.." autocomplete="new-password" />
                                            <?php $__errorArgs = ['password'];
                                            $__bag = $errors->getBag($__errorArgs[1] ?? 'default');
                                            if ($__bag->has($__errorArgs[0])) :
                                                if (isset($message)) {
                                                    $__messageOriginal = $message;
                                                }
                                                $message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-feedback">
                                                    <?php echo e($message); ?>

                                                </span>
                                            <?php unset($message);
                                                if (isset($__messageOriginal)) {
                                                    $message = $__messageOriginal;
                                                }
                                            endif;
                                            unset($__errorArgs, $__bag); ?>
                                            <!-- error message -->
                                        </div>
                                        <!-- end password -->
                                    </div>
                                    <div class="col-6">
                                        <!-- password_confirmation -->
                                        <div class="form-group _form-group">
                                            <label for="input_user_password_confirmation" class="font-weight-bold">
                                                Confirm Password <span class="wajib">*</span>
                                            </label>
                                            <input id="input_user_password_confirmation" name="password_confirmation" type="password" class="form-control" placeholder="Write confirm password.." autocomplete="new-password" />
                                            <!-- error message -->
                                        </div>
                                        <!-- end password confirmation -->
                                    </div>
                                </div>
                                <!-- image -->
                                <div class="form-group _form-group">
                                    <label for="upload_img" class="font-weight-bold">
                                        Profile Image
                                    </label>
                                    <input type="file" value="<?php echo e(old('image')); ?>" name="image" require class="form-control <?php $__errorArgs = ['image'];
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
                                                                                                                                        unset($__errorArgs, $__bag); ?>" id="upload_img">
                                    <?php $__errorArgs = ['image'];
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
                                <!-- end image -->
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-12">
                                <div class="float-right mTop">
                                    <a class="btn btn-outline-secondary _btn-secondary px-4" href="<?php echo e(route('users.index')); ?>">Back</a>
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
<script src="<?php echo e(asset('assets/js/sweet-alert/sweetalert.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('javascript-internal'); ?>
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
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Brandztory Projects\Check Coding\admin-cms\resources\views/admin/users/create.blade.php ENDPATH**/ ?>