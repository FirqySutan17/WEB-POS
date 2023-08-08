

<?php $__env->startSection('title'); ?>
CMS | Reset Password
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        
        <div class="boxAlert">
            <?php if(Session::has('message')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert"><?php echo e(Session::get('message')); ?>

                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>
            <?php endif; ?>
        </div>
        
        <div class="boxAlert">
            <?php if($errors->has('email')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert"> <?php echo e($errors->first('email')); ?>

                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>
            <?php endif; ?>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-10 reset-card">
                    <div class="card-header m-auto"><h3><?php echo e(__('Reset Password')); ?></h3></div>
                    <div class="card-body">
                        <form action="<?php echo e(route('forget.password.post')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-8">
                                    <input type="email" id="email_address" class="form-control" Placeholder="Enter email addreas" name="email" required autofocus>
                                </div>
                            </div>
                            <div class="col-md-8 offset-md-4">
                                <a class="link reset-a" href="/">Back to login</a>
                                <button type="submit" class="btn btn-primary reset-btn">
                                    <strong><?php echo e(__('Submit')); ?></strong>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.authentication.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Brandztory Projects\brandztory-website\bz-cms\resources\views/auth/forgetPassword.blade.php ENDPATH**/ ?>