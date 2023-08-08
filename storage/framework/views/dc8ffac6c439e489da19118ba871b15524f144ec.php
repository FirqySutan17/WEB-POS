

<?php $__env->startSection('title'); ?>
CMS | Reset Password
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        
        <div class="boxAlert">
            <?php if($errors->has('email')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert"> <?php echo e($errors->first('email')); ?>

                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>
            <?php endif; ?>
        </div>
        
        <div class="boxAlert mt-7">
            <?php if($errors->has('password')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert"> <?php echo e($errors->first('password')); ?>

                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>
            <?php endif; ?>
        </div>

        
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-9 reset-card">
                    <div class="card-header m-auto"><h3><?php echo e(__('Reset Password')); ?></h3></div>
                    
                    <div class="card-body">
                        <form action="<?php echo e(route('reset.password.post')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="token" value="<?php echo e($token); ?>">
    
                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-8">
                                    <input type="email" id="email_address" class="form-control" name="email" placeholder="Enter email addreas" required autofocus>
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-8">
                                    <input type="password" id="inputPassword" class="form-control" name="password" required placeholder="Enter new password" autofocus>
                                    <i class="fa fa-eye" id="togglePassword" style="cursor: pointer; position: absolute; right: 30px; top: 10px; z-index: 1000"></i>
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                                <div class="col-md-8">
                                    <input type="password" id="inputPassword1" class="form-control" name="password_confirmation" placeholder="Confirm your new password" required autofocus>
                                    <i class="fa fa-eye" id="togglePassword1" style="cursor: pointer; position: absolute; right: 30px; top: 10px; z-index: 1000"></i>
                                    
                                    <?php if($errors->has('password_confirmation')): ?>
                                        <span class="text-danger"><?php echo e($errors->first('password_confirmation')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
    
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary reset-btn-1">
                                    <strong><?php echo e(__('Reset Password')); ?></strong>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    const togglePassword = document.querySelector('#togglePassword');
    const togglePassword1 = document.querySelector('#togglePassword1');
    const password = document.querySelector('#inputPassword');
    const password1 = document.querySelector('#inputPassword1');

    /* This for password */
    togglePassword.addEventListener('click', function(e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');

    });

    /* This for confirm pass */
    togglePassword1.addEventListener('click', function(e) {
        // toggle the type attribute
        const type = password1.getAttribute('type') === 'password' ? 'text' : 'password';
        password1.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');

    });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.authentication.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\user01\Documents\bz-cms\resources\views/auth/forgetPasswordLink.blade.php ENDPATH**/ ?>