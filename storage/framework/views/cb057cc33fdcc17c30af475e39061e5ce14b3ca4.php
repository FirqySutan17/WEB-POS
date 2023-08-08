

<?php $__env->startSection('title'); ?>
CMS | Edit User
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Edit User</h3>
<?php $__env->endSlot(); ?>
<?php echo e(Breadcrumbs::render('edit_user', $user)); ?>

<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<form action="<?php echo e(route('users.update', ['user' => $user])); ?>" method="POST" enctype="multipart/form-data">
				<?php echo method_field('PUT'); ?>
				<?php echo csrf_field(); ?>
				<div class="card _card " style="width: 60%; margin: auto">
					<div class="card-body _card-body">
						<div class="row d-flex align-items-stretch">

							<div class="col-12">
								
								<div class="form-group _form-group">
									<div class="avatar-upload">
										<div class="avatar-edit">
											<input name="image" type="file" value="<?php echo e(old('image', $user->image)); ?>" class="form-control" type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
											<label for="imageUpload"></label>
										</div>
										<div class="avatar-preview">
											<div id="imagePreview" style="background-image: url('<?php echo e(asset('file_upload/'.$user->image)); ?>');">
											</div>
										</div>
									</div>
								</div>
                                <!-- end image -->

								<div class="row">
									<div class="col-6">
										<!-- Employee ID -->
                                        <div class="form-group _form-group">
                                            <label for="input_user_name" class="font-weight-bold">
                                                Employee ID <span class="wajib">*</span>
                                            </label>
                                            <input id="input_user_name" value="<?php echo e(old('employee_id', $user->employee_id)); ?>" name="employee_id" type="text" class="form-control <?php $__errorArgs = ['employee_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Input Employee ID.." readonly />
                                            <?php $__errorArgs = ['employee_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback">
                                                <?php echo e($message); ?>

                                            </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            <!-- error message -->
                                        </div>
                                        <!-- end Employee ID -->

										<!-- email -->
										<div class="form-group _form-group">
											<label for="input_user_email" class="font-weight-bold">
												Email <span class="wajib">*</span>
											</label>
											<input id="input_user_email" value="<?php echo e(old('email', $user->email)); ?>" name="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write email here.." autocomplete="email" readonly />
											<?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
											<span class="invalid-feedback">
												<?php echo e($message); ?>

											</span>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
											<!-- error message -->
										</div>
										<!-- end email -->

										<!-- role -->
                                        <div class="form-group _form-group">
                                            <label for="select_user_office" class="font-weight-bold">
                                                Office <span class="wajib">*</span>
                                            </label>
                                            <select id="select_user_office" name="office" data-placeholder="Choose Office" class="js-example-placeholder-multiple">
                                                <option value="Choose Office" <?php echo e($user->office == 'Choose Office' ? 'selected':''); ?>>Choose Office</option>
                                                <option value="Rimba House, Cipondoh" <?php echo e($user->office == 'Rimba House, Cipondoh' ? 'selected':''); ?>>Rimba House, Cipondoh</option>
                                                <option value="Rimba House, Jakarta" <?php echo e($user->office == 'Rimba House, Jakarta' ? 'selected':''); ?>>Rimba House, Jakarta</option>
                                            </select>
                                            <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback">
                                                <?php echo e($message); ?>

                                            </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            <!-- error message -->
                                        </div>
                                        <!-- end role -->
									</div>
									<div class="col-6">
										<!-- name -->
										<div class="form-group _form-group">
											<label for="input_user_name" class="font-weight-bold">
												Name <span class="wajib">*</span>
											</label>
											<input id="input_user_name" value="<?php echo e(old('name', $user->name)); ?>" name="name" type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write name here.." />
											<?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
											<span class="invalid-feedback">
												<?php echo e($message); ?>

											</span>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
											<!-- error message -->
										</div>
										<!-- end name -->

										<!-- Phone Number -->
                                        <div class="form-group _form-group">
                                            <label for="input_user_name" class="font-weight-bold">
                                                Phone Number <span class="wajib">*</span>
                                            </label>
                                            <input id="input_user_name" value="<?php echo e(old('phone_number', $user->phone_number)); ?>" name="phone_number" type="text" class="form-control <?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Input Phone Number" readonly />
                                            <?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback">
                                                <?php echo e($message); ?>

                                            </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            <!-- error message -->
                                        </div>
                                        <!-- end name -->

										<!-- role -->
										<div class="form-group _form-group">
											<label for="select_user_role" class="font-weight-bold">
												Role <span class="wajib">*</span>
											</label>
											<select id="select_user_role" name="role" data-placeholder="Choose Role" class="js-example-placeholder-multiple">
												<option value="0">Choose Role</option>
												<?php if(old('role', $roleSelected)): ?>
												<option value="<?php echo e(old('role', $roleSelected)->id); ?>" selected>
													<?php echo e(old('role', $roleSelected)->name); ?>

												</option>
												<?php endif; ?>
											</select>
											<?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
											<span class="invalid-feedback">
												<?php echo e($message); ?>

											</span>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
											<!-- error message -->
										</div>
										<!-- end role -->
									</div>
								</div>

								<!-- status -->
								<div class="form-group <?php echo e($errors->has('status') ? ' has-error' : ''); ?> _form-group" style="display: flex;">
									<label for="input_banner_status" class="font-weight-bold" style="padding: 7px 0px; margin-right: 20px;">
									  Status
									</label>
									<div class="col-2">
									  <div class="media">
										<div class="media-body text-end icon-state">
										  <label class="switch">
											<input type="checkbox" name="status" <?php echo e(old("status", $user->status) == 1  ? "checked"  : null); ?>><span class="switch-state"></span>
										  </label>
										</div>
									  </div>
									</div>
								  </div>
								  <!-- end status -->
							</div>
						</div>
						<div class="row">

							<div class="col-12">
								<div class="float-right">
									<a class="btn btn-outline-primary _btn-primary px-4" href="<?php echo e(route('users.index')); ?>">Back</a>
									<button type="submit" class="btn btn-primary _btn-primary px-4">
										Update
									</button>
								</div>
							</div>

						</div>
					</div>
				</div>
			</form>
		</div>
	</div>

</div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('css-external'); ?>
<link rel="stylesheet" href="<?php echo e(asset('vendor/select2/css/select2.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('vendor/select2/css/select2-bootstrap4.min.css')); ?>">
<style>
	.avatar-upload {
	position: relative;
	max-width: 205px;
	margin: 50px auto;
	}
	.avatar-upload .avatar-edit {
	position: absolute;
	right: 20px;
	z-index: 1;
	top: 10px;
	}
	.avatar-upload .avatar-edit input {
	display: none;
	}
	.avatar-upload .avatar-edit input + label {
	display: inline-block;
	width: 34px;
	height: 34px;
	margin-bottom: 0;
	border-radius: 100%;
	background: #FFFFFF;
	border: 1px solid transparent;
	box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
	cursor: pointer;
	font-weight: normal;
	transition: all 0.2s ease-in-out;
	}
	.avatar-upload .avatar-edit input + label:hover {
	background: #f1f1f1;
	border-color: #d6d6d6;
	}
	.avatar-upload .avatar-edit input + label:after {
	content: "\f040";
	font-family: 'FontAwesome';
	color: #757575;
	position: absolute;
	top: 8px;
	left: 0;
	right: 0;
	text-align: center;
	margin: auto;
	}
	.avatar-upload .avatar-preview {
	width: 150px;
	height: 150px;
	margin: auto;
	position: relative;
	border-radius: 100%;
	border: 6px solid #F8F8F8;
	box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
	}
	.avatar-upload .avatar-preview > div {
	width: 100%;
	height: 100%;
	border-radius: 100%;
	background-size: cover;
	background-repeat: no-repeat;
	background-position: center;
	}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('javascript-external'); ?>
<script src="<?php echo e(asset('vendor/select2/js/select2.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/select2/js/' . app()->getLocale() . '.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/laravel-filemanager/js/stand-alone-button.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('javascript-internal'); ?>
<script>
	$(function() {
		//parent category
		$('#select_user_role').select2({
			theme: 'bootstrap4',
			language: "<?php echo e(app()->getLocale()); ?>",
			allowClear: true,
			ajax: {
				url: "<?php echo e(route('roles.select')); ?>",
				dataType: 'json',
				delay: 250,
				processResults: function(data) {
					return {
						results: $.map(data, function(item) {
							return {
								text: item.name,
								id: item.id
							}
						})
					};
				}
			}
		});

		$('#select_user_office').select2({
            theme: 'bootstrap4',
            language: "<?php echo e(app()->getLocale()); ?>",
            allowClear: true,
            // ajax: {
            //     url: "<?php echo e(route('roles.select')); ?>",
            //     dataType: 'json',
            //     delay: 250,
            //     processResults: function(data) {
            //         return {
            //             results: $.map(data, function(item) {
            //                 return {
            //                     text: item.name,
            //                     id: item.id
            //                 }
            //             })
            //         };
            //     }
            // }
        });
	});
</script>
<script>
    function readURL(input) {
    	if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#imagePreview').css('background-image', 'url('+e.target.result +')');
				$('#imagePreview').hide();
				$('#imagePreview').fadeIn(650);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#imageUpload").change(function() {
		readURL(this);
	});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Personal\Github\koontjie-be\resources\views/admin/users/edit.blade.php ENDPATH**/ ?>