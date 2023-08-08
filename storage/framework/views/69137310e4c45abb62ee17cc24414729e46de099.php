

<?php $__env->startSection('title'); ?>
CMS | Client Category
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link href="<?php echo e(asset('/assets/css/sweetalert2.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Client Category</h3>
<?php $__env->endSlot(); ?>
<?php echo e(Breadcrumbs::render('client_category')); ?>

<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
  <div class="card">
    <div class="card-header">
      <div class="boxHeader">
        
        <form class="row" method="GET">
          <div class="col-8 boxContent">
            <div class="boxSearch _form-group">
              <input name="keyword" value="<?php echo e(request('keyword')); ?>" type="search" class="form-control" placeholder="Search for category.." style="border-top-left-radius: 5px; border-bottom-left-radius: 5px;">
            </div>
            <div class="boxBtn">
              <button class="btn btn-primary mb-3" type="submit">
                <i class="fa fa-search"></i>
              </button>
            </div>
          </div>
          <div class="col-4 pright">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Client Category Create')): ?>
            <a href="<?php echo e(route('client-categories.create')); ?>" class="btn btn-primary float-right _btn" role="button">
              <i class='fa fa-plus'></i> Add New
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
            <th style="width: 85%;">Name <span class="dividerHr"></span></th>
            <th class="center-text" style="width: 10%;">Status <span class="dividerHr"></span></th>
            <th class="center-text" style="width: 5%;">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if(count($categories)): ?>
          <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <tr>
            <td style="width: 85%;" class="fontField" style="vertical-align: middle;"><?php echo e($category->cat_name); ?></td>
            <td style="width: 10%;" class="center-text fontField">
              <?php if($category->is_active == 1): ?>
              <span class="status-active">Active</span>
              <?php else: ?>
              <span class="status-nonactive">Non-Active</span>
              <?php endif; ?>
            </td>
            <td style="width: 5%;" class="center-text boxAction fontField">
              <div class="boxInside">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Client Category Update')): ?>
                <div class="boxEdit">
                  <a href="<?php echo e(route('client-categories.edit', ['client_category' => $category])); ?>" class="btn-sm btn-info" role="button">
                    <i class="bx bx-edit"></i>
                  </a>
                </div>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Client Category Delete')): ?>
                <div class="boxDelete">
                  <form role="alert" action="<?php echo e(route('client-categories.destroy', ['client_category' => $category])); ?>" method="POST">
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
            <strong> No Client Category data yet</strong>
            <?php endif; ?>
          </p>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <div class="card-footer">
      <div class="boxFooter">
        <?php if($categories->hasPages()): ?>
        <div class="boxPagination">
          <?php echo e($categories->links('vendor.pagination.bootstrap-4')); ?>

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
        title: 'Delete Category',
        text: 'Are you sure want to remove Category?',
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
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\user01\Documents\CMS\bz-cms\resources\views/admin/client-categories/index.blade.php ENDPATH**/ ?>