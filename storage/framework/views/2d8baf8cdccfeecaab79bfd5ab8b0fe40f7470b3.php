

<?php $__env->startSection('title'); ?>
CMS | Banners
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Banners</h3>
<?php $__env->endSlot(); ?>
<?php echo e(Breadcrumbs::render('banners')); ?>

<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
  <div class="card">
    <div class="card-header">
      <div class="boxHeader">
        
        <form class="row" method="GET">
          <div class="col-8 boxContent">
            <div class="boxSelect">
              <select name="category" class="form-control">
                <option value="" selected>All Category</option>
                <?php $__currentLoopData = $categoriesBanners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($category->category_title); ?>" <?php echo e(request('category') === $category->category_title ? 'selected' : null); ?>>
                  <?php echo e($category->category_title); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>
            <div class="boxSearch">
              <input name="keyword" value="<?php echo e(request('keyword')); ?>" type="search" class="form-control" placeholder="Search for banner..">
            </div>
            <div class="boxBtn">
              <button type="submit" class="btn btn-primary mb-3"><i class="fa fa-search"></i></button>
            </div>
          </div>
          <div class="col-4 pright">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Banner Create')): ?>
            <a href="<?php echo e(route('banners.create')); ?>" class="btn btn-primary float-right" role="button">
              <i class='bx bx-plus'></i> Add New
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
            <th style="width: 4%;" class="center-text">Seq <span class="dividerHr"></span></th>

            <th style="width: 26%;">Image <span class="dividerHr"></span></th>
            <th style="width: 45%;">Title <span class="dividerHr"></span></th>
            <th style="width: 10%;" class="center-text">Category <span class="dividerHr"></span></th>
            <th style="width: 10%;" class="center-text">Status <span class="dividerHr"></span></th>
            <th style="width: 5%;" class="center-text">Actions</th>
        </thead>
        <tbody>
          <?php if(count($banners)): ?>
          <?php $__empty_1 = true; $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <tr>
            <td style="width: 4%;" class="center-text fontField"><?php echo e($banner->banner_seq); ?></td>
            <td style="width: 26%;" class="fontField" style="vertical-align: middle;"> <img src="<?php echo e(env('MEDIA_URL') . $banner->banner_image); ?>" alt="" style="width: 95%; height: 120px; border-radius: 5px; object-fit: cover;"></td>
            <td style="width: 45%;" class="fontField" style="vertical-align: middle;"><?php echo e($banner->banner_title); ?></td>
            <td style="width: 10%;" class="center-text fontField"><?php echo e($banner->category->category_title); ?></td>
            <td style="width: 10%;" class="center-text fontField">
              <?php if($banner->is_active == 1): ?>
              <span class="status-active">Published</span>
              <?php else: ?>
              <span class="status-nonactive">Draft</span>
              <?php endif; ?>
            </td>
            <td style="width: 5%;" class="center-text boxAction fontField">
              <div class="boxInside">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Banner Update')): ?>
                <div class="boxEdit">
                  <a href="<?php echo e(route('banners.edit', ['banner' => $banner])); ?>" class="btn btn-sm btn-info" role="button">
                    <i class="fa fa-edit"></i>
                  </a>
                </div>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Banner Delete')): ?>
                <div class="boxDelete">
                  <form action="<?php echo e(route('banners.destroy', ['banner' => $banner])); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-sm btn-danger">
                      <i class="fa fa-trash"></i>
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
            <strong> No banner data yet</strong>
          </p>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
    <div class="card-footer">
      <div class="boxFooter">
        <?php if($banners->hasPages()): ?>
        <div class="boxPagination">
          <?php echo e($banners->links('vendor.pagination.bootstrap-4')); ?>

        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

</div>

<?php $__env->startPush('scripts'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Brandztory Projects\brandztory-website\bz-cms\resources\views/admin/banner/index.blade.php ENDPATH**/ ?>