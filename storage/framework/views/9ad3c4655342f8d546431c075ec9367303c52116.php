<?php $__env->startSection('title'); ?>
CMS | Edit Profile
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Edit Profile</h3>
<?php $__env->endSlot(); ?>
<?php echo e(Breadcrumbs::render('edit_profile')); ?>

<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <form action="<?php echo e(route('profile.update')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo method_field('PATCH'); ?>
                <?php echo csrf_field(); ?>
                <div class="card ">
                    <div class="card-body _card-body">
                        <div class="row d-flex align-items-stretch">

                            <div class="col-12">

                                <!-- title -->
                                <div class="form-group _form-group">
                                    <label for="input_post_title" class="font-weight-bold">
                                        Name
                                    </label>
                                    <input id="input_post_title" value="<?php echo e(old('name', $user->name)); ?>" autocomplete="name" autofocus name="name" type="text" class="form-control" placeholder="<?php echo e(old('name', $user->name)); ?>" />
                                </div>
                                <!-- end title -->

                                <!-- email -->
                                <div class="form-group _form-group">
                                    <label for="input_post_title" class="font-weight-bold">
                                        Email
                                    </label>
                                    <input id="input_post_title" value="<?php echo e(old('email', $user->email)); ?>" autocomplete="email" autofocus name="email" type="email" class="form-control" placeholder="<?php echo e(old('email', $user->email)); ?>" />
                                </div>
                                <!-- end email -->

                                <!-- image -->
                                <div class="form-group _form-group">
                                    <label for="upload_img" class="font-weight-bold">
                                        Image Profile
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
                                    <img src="<?php echo e(old('image') . env('MEDIA_URL') . $user->image); ?>" class="d-block" alt="<?php echo e($user->image); ?>" style="width: 100px; object-fit: cover; margin-top: 20px; border-radius: 50%">
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
                                    <a class="btn btn-outline-secondary _btn-secondary px-4" href="/">Back</a>
                                    <button type="submit" class="btn btn-primary _btn-primary px-4">
                                        Update
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
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Brandztory Projects\Check Coding\admin-cms\resources\views/admin/profile/edit.blade.php ENDPATH**/ ?>