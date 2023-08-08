

<?php $__env->startSection('title'); ?>
CMS | Career
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
<link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.0/jquery.fancybox.min.css" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Career</h3>
<?php $__env->endSlot(); ?>
<?php echo e(Breadcrumbs::render('career')); ?>

<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<div class="boxHeader">
				
				<form class="row" method="GET">
                    <div class="col-8">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Career Create')): ?>
                        <a href="<?php echo e(route('career.create')); ?>" class="btn btn-primary _btn" role="button">
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
						<th class="center-text heightHr" >Work Type <span class="dividerHr"></span></th>
						<th class="center-text heightHr" >Location <span class="dividerHr"></span></th>
						<th class="center-text">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if(count($careers)): ?>
					<?php $__empty_1 = true; $__currentLoopData = $careers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $career): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
					<tr>
						<td style="width: 5%;" class="center-text"><?php echo e($loop->iteration); ?></td>
                        <td style="width: 30%;" class="center-text"><?php echo e($career->name); ?></td>
						<td style="width: 25%;" class="center-text"><?php echo e($career->work_type); ?></td>
						<td style="width: 30%;" class="center-text">
						<?php echo e($career->locatione->name); ?>

                        </td>
						<td style="width: 10%;" class="center-text boxAction fontField">
							<div class="boxInside">
								<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Career Update')): ?>
								<div class="boxEdit">
									<a href="<?php echo e(route('career.edit', ['career' => $career])); ?>" class="btn-sm btn-info" role="button">
										<i class="bx bx-edit"></i>
									</a>
								</div>
								<?php endif; ?>

								<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Career Delete')): ?>
								<div class="boxDelete">
									<form action="<?php echo e(route('career.destroy', ['career' => $career])); ?>" method="POST" role="alert">
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
				<?php if($careers->hasPages()): ?>
				<div class="boxPagination">
					<?php echo e($careers->links('vendor.pagination.bootstrap-4')); ?>

				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('javascript-internal'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.0/jquery.fancybox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u551360984/domains/lifetime-studios.com/public_html/cms-rimba/resources/views/admin/career/index.blade.php ENDPATH**/ ?>