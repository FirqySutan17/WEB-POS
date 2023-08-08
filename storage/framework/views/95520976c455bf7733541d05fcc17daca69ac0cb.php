

<?php $__env->startSection('title'); ?>
CMS | Career
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Careers</h3>
<?php $__env->endSlot(); ?>
<?php echo e(Breadcrumbs::render('careers')); ?>

<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
  <div class="card">
    <div class="card-header">
      <div class="boxHeader">
        
        <form class="row" method="GET">
          <div class="col-8 boxContent">
            <div class="boxSearch _form-group">
              <input name="keyword" value="<?php echo e(request('keyword')); ?>" type="search" class="form-control" placeholder="Search for career.." style="border-top-left-radius: 5px; border-bottom-left-radius: 5px;">
            </div>
            <div class="boxBtn">
              <button class="btn btn-primary mb-3" type="submit">
                <i class="fa fa-search"></i>
              </button>
            </div>
          </div>
          <div class="col-4 pright">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Project Category Create')): ?>
            <a href="<?php echo e(route('careers.create')); ?>" class="btn btn-primary float-right _btn" role="button">
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
            <th class="widthCustom1">Name <span class="dividerHr"></span></th>
            <th style="width: 65%;">Description <span class="dividerHr"></span></th>
            <th class="center-text widthCustom5">Status <span class="dividerHr"></span></th>
            <th class="center-text widthCustom6">Action</th>
        </thead>
        <tbody>
          <?php if(count($careers)): ?>
          <?php $__empty_1 = true; $__currentLoopData = $careers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $career): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <tr>
            <td class="fontField widthCustom1"><?php echo e($career->career_name); ?></td>
            <td style="width: 65%;" class="fontField"><?php echo \Illuminate\Support\Str::limit($career->job_description, 150); ?></td>
            <td class="center-text fontField widthCustom5">
              <?php if($career->is_active == 1): ?>
              <span class="status-active">Active</span>
              <?php else: ?>
              <span class="status-nonactive">Non-Active</span>
              <?php endif; ?>
            </td>
            <td class="center-text boxAction fontField widthCustom6">
              <div class="boxInside">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Project Update')): ?>
                <div class="boxEdit">
                  <a href="<?php echo e(route('careers.edit', ['career' => $career])); ?>" class="btn-sm btn-info" role="button">
                    <i class="bx bx-edit"></i>
                  </a>
                </div>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Project Delete')): ?>
                <div class="boxDelete">
                  <form action="<?php echo e(route('careers.destroy', ['career' => $career])); ?>" role="alert" method="POST">
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
            <strong> No career data yet</strong>
            <?php endif; ?>
          </p>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
    <div class="card-footer">
      <div class="boxFooter">
        <?php if($careers->hasPages()): ?>
        <div class="boxPagination">
          <?php echo e($careers->links('vendor.pagination.bootstrap-4')); ?>

        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>




<?php $__env->startPush('scripts'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('javascript-internal'); ?>
<script>
  $(document).ready(function() {
    $("form[role='alert']").submit(function(event) {
      event.preventDefault();
      Swal.fire({
        title: 'Delete Career',
        text: 'Are you sure want to remove Career?',
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
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Brandztory Projects\brandztory-website\bz-cms\resources\views/admin/careers/index.blade.php ENDPATH**/ ?>