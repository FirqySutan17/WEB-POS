

<?php $__env->startSection('title'); ?>
CMS | Roles
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link href="<?php echo e(asset('/assets/css/sweetalert2.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Roles</h3>
<?php $__env->endSlot(); ?>
<?php echo e(Breadcrumbs::render('roles')); ?>

<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <div class="boxHeader">
                
                <form class="row" method="GET">
                    <div class="col-8">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Role Create')): ?>
                        <a href="<?php echo e(route('roles.create')); ?>" class="btn btn-primary _btn" role="button">
                            <i class='bx bx-plus'></i> Create Role
                        </a>
                        <?php endif; ?>
                    </div>
                    <div class="col-4 boxContent">
                        <div class="boxSearch _form-group">
                            <input name="keyword" value="<?php echo e(request('keyword')); ?>" type="search" class="form-control" placeholder="Search for role.." style="border-top-left-radius: 5px; border-bottom-left-radius: 5px; height: 100%">
                        </div>
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-search"></i>
                        </button>

                    </div>
                </form>
                
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="center-text">No <span class="dividerHr"></span></th>
                        <th class="center-text">Role Name <span class="dividerHr"></span></th>
                        <th class="center-text">Description <span class="dividerHr"></span></th>
                        
                        <th class="center-text">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($roles)): ?>
                    <?php $__empty_1 = true; $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td style="width: 5%;" class="center-text"><?php echo e($loop->iteration); ?></td>
                        <td style="width: 30%;" class="center-text"><?php echo e($role->name); ?></td>
                        <td style="width: 55%;" class="center-text"><?php echo e($role->description); ?></td>
                        
                        <td style="width: 10%;" class="center-text boxAction fontField">
                            <div class="boxInside">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Role Update')): ?>
                                <div class="boxEdit">
                                    <a href="<?php echo e(route('roles.edit', ['role' => $role])); ?>" class="btn-sm btn-info" role="button">
                                        <i class="bx bx-edit"></i>
                                    </a>
                                </div>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Role Delete')): ?>
                                <div class="boxDelete">
                                    <form role="alert" action="<?php echo e(route('roles.destroy', ['role' => $role])); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>
                                </div>
                                <?php endif; ?>
                            </div>

                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    <table></table>
                    <p style="text-align: center; padding-top: 50px;">
                        <?php if(request()->get('keyword')): ?>
                        <strong> search not found</strong>
                        <?php else: ?>
                        <strong> No Role data yet</strong>
                        <?php endif; ?>
                    </p>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="boxFooter">
                <?php if($roles->hasPages()): ?>
                <div class="boxPagination">
                    <?php echo e($roles->links('vendor.pagination.bootstrap-4')); ?>

                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('/assets/js/sweet-alert/sweetalert.min.js')); ?>"></script>
<script>
    $('.show_confirm').click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
                title: `Are you sure you want to delete this Role?`,
                text: "the Permission in this Role will be deleted.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u551360984/domains/lifetime-studios.com/public_html/cms-rimba/resources/views/admin/roles/index.blade.php ENDPATH**/ ?>