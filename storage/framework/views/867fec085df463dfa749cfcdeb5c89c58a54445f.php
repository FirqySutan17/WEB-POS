

<?php $__env->startSection('title'); ?>
CMS | Edit Articles
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Edit Articles</h3>
<?php $__env->endSlot(); ?>
<?php echo e(Breadcrumbs::render('edit_articles', $article)); ?>

<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<form action="<?php echo e(route('articles.update', ['article' => $article])); ?>" method="POST" enctype="multipart/form-data">
				<?php echo method_field('PUT'); ?>
				<?php echo csrf_field(); ?>
				<div class="card _card " style="width: 60%; margin: auto; padding-bottom: 20px">
					<div class="card-body _card-body">
						<div class="row d-flex align-items-stretch">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group _form-group">
                                            <label for="input_post_title" class="font-weight-bold">
                                                Title <span class="wajib">* </span>
                                            </label>
                                            <input id="input_post_title" value="<?php echo e(old('title', $article->title)); ?>" name="title" type="text" class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write title here.." />
                                            <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group _form-group">
                                            <label for="input_post_description" class="font-weight-bold">
                                                Description <span class="wajib">* </span>
                                            </label>
                                            <textarea name="description" placeholder="Write description here.." class="form-control" rows="5"><?php echo e($article->description); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- description -->
                                <button onclick="add_image()" type="button" class="btn btn-success _btn-success px-4">
                                    Add Image
                                </button>
                                <div class="mt-2" id="images_group">
                                    <?php if (!empty($article_images)): ?>
                                        <?php foreach ($article_images as $key => $img): ?>
                                            <?php
                                                $id = $key + 1;
                                                $txtarea_id = "element_desc_".$id;
                                                $item_id = "item_".$id;
                                            ?>
                                            <div id="<?php echo e($item_id); ?>">
                                                <input type="hidden" name="old_file[]" value="<?php echo e($img->image); ?>">
                                                <div class="form-group _form-group">
                                                    <label for="input_post_description" class="font-weight-bold">
                                                        Image <span class="wajib">* </span>
                                                    </label>
                                                    <div class="float-right">
                                                        <button onclick="delete_row('<?php echo e($item_id); ?>')" type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                                                    </div>
                                                    <input name="image[]" type="file" class="form-control images_data" />
                                                    <?php if (!empty($img->image)): ?>
                                                        <br>
                                                        <a href="<?php echo e(asset('file_upload/'.$img->image)); ?>" target="_blank" class="btn btn-primary">Lihat File</a>
                                                    <?php endif ?>
                                                </div>
                                                <div  class="form-group _form-group">
                                                    <label for="input_post_description" class="font-weight-bold">
                                                        Text A
                                                    </label>
                                                    <input name="text_a[]" type="text" class="form-control" placeholder="Write Text A.." value="<?php echo e($img->text_a); ?>" />
                                                </div>
                                                <div  class="form-group _form-group">
                                                    <label for="input_post_description" class="font-weight-bold">
                                                        Text B 
                                                    </label>
                                                    <input name="text_b[]" type="text" class="form-control" placeholder="Write Text B.." value="<?php echo e($img->text_b); ?>" />
                                                </div>
                                            </div>
                                            
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </div>
                            </div>
						</div>
						<div class="row">

							<div class="col-12">
								<div class="float-right mTop">
									<a class="btn btn-outline-primary _btn-primary px-4" href="<?php echo e(route('articles.index')); ?>">Back</a>
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
<?php $__env->stopPush(); ?>

<?php $__env->startPush('javascript-external'); ?>
<script src="<?php echo e(asset('vendor/laravel-filemanager/js/stand-alone-button.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/tinymce5/jquery.tinymce.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/tinymce5/tinymce.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/select2/js/select2.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/select2/js/' . app()->getLocale() . '.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('javascript-internal'); ?>
<script>
    function add_image() {
        var id = $('.images_data').length + 1;
        var txtarea_id = "element_desc_" + id;
        var item_id = "item_" + id;
        var html = `
            <div id="${item_id}">
                <div class="form-group _form-group">
                    <label for="input_post_description" class="font-weight-bold">
                        Image <span class="wajib">* </span>
                    </label>
                    <div class="float-right">
                        <button onclick="delete_row('${item_id}')" type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                    </div>
                    <input name="image[]" type="file" class="form-control images_data" />
                </div>
                <div  class="form-group _form-group">
                    <label for="input_post_description" class="font-weight-bold">
                        Text A 
                    </label>
                    <input name="text_a[]" type="text" class="form-control" placeholder="Write Text A.." />
                </div>
                <div  class="form-group _form-group">
                    <label for="input_post_description" class="font-weight-bold">
                        Text B 
                    </label>
                    <input name="text_b[]" type="text" class="form-control" placeholder="Write Text B.." />
                </div>
            </div>
        `;
        $("#images_group").append(html);

    }

    function delete_row(eid) {
        $("#" + eid).remove();
    }

</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Personal\Github\laravel-cms\resources\views/admin/article/edit.blade.php ENDPATH**/ ?>