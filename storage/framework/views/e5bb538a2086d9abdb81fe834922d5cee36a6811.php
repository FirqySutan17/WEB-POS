

<?php $__env->startSection('title'); ?>
CMS | Users
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Users</h3>
<?php $__env->endSlot(); ?>
<?php echo e(Breadcrumbs::render('users')); ?>

<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<div class="boxHeader">
				
				<form class="row" method="GET">
					<div class="col-8 boxContent">
						<div class="boxSearch _form-group">
							<input name="keyword" value="<?php echo e(request('keyword')); ?>" type="search" class="form-control" placeholder="Search for user.." style="border-top-left-radius: 5px; border-bottom-left-radius: 5px;">
						</div>
						<div class="boxBtn">
							<button class="btn btn-primary mb-3" type="submit">
								<i class="fa fa-search"></i>
							</button>
						</div>
					</div>
					<div class="col-4 pright">
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('User Create')): ?>
						<a href="<?php echo e(route('users.create')); ?>" class="btn btn-primary float-right" role="button">
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
						<th class="heightHr" style="width: 35%;">Name <span class="dividerHr"></span></th>
						<th class="heightHr" style="width: 30%;">Email <span class="dividerHr"></span></th>
						<th class="heightHr" style="width: 30%;">Role <span class="dividerHr"></span></th>
						<th style="width: 5%;" class="center-text">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if(count($users)): ?>
					<?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
					<tr>
						<td style="width: 35%;"><?php echo e($user->name); ?></td>
						<td style="width: 30%;"><?php echo e($user->email); ?></td>
						<td style="width: 30%;"><?php echo e($user->roles->first()->name??null); ?></td>
						<td style="width: 5%;" class="center-text boxAction fontField">
							<div class="boxInside">
								<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('User Update')): ?>
								<div class="boxEdit">
									<a href="<?php echo e(route('users.edit', ['user' => $user])); ?>" class="btn-sm btn-info" role="button">
										<i class="bx bx-edit"></i>
									</a>
								</div>
								<?php endif; ?>

								<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('User Delete')): ?>
								<div class="boxDelete">
									<form action="<?php echo e(route('users.destroy', ['user' => $user])); ?>" method="POST">
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
						<strong> No user data yet</strong>
					</p>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
		<div class="card-footer">
			<div class="boxFooter">
				<?php if($users->hasPages()): ?>
				<div class="boxPagination">
					<?php echo e($users->links('vendor.pagination.bootstrap-4')); ?>

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
				title: 'Delete User',
				text: 'Are you sure want to remove User?',
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
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Brandztory Projects\brandztory-website\bz-cms\resources\views/admin/users/index.blade.php ENDPATH**/ ?>