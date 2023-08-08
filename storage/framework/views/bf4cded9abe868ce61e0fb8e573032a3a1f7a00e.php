

<?php $__env->startSection('title'); ?>
CMS | Page Meta
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link href="<?php echo e(asset('/assets/css/sweetalert2.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Page Meta</h3>
<?php $__env->endSlot(); ?>
<?php echo e(Breadcrumbs::render('metas')); ?>

<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
  <div class="card">
    <div class="card-header">
      <div class="boxHeader">
        
        <form class="row" method="GET">
          <div class="col-8 boxContent">
            <div class="boxSearch _form-group">
              <input name="keyword" value="<?php echo e(request('keyword')); ?>" type="search" class="form-control" placeholder="Search for page.." style="border-top-left-radius: 5px; border-bottom-left-radius: 5px;">
            </div>
            <div class="boxBtn">
              <button class="btn btn-primary mb-3" type="submit">
                <i class="fa fa-search"></i>
              </button>
            </div>
          </div>
          <div class="col-4 pright">
            <a href="<?php echo e(route('metas.create')); ?>" class="btn btn-primary float-right" role="button">
              <i class='fa fa-plus'></i> Add New
            </a>
          </div>

        </form>
        
      </div>
    </div>
    <div class="card-body table-responsive">
      <table class="display" id="advance-12">
        <thead>
          <tr>
            <th class="heightHr" style="width: 15%;">Page<span class="dividerHr"></span></th>
            <th class="heightHr" style="width: 40%;">Site Name <span class="dividerHr"></span></th>
            <th class="heightHr" style="width: 30%;">Description <span class="dividerHr"></span></th>
            <th class="heightHr" style="width: 10%;">Keyword <span class="dividerHr"></span></th>
            <th class="center-text" style="width: 5%;">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if(count($metas)): ?>
          <?php $__empty_1 = true; $__currentLoopData = $metas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <tr>
            <td style="width: 15%;" class="fontField" style="vertical-align: middle;"><?php echo e($meta->page_name); ?></td>
            <td style="width: 30%;" class="fontField" style="vertical-align: middle;"><?php echo e($meta->meta_title); ?></td>
            <td style="width: 30%;" class="fontField" style="vertical-align: middle;"><?php echo e($meta->meta_description); ?></td>
            <td style="width: 20%;" class="fontField">
              <?php echo e($meta->meta_keyword); ?>

            </td>
            <td style="width: 5%;" class="center-text boxAction fontField">
              <div class="boxInside">
                <div class="boxEdit">
                  <a href="<?php echo e(route('metas.edit', ['meta' => $meta])); ?>" class="btn-sm btn-info" role="button">
                    <i class="bx bx-edit"></i>
                  </a>
                </div>

                <div class="boxDelete">
                  <form action="<?php echo e(route('metas.destroy', ['meta' => $meta])); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-sm btn-danger">
                      <i class="bx bx-trash"></i>
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
            <?php if(request()->get('keyword')): ?>
            <strong> search not found</strong>
            <?php else: ?>
            <strong> No Page Meta data yet</strong>
            <?php endif; ?>
          </p>
          <?php endif; ?>
        </tbody>
      </table>
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
        title: 'Delete Meta',
        text: 'Are you sure want to remove Meta?',
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
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\user01\Documents\CMS\bz-cms\resources\views/admin/meta-pages/index.blade.php ENDPATH**/ ?>