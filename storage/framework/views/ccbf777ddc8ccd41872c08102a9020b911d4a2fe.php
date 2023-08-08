

<?php $__env->startSection('title'); ?>
CMS | Login
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<style>
.danger-suspend {
    border-radius: 5px !important;
    padding: 10px 15px !important;
    font-weight: 600;
}
</style>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    
    <?php if($errors->any()): ?>
    <div class="boxAlert">
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert"><?php echo e($error); ?>

            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>
    
    <div class="row">
        <div class="col-xl-5"><img class="bg-img-cover bg-center" src="<?php echo e(asset('assets/images/login/3.jpg')); ?>" alt="loginpage" /></div>
        <div class="col-xl-7 p-0">
            <div class="login-card">

                <form class="theme-form login-form" method="POST" action="<?php echo e(route('login')); ?>">
                    <?php echo csrf_field(); ?>
                    <h4>Login</h4>
                    <h6>Welcome back! Log in to your account.</h6>
                    <?php if(session('error')): ?>
                    <div class="alert alert-danger danger-suspend">
                            <?php echo e(session('error')); ?>

                    </div>
                    <?php endif; ?>
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
unset($__errorArgs, $__bag); ?>" id="input_login_email" type="email" placeholder="Enter email address" value="<?php echo e(old('email')); ?>">
                        </div>
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
unset($__errorArgs, $__bag); ?>" id="input_login_password" type="password" placeholder="Enter password" autocomplete="current-password" style="border-top-right-radius: 4px; border-bottom-right-radius: 4px;" />
                            <i class="fa fa-eye" id="togglePassword" style="cursor: pointer; position: absolute; right: 30px; top: 10px; z-index: 1000"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="checkbox" style="visibility: hidden;">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="remember">
                                <?php echo e(__('Remember Me')); ?>

                            </label>
                        </div>
                        <?php if(Route::has('password.request')): ?>
                        <a class="link" href="<?php echo e(route('forget.password.get')); ?>">
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

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#input_login_password');

    togglePassword.addEventListener('click', function(e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
    });

    // function myFunction() {
    //     var x = document.getElementById("input_login_password");
    //     if (x.type === "password") {
    //         x.type = "text";
    //     } else {
    //         x.type = "password";
    //     }
    // }
</script>


<?php $__env->startPush('scripts'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.authentication.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Personal\Github\koontjie-be\resources\views/auth/login.blade.php ENDPATH**/ ?>