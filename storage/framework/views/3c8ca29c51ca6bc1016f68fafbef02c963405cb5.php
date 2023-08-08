

<?php $__env->startSection('title'); ?>
CMS | Login
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-5"><img class="bg-img-cover bg-center" src="<?php echo e(asset('assets/images/login/3.jpg')); ?>" alt="looginpage" /></div>
        <div class="col-xl-7 p-0">
            <div class="login-card">
                <form class="login-form" method="POST" action="<?php echo e(route('login')); ?>" novalidate="">
                    <?php echo csrf_field(); ?>
                    <h4>Login</h4>
                    <h6>Welcome back! Log in to your account.</h6>

                    <div class="form-group _form-group">
                        <label>Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="icon-email"></i></span>
                            <input name="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="input_login_email" type="email" placeholder="Enter email address" value="<?php echo e(old('email')); ?>" autocomplete="email">
                        </div>
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" style="width: 100%; font-size: 12px;" role="alert">
                            <strong>Account doesn't match</strong>
                        </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group _form-group">
                        <label>Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="icon-lock"></i></span>
                            <input name="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="input_login_password" type="password" placeholder="Enter password" autocomplete="current-password" />
                        </div>
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" style="width: 100%; font-size: 12px;" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <div class="checkbox" style="visibility: hidden;">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="remember">
                                <?php echo e(__('Remember Me')); ?>

                            </label>
                        </div>
                        <?php if(Route::has('password.request')): ?>
                        <a class="link" href="<?php echo e(route('password.request')); ?>">
                            <?php echo e(__('Forgot your password?')); ?>

                        </a>
                        <?php endif; ?>
                    </div>
                    <div class="">
                        <button class="btn btn-primary btn-block" type="submit">Sign in</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<script>
    (function() {
        "use strict";
        window.addEventListener(
            "load",
            function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName("needs-validation");
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener(
                        "submit",
                        function(event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add("was-validated");
                        },
                        false
                    );
                });
            },
            false
        );
    })();
</script>


<?php $__env->startPush('scripts'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.authentication.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Brandztory Projects\Check Coding\admin-cms\resources\views/auth/login.blade.php ENDPATH**/ ?>