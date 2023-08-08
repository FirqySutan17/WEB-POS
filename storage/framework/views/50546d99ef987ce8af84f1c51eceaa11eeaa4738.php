
<?php $__env->startSection('title'); ?>
CMS | Post Tag
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link href="<?php echo e(asset('/assets/css/sweetalert2.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Post Tag</h3>
<?php $__env->endSlot(); ?>
<?php echo e(Breadcrumbs::render('post_tag')); ?>

<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <div class="boxHeader">
                
                <form class="row" method="GET">
                    <div class="col-8 boxContent">
                        <div class="boxSearch">
                            <input name="keyword" value="<?php echo e(request('keyword')); ?>" type="search" class="form-control" placeholder="Search for tag.." style="border-top-left-radius: 5px; border-bottom-left-radius: 5px;">
                        </div>
                        <div class="boxBtn">
                            <button class="btn btn-primary mb-3" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-4 pright">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Post Tag Create')): ?>
                        <a href="<?php echo e(route('post-tags.create')); ?>" class="btn btn-primary float-right" role="button">
                            <i class="fa fa-edit"></i> Add New
                        </a>
                        <?php endif; ?>
                    </div>

                </form>
                
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="display" id="advance-12">
                <thead>
                    <tr>
                        <th style="width: 85%;">Name <span class="dividerHr">&#x7C;</span></th>
                        <th class="center-text" style="width: 10%;">Status <span class="dividerHr">&#x7C;</span></th>
                        <th class="center-text" style="width: 5%;">Actions</th>
                </thead>
                <tbody>
                    <?php if(count($tags)): ?>
                    <?php $__empty_1 = true; $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td style="width: 85%;" class="fontField" style="vertical-align: middle;"><?php echo e($tag->tag_title); ?></td>

                        <td style="width: 10%;" class="center-text fontField">
                            <?php if($tag->is_active == 1): ?>
                            <span class="status-active">Active</span>
                            <?php else: ?>
                            <span class="status-nonactive">Non-Active</span>
                            <?php endif; ?>
                        </td>
                        <td style="width: 5%;" class="center-text boxAction fontField">
                            <div class="boxInside">
                                <div class="boxEdit">
                                    <a href="<?php echo e(route('post-tags.edit', ['post_tag' => $tag])); ?>" class="btn btn-sm btn-info" role="button">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </div>
                                <div class="boxDelete">
                                    <form action="<?php echo e(route('post-tags.destroy', ['post_tag' => $tag])); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    <table></table>
                    <p style="text-align: center; padding-top: 50px;">
                        <strong> No post tag data yet</strong>
                    </p>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="boxFooter">
                <?php if($tags->hasPages()): ?>
                <div class="boxPagination">
                    <?php echo e($tags->links('vendor.pagination.bootstrap-4')); ?>

                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('javascript-internal'); ?>
<script>
    $(document).ready(function() {
        $("form[role='alert']").submit(function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Delete Tag',
                text: 'Are you sure want to remove Tag?',
                icon: 'warning',
                allowOutsideClick: false,
                showCancelButton: true,
                cancelButtonText: "Cancel",
                reverseButtons: true,
                confirmButtonText: "Yes",
            }).then((result) => {
                if (result.isConfirmed) {
                    // todo: process of deleting categories
                    event.target.submit();
                }
            });
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Brandztory Projects\Check Coding\admin-cms\resources\views/admin/posts-tags/index.blade.php ENDPATH**/ ?>