

<?php $__env->startSection('title'); ?>
CMS | How We Work
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
<link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.0/jquery.fancybox.min.css" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>How We Work</h3>
<?php $__env->endSlot(); ?>
<?php echo e(Breadcrumbs::render('how-we-work')); ?>

<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<div class="boxHeader">
				
				<form class="row" method="GET">
                    <div class="col-8">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Hww Create')): ?>
                        <a href="<?php echo e(route('how-we-work.create')); ?>" class="btn btn-primary _btn" role="button">
                            <i class='bx bx-plus'></i> Add new
                        </a>
                       <?php endif; ?>
                    </div>
                    <div class="col-4 boxContent">
                        <div class="boxSearch _form-group">
                            <input name="keyword" value="<?php echo e(request('keyword')); ?>" type="search" class="form-control" placeholder="Search for data.." style="border-top-left-radius: 5px; border-bottom-left-radius: 5px; height: 100%">
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
						<th class="center-text heightHr">Name <span class="dividerHr"></span></th>
						<th class="center-text heightHr" >Description <span class="dividerHr"></span></th>
						<th class="center-text heightHr" >Image <span class="dividerHr"></span></th>
						<th class="center-text">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if(count($hwws)): ?>
					<?php $__empty_1 = true; $__currentLoopData = $hwws; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hww): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
					<tr>
						<td style="width: 5%;" class="center-text"><?php echo e($loop->iteration); ?></td>
                        <td style="width: 25%;" class="center-text"><?php echo e($hww->name); ?></td>
						<td style="width: 40%;" class="center-text"><?php echo $hww->description; ?></td>
						<td style="width: 20%;" class="center-text">
                            <a data-fancybox="gallery" class="primary-btn" href="<?php echo e(env('MEDIA_URL') . $hww->image); ?>" style="color: #063DFF;">Open Image</a>
                        </td>
						<td style="width: 10%;" class="center-text boxAction fontField">
							<div class="boxInside">
								<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Hww Update')): ?>
								<div class="boxEdit">
									<a href="<?php echo e(route('how-we-work.edit', ['how_we_work' => $hww])); ?>" class="btn-sm btn-info" role="button">
										<i class="bx bx-edit"></i>
									</a>
								</div>
								<?php endif; ?>

								<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Hww Delete')): ?>
								<div class="boxDelete">
									<form action="<?php echo e(route('how-we-work.destroy', ['how_we_work' => $hww])); ?>" method="POST">
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
						<strong> Search not found</strong>
						<?php else: ?>
						<strong> No data yet</strong>
						<?php endif; ?>
					</p>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
		<div class="card-footer">
			<div class="boxFooter">
				<?php if($hwws->hasPages()): ?>
				<div class="boxPagination">
					<?php echo e($hwws->links('vendor.pagination.bootstrap-4')); ?>

				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('javascript-internal'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.0/jquery.fancybox.min.js"></script>

<script>
	$(document).ready(function() {
		$("form[role='alert']").submit(function(event) {
			event.preventDefault();
			Swal.fire({
				title: 'Delete',
				text: 'Are you sure want to remove this?',
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
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Personal\Github\compro.rimba.laravel\resources\views/admin/how-we-work/index.blade.php ENDPATH**/ ?>