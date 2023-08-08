

<?php $__env->startSection('title'); ?>
CMS | Event
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
<link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.0/jquery.fancybox.min.css" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Event</h3>
<?php $__env->endSlot(); ?>
<?php echo e(Breadcrumbs::render('event')); ?>

<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<div class="boxHeader">
				
				<form class="row" method="GET">
                    <div class="col-8">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Event Create')): ?>
                        <a href="<?php echo e(route('event.create')); ?>" class="btn btn-primary _btn" role="button">
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
						<th class="center-text heightHr">Title <span class="dividerHr"></span></th>
						<th class="center-text heightHr">Date <span class="dividerHr"></span></th>
						<th class="center-text heightHr">Description <span class="dividerHr"></span></th>
						<th class="center-text heightHr" >Cover <span class="dividerHr"></span></th>
						<th class="center-text">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if(count($events)): ?>
					<?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
					<tr>
						<td style="width: 5%;" class="center-text"><?php echo e($loop->iteration); ?></td>
                        <td style="width: 20%;" class="center-text"><?php echo e($e->name); ?></td>
						<td style="width: 15%;" class="center-text"><?php echo e(date('Y-m-d', strtotime($e->date ))); ?></td>
                        <td style="width: 35%;" class="center-text"><?php echo Str::limit($e->description, 30); ?></td>
						<td style="width: 15%;" class="center-text">
                            <a data-fancybox="gallery" class="primary-btn" href="<?php echo e(asset('file_upload/'.$e->image_cover)); ?>" style="color: #063DFF;">Open Image</a>
                        </td>
						<td style="width: 10%;" class="center-text boxAction fontField">
							<div class="boxInside">
								<div class="boxEdit">
									<a href="<?php echo e(route('event.edit', ['event' => $e])); ?>" class="btn-sm btn-info" role="button">
										<i class="bx bx-edit"></i>
									</a>
								</div>
								<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Event Update')): ?>
								<?php endif; ?>

								<div class="boxDelete">
									<form action="<?php echo e(route('event.destroy', ['event' => $e])); ?>" method="POST">
										<?php echo csrf_field(); ?>
										<?php echo method_field('DELETE'); ?>
										<button type="submit" class="btn btn-sm btn-danger">
											<i class="bx bx-trash"></i>
										</button>
									</form>
								</div>
								<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Event Delete')): ?>
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
				<?php if($events->hasPages()): ?>
				<div class="boxPagination">
					<?php echo e($events->links('vendor.pagination.bootstrap-4')); ?>

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
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u551360984/domains/lifetime-studios.com/public_html/cms-rimba/resources/views/admin/event/index.blade.php ENDPATH**/ ?>