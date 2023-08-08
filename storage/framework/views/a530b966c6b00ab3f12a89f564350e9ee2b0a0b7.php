

<?php $__env->startSection('title'); ?>
CMS | Posts
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Posts</h3>
<?php $__env->endSlot(); ?>
<?php echo e(Breadcrumbs::render('posts')); ?>

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
                                <?php $__currentLoopData = $categoriesPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->category_title); ?>" <?php echo e(request('category') === $category->category_title ? 'selected' : null); ?>>
                                    <?php echo e($category->category_title); ?>

                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="boxSearch">
                            <input name="keyword" value="<?php echo e(request('keyword')); ?>" type="search" class="form-control" placeholder="Search for post..">
                        </div>
                        <div class="boxBtn">
                            <button type="submit" class="btn btn-primary mb-3"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <div class="col-4 pright">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Post Create')): ?>
                        <a href="<?php echo e(route('posts.create')); ?>" class="btn btn-primary float-right" role="button">
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
                        <th class="widthCustom1">Title <span class="dividerHr">&#x7C;</span></th>
                        <th class="widthCustom2">Description <span class="dividerHr">&#124;</span></th>
                        <th class="center-text widthCustom3">Category <span class="dividerHr">&#x7C;</span></th>
                        <th class="center-text widthCustom4">Date <span class="dividerHr">&#x7C;</span></th>
                        <th class="center-text widthCustom5">Status <span class="dividerHr">&#x7C;</span></th>
                        <th class="center-text widthCustom6">Actions</th>
                </thead>
                <tbody>
                    <?php if(count($posts)): ?>
                    <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="fontField widthCustom1"><?php echo e($post->post_title); ?></td>
                        <td class="fontField widthCustom2"><?php echo \Illuminate\Support\Str::limit($post->post_excerpt, 150); ?></td>
                        <td class="center-text fontField widthCustom3"><?php echo e($post->category->category_title); ?></td>
                        <td class="center-text fontField widthCustom4"><?php echo e($post->created_at->format('D, d M y')); ?></td>
                        <td class="center-text fontField widthCustom5">
                            <?php if($post->is_active == 1): ?>
                            <span class="status-active">Published</span>
                            <?php else: ?>
                            <span class="status-nonactive">Draft</span>
                            <?php endif; ?>
                        </td>
                        <td class="center-text boxAction fontField widthCustom6">
                            <div class="boxInside">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Post Update')): ?>
                                <div class="boxEdit">
                                    <a href="<?php echo e(route('posts.edit', ['post' => $post])); ?>" class="btn btn-sm btn-info" role="button">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </div>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Post Delete')): ?>
                                <div class="boxDelete">
                                    <form action="<?php echo e(route('posts.destroy', ['post' => $post])); ?>" method="POST">
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
                        <strong> No post data yet</strong>
                    </p>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="boxFooter">
                <?php if($posts->hasPages()): ?>
                <div class="boxPagination">
                    <?php echo e($posts->links('vendor.pagination.bootstrap-4')); ?>

                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>




<?php $__env->startPush('scripts'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Brandztory Projects\Check Coding\admin-cms\resources\views/admin/posts/index.blade.php ENDPATH**/ ?>