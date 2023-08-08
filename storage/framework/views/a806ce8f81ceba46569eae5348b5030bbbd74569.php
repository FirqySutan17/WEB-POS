

<?php $__env->startSection('title'); ?>
CMS | Create Role
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Create Role</h3>
<?php $__env->endSlot(); ?>
<?php echo e(Breadcrumbs::render('add_role')); ?>

<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <form action="<?php echo e(route('roles.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="card _card">
                    <div class="card-body _card-body">
                        <div class="row d-flex align-items-stretch">
                            <div class="col-12">

                                <!-- role name -->
                                <div class="form-group _form-group">
                                    <label for="input_role_name" class="font-weight-bold">
                                        Role <span class="required-field">*</span>
                                    </label>
                                    <input id="input_role_name" value="<?php echo e(old('name')); ?>" name="name" type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 23.5%;" placeholder="Write name here.." />
                                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback">
                                        <?php echo e($message); ?>

                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <!-- end role name -->

                                <div class="form-group _form-group">
                                    <label for="input_role_name" class="font-weight-bold">
                                        Description
                                    </label>
                                    <textarea id="input_role_description" name="description" type="text" class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write description here.." rows="6"><?php echo e(old('description')); ?></textarea>
                                    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback">
                                        <?php echo e($message); ?>

                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <!-- permission -->
                                <div class="form-group _form-group">
                                    <label for="input_role_permission" class="font-weight-bold">
                                        Permission
                                    </label>
                                    <div class="row" style="padding-top: 5px">
                                        <!-- list manage name:start -->
                                        <?php $__currentLoopData = $authorities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manageName => $permissions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-3" style="margin-bottom: 20px;">
                                            <ul class="list-group mx-1">
                                                <li class="list-group-item list-group-item-head">
                                                    <?php echo e($manageName); ?>

                                                </li>
                                                <!-- list permission:start -->
                                                <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="list-group-item  list-group-item-body">
                                                    <div class="form-check">
                                                        <?php if(old('permissions')): ?>
                                                        <input id="<?php echo e($permission); ?>" name="permissions[]" class="form-check-input" type="checkbox" value="<?php echo e($permission); ?>" <?php echo e(in_array($permission,
                                                            old('permissions')) ? "Checked" : null); ?>>
                                                        <?php else: ?>
                                                        <input id="<?php echo e($permission); ?>" name="permissions[]" class="form-check-input" type="checkbox" value="<?php echo e($permission); ?>">
                                                        <?php endif; ?>
                                                        <span for="<?php echo e($permission); ?>" class="form-check-label">
                                                            <?php echo e($permission); ?>

                                                        </span>
                                                    </div>
                                                </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <!-- list permission:end -->
                                            </ul>
                                        </div>

                                        <!-- list manage name:end  -->
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>

                                    <?php $__errorArgs = ['permissions'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback">
                                        <?php echo e($message); ?>

                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="float-right">
                                    <a class="btn btn-outline-primary _btn-primary px-4" href="<?php echo e(route('roles.index')); ?>">
                                        Back
                                    </a>
                                    <button type="submit" class="btn btn-primary _btn-primary px-4">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
            </form>
        </div>

    </div>
</div>
</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u551360984/domains/lifetime-studios.com/public_html/cms-rimba/resources/views/admin/roles/create.blade.php ENDPATH**/ ?>