

<?php $__env->startSection('title'); ?>
CMS | Add Page Meta
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/image-style.css')); ?>">
<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/select2.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Add Page Meta</h3>
<?php $__env->endSlot(); ?>
<?php echo e(Breadcrumbs::render('add_meta')); ?>

<?php echo $__env->renderComponent(); ?>

<!-- Container-fluid starts-->
<div class="container-fluid">

  <div class="row">
    <div class="col-12">

      <form action="<?php echo e(route('metas.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="card _card">
          <div class="card-body _card-body">
            <div class="row">
              <div class="col-6">
                <!-- Name -->
                <div class="form-group _form-group">
                  <label for="input_project_title">
                    Name <span class="wajib">* </span>
                  </label>
                  <input id="input_project_title" value="<?php echo e(old('name')); ?>" name="name" type="text" class="form-control <?php $__errorArgs = ['name'];
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
                  <span class="invalid-feedback" role="alert">
                    <strong><?php echo e($message); ?></strong>
                  </span>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <!-- end name -->
              </div>

              <div class="col-6">
                <!-- slug -->
                <div class="form-group _form-group">
                  <label for="input_project_slug">
                    Slug
                  </label>
                  <input id="input_project_slug" value="<?php echo e(old('slug')); ?>" name="slug" type="text" class="form-control <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Auto Generate" readonly />
                  <?php $__errorArgs = ['slug'];
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
                <!-- end slug -->
              </div>
            </div>

            <div class="row d-flex align-items-stretch mt-4">
              <div class="col-12">
                <nav>
                  <div class="nav nav-tabs justify-content-center nav-primary" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-id-tab" data-bs-toggle="tab" data-bs-target="#nav-id" type="button" role="tab" aria-controls="nav-id" aria-selected="true">Bahasa</button>
                    <button class="nav-link" id="nav-en-tab" data-bs-toggle="tab" data-bs-target="#nav-en" type="button" role="tab" aria-controls="nav-en" aria-selected="false">English</button>
                  </div>
                </nav>

                <div class="tab-content" id="nav-tabContent">
                  <!-- Main Language -->
                  <div class="tab-pane fade show active tab-custom" id="nav-id" role="tabpanel" aria-labelledby="nav-id-tab">

                    <!-- Page -->
                    <div class="row">
                      <div class="col-6">
                        <!-- title -->
                        <div class="form-group _form-group">
                          <label for="input_post_title">
                            Page <span class="wajib">* </span>
                          </label>
                          <input id="input_post_title" value="<?php echo e(old('id_page_name')); ?>" name="id_page_name" type="text" class="form-control <?php $__errorArgs = ['id_page_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write title here.." />
                          <?php $__errorArgs = ['id_page_name'];
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
                        <!-- end title -->
                      </div>

                      <div class="col-6">
                        <!-- slug -->
                        <div class="form-group _form-group">
                          <label for="input_post_slug">
                            Slug
                          </label>
                          <input id="input_post_slug" value="<?php echo e(old('id_page_slug')); ?>" name="id_page_slug" type="text" class="form-control <?php $__errorArgs = ['id_page_slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Auto Generate" readonly />
                          <?php $__errorArgs = ['id_page_slug'];
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
                        <!-- end slug -->
                      </div>
                    </div>
                    <!-- End Page -->

                    <div class="accordion" id="accordionExample">

                      <!-- Meta -->
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                            Metas
                          </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse show" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                          <div class="accordion-body">
                            <div class="row">
                              <div class="col-6">
                                <!-- meta title -->
                                <div class="form-group _form-group">
                                  <label for="input_meta_title">
                                    Meta Title <span class="wajib">* </span>
                                  </label>
                                  <input id="input_meta_title" value="<?php echo e(old('id_meta_title')); ?>" name="id_meta_title" type="text" class="form-control <?php $__errorArgs = ['id_meta_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write title here.." />
                                  <?php $__errorArgs = ['meta_title'];
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
                                <!-- end meta title -->
                              </div>

                              <div class="col-6">
                                <!-- meta robots -->
                                <div class="form-group _form-group">
                                  <label for="input_meta_robots">
                                    Meta Robots <span class="wajib">* </span>
                                  </label>
                                  <input id="input_meta_robots" value="<?php echo e(old('id_meta_robots')); ?>" name="id_meta_robots" type="text" class="form-control <?php $__errorArgs = ['id_meta_robots'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write here.." />
                                  <?php $__errorArgs = ['meta_robots'];
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
                                <!-- end meta robots -->
                              </div>
                            </div>
                            <!-- meta keyword -->
                            <div class="form-group _form-group">
                              <label for="input_meta_keyword">
                                Meta Keyword <span class="wajib">* </span>
                              </label>
                              <textarea id="input_meta_keyword" name="id_meta_keyword" type="text" class="form-control <?php $__errorArgs = ['id_meta_keyword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write keyword here.." rows="3"><?php echo e(old('id_meta_keyword')); ?></textarea>
                              <?php $__errorArgs = ['id_meta_keyword'];
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
                            <!-- end meta keyword -->

                            <!-- meta description -->
                            <div class="form-group _form-group">
                              <label for="input_meta_description">
                                Meta Description <span class="wajib">* </span>
                              </label>
                              <textarea id="input_meta_description" name="id_meta_description" type="text" class="form-control <?php $__errorArgs = ['id_meta_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write title here.." rows="3"><?php echo e(old('id_meta_description')); ?></textarea>
                              <?php $__errorArgs = ['id_meta_description'];
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
                            <!-- end meta description -->

                          </div>
                        </div>
                      </div>
                      <!-- End Meta -->

                      <!-- OpenGraph -->
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFive">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            OpenGraph
                          </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                          <div class="accordion-body">
                            <!-------------------------------->

                            <div class="row">
                              <div class="col-6">
                                <!-- og title -->
                                <div class="form-group _form-group">
                                  <label for="input_og_title">
                                    Title - OpenGraph <span class="wajib">* </span>
                                  </label>
                                  <input id="input_og_title" value="<?php echo e(old('id_og_title')); ?>" name="id_og_title" type="text" class="form-control <?php $__errorArgs = ['id_og_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write title here.." />
                                  <?php $__errorArgs = ['id_og_title'];
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
                                <!-- end og title -->
                              </div>
                              <div class="col-6">
                                <!-- og site name -->
                                <div class="form-group _form-group">
                                  <label for="input_og_site_name">
                                    Site Name - OpenGraph <span class="wajib">* </span>
                                  </label>
                                  <input id="input_og_site_name" value="<?php echo e(old('id_og_site_name')); ?>" name="id_og_site_name" type="text" class="form-control <?php $__errorArgs = ['id_og_site_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write site name here.." />
                                  <?php $__errorArgs = ['id_og_site_name'];
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
                                <!-- end og site name -->
                              </div>
                            </div>

                            <!-------------------------------->

                            <div class="row">
                              <div class="col-6">
                                <!-- og url -->
                                <div class="form-group _form-group">
                                  <label for="input_og_url">
                                    URL - OpenGraph <span class="wajib">* </span>
                                  </label>
                                  <input id="input_og_url" value="<?php echo e(old('id_og_url')); ?>" name="id_og_url" type="text" class="form-control <?php $__errorArgs = ['id_og_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write url here.." />
                                  <?php $__errorArgs = ['id_og_url'];
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
                                <!-- end og url -->
                              </div>
                              <div class="col-6">
                                <!-- og type -->
                                <div class="form-group _form-group">
                                  <label for="input_og_type">
                                    Type - OpenGraph <span class="wajib">* </span>
                                  </label>
                                  <input id="input_og_type" value="<?php echo e(old('id_og_type')); ?>" name="id_og_type" type="text" class="form-control <?php $__errorArgs = ['id_og_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write type here.." />
                                  <?php $__errorArgs = ['id_og_type'];
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
                                <!-- end og type -->
                              </div>
                            </div>

                            <!-------------------------------->

                            <div class="row">
                              <div class="col-6">
                                <!-- og locale -->
                                <div class="form-group _form-group">
                                  <label for="input_og_locale">
                                    Locale - OpenGraph <span class="wajib">* </span>
                                  </label>
                                  <input id="input_og_locale" value="<?php echo e(old('id_og_locale')); ?>" name="id_og_locale" type="text" class="form-control <?php $__errorArgs = ['id_og_locale'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write locale here.." />
                                  <?php $__errorArgs = ['id_og_locale'];
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
                                <!-- end og locale -->
                              </div>
                              <div class="col-6">
                                <!-- og locale alternate -->
                                <div class="form-group _form-group">
                                  <label for="input_og_locale_alternate">
                                    Locale: alternate - OpenGraph <span class="wajib">* </span>
                                  </label>
                                  <input id="input_og_locale_alternate" value="<?php echo e(old('id_og_locale_alternate')); ?>" name="id_og_locale_alternate" type="text" class="form-control <?php $__errorArgs = ['id_og_locale_alternate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write locale alternate here.." />
                                  <?php $__errorArgs = ['id_og_locale_alternate'];
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
                                <!-- end og locale alternate -->
                              </div>
                            </div>

                            <!-------------------------------->

                            <!-- og description -->
                            <div class="form-group _form-group">
                              <label for="input_og_description">
                                Description - OpenGraph <span class="wajib">* </span>
                              </label>
                              <textarea id="input_og_description" name="id_og_description" type="text" class="form-control <?php $__errorArgs = ['id_og_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write title here.." rows="3"><?php echo e(old('id_og_description')); ?></textarea>
                              <?php $__errorArgs = ['id_og_description'];
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
                            <!-- end og description -->

                            <!-- image -->
                            <div class="form-group _form-group">
                              <label for="upload_img">
                                Image - OpenGraph <span class="wajib">* </span>
                              </label>
                              <input type="file" value="<?php echo e(old('id_og_image')); ?>" name="id_og_image" require class="form-control <?php $__errorArgs = ['id_og_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="upload_img">
                              <?php $__errorArgs = ['id_og_image'];
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
                            <!-- end image -->

                            <!-------------------------------->

                            <div class="row">
                              <div class="col-6">
                                <!-- og image width -->
                                <div class="form-group _form-group">
                                  <label for="input_og_image_width">
                                    Image: width - OpenGraph <span class="wajib">* </span>
                                  </label>
                                  <input id="input_og_image_width" value="<?php echo e(old('id_og_image_width')); ?>" name="id_og_image_width" type="text" class="form-control <?php $__errorArgs = ['id_og_image_width'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="image width as px" />
                                  <?php $__errorArgs = ['id_og_image_width'];
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
                                <!-- end og image width -->
                              </div>
                              <div class="col-6">
                                <!-- og image height -->
                                <div class="form-group _form-group">
                                  <label for="input_og_image_height">
                                    Image: height - OpenGraph <span class="wajib">* </span>
                                  </label>
                                  <input id="input_og_image_height" value="<?php echo e(old('id_og_image_height')); ?>" name="id_og_image_height" type="text" class="form-control <?php $__errorArgs = ['id_og_image_height'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="image height as px" />
                                  <?php $__errorArgs = ['id_og_image_height'];
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
                                <!-- end og image height -->
                              </div>
                            </div>

                            <!-------------------------------->

                          </div>
                        </div>
                      </div>
                      <!-- End OpenGraph -->

                      <!-- Twitter -->
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="headingSix">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                            Twitter
                          </button>
                        </h2>
                        <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                          <div class="accordion-body">
                            <!-------------------------------->

                            <div class="row">
                              <div class="col-6">
                                <!-- twitter title -->
                                <div class="form-group _form-group">
                                  <label for="input_twitter_title">
                                    Title - Twittter <span class="wajib">* </span>
                                  </label>
                                  <input id="input_twitter_title" value="<?php echo e(old('id_twitter_title')); ?>" name="id_twitter_title" type="text" class="form-control <?php $__errorArgs = ['id_twitter_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write title here.." />
                                  <?php $__errorArgs = ['id_twitter_title'];
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
                                <!-- end twitter card -->
                              </div>
                              <div class="col-6">
                                <!-- twitter site -->
                                <div class="form-group _form-group">
                                  <label for="input_twitter_site">
                                    Site - Twitter <span class="wajib">* </span>
                                  </label>
                                  <input id="input_twitter_site" value="<?php echo e(old('id_twitter_site')); ?>" name="id_twitter_site" type="text" class="form-control <?php $__errorArgs = ['id_twitter_site'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write site name here.." />
                                  <?php $__errorArgs = ['id_twitter_site'];
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
                                <!-- end twitter site -->
                              </div>
                            </div>

                            <!-------------------------------->

                            <div class="row">
                              <div class="col-6">
                                <!-- twitter card -->
                                <div class="form-group _form-group">
                                  <label for="input_twitter_card">
                                    Card - Twitter <span class="wajib">* </span>
                                  </label>
                                  <input id="input_twitter_card" value="<?php echo e(old('id_twitter_card')); ?>" name="id_twitter_card" type="text" class="form-control <?php $__errorArgs = ['id_twitter_card'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write card here.." />
                                  <?php $__errorArgs = ['id_twitter_card'];
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
                                <!-- end twitter card -->
                              </div>
                              <div class="col-6">
                                <!-- twitter site name -->
                                <div class="form-group _form-group">
                                  <label for="input_twitter_card">
                                    Creator - Twitter <span class="wajib">* </span>
                                  </label>
                                  <input id="input_twitter_creator" value="<?php echo e(old('id_twitter_creator')); ?>" name="id_twitter_creator" type="text" class="form-control <?php $__errorArgs = ['id_twitter_creator'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write site name here.." />
                                  <?php $__errorArgs = ['id_twitter_creator'];
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
                                <!-- end og site name -->
                              </div>
                            </div>

                            <!-------------------------------->

                            <!-- image -->
                            <div class="form-group _form-group">
                              <label for="upload_img">
                                Image - Twitter <span class="wajib">* </span>
                              </label>
                              <input type="file" value="<?php echo e(old('id_twitter_image')); ?>" name="id_twitter_image" require class="form-control <?php $__errorArgs = ['id_twitter_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="upload_img">
                              <?php $__errorArgs = ['id_twitter_image'];
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
                            <!-- end image -->

                            <!-- twitter description -->
                            <div class="form-group _form-group">
                              <label for="input_twitter_description">
                                Description - Twitter <span class="wajib">* </span>
                              </label>
                              <textarea id="input_twitter_description" name="id_twitter_description" type="text" class="form-control <?php $__errorArgs = ['id_twitter_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write title here.." rows="3"><?php echo e(old('id_twitter_description')); ?></textarea>
                              <?php $__errorArgs = ['id_twitter_description'];
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
                            <!-- end twitter description -->

                          </div>
                        </div>
                      </div>
                      <!-- End Twitter -->

                      <!-- Schema Markup -->
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="headingSeven">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                            Schema Markup
                          </button>
                        </h2>
                        <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                          <div class="accordion-body">
                            <!-------------------------------->

                            <!-- schema markup description -->
                            <div class="form-group _form-group">
                              <label for="input_twitter_description">
                                Schema Markup <span class="wajib">* </span>
                              </label>
                              <textarea id="input_id_schema_markup" name="id_schema_markup" type="text" class="form-control <?php $__errorArgs = ['id_schema_markup'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write title here.." rows="3"><?php echo e(old('id_schema_markup')); ?></textarea>
                              <?php $__errorArgs = ['id_schema_markup'];
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
                            <!-- end twitter description -->

                          </div>
                        </div>
                      </div>
                      <!-- End Schema Markup -->
                    </div>

                  </div>
                  <!-- End Main Language -->

                  <!-- Other Language -->
                  <div class="tab-pane fade tab-custom" id="nav-en" role="tabpanel" aria-labelledby="nav-en-tab">
                    <!-- Page -->
                    <div class="row">
                      <div class="col-6">
                        <!-- title -->
                        <div class="form-group _form-group">
                          <label for="input_post_title">
                            Page <span class="wajib">* </span>
                          </label>
                          <input id="input_en_title" value="<?php echo e(old('en_page_name')); ?>" name="en_page_name" type="text" class="form-control <?php $__errorArgs = ['en_page_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write title here.." />
                          <?php $__errorArgs = ['en_page_name'];
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
                        <!-- end title -->
                      </div>

                      <div class="col-6">
                        <!-- slug -->
                        <div class="form-group _form-group">
                          <label for="input_post_slug">
                            Slug
                          </label>
                          <input id="input_en_slug" value="<?php echo e(old('en_page_slug')); ?>" name="en_page_slug" type="text" class="form-control <?php $__errorArgs = ['en_page_slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Auto Generate" readonly />
                          <?php $__errorArgs = ['en_page_slug'];
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
                        <!-- end slug -->
                      </div>
                    </div>
                    <!-- End Page -->

                    <!-- Meta -->
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          Metas
                        </button>
                      </h2>
                      <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">

                          <div class="row">
                            <div class="col-6">
                              <!-- meta title -->
                              <div class="form-group _form-group">
                                <label for="input_meta_title">
                                  Meta Title <span class="wajib">* </span>
                                </label>
                                <input id="input_meta_title" value="<?php echo e(old('en_meta_title')); ?>" name="en_meta_title" type="text" class="form-control <?php $__errorArgs = ['en_meta_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write title here.." />
                                <?php $__errorArgs = ['en_meta_title'];
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
                              <!-- end meta title -->
                            </div>

                            <div class="col-6">
                              <!-- meta robots -->
                              <div class="form-group _form-group">
                                <label for="input_meta_robots">
                                  Meta Robots <span class="wajib">* </span>
                                </label>
                                <input id="input_meta_robots" value="<?php echo e(old('en_meta_robots')); ?>" name="en_meta_robots" type="text" class="form-control <?php $__errorArgs = ['en_meta_robots'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write here.." />
                                <?php $__errorArgs = ['en_meta_robots'];
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
                              <!-- end meta robots -->
                            </div>
                          </div>

                          <!-- meta keyword -->
                          <div class="form-group _form-group">
                            <label for="input_meta_keyword">
                              Meta Keyword <span class="wajib">* </span>
                            </label>
                            <textarea id="input_meta_keyword" name="en_meta_keyword" type="text" class="form-control <?php $__errorArgs = ['en_meta_keyword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write keyword here.." rows="3"><?php echo e(old('en_meta_keyword')); ?></textarea>
                            <?php $__errorArgs = ['en_meta_keyword'];
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
                          <!-- end meta keyword -->

                          <!-- meta description -->
                          <div class="form-group _form-group">
                            <label for="input_meta_description">
                              Meta Description <span class="wajib">* </span>
                            </label>
                            <textarea id="input_meta_description" name="en_meta_description" type="text" class="form-control <?php $__errorArgs = ['en_meta_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write title here.." rows="3"><?php echo e(old('en_meta_description')); ?></textarea>
                            <?php $__errorArgs = ['en_meta_description'];
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
                          <!-- end meta description -->

                        </div>
                      </div>
                    </div>
                    <!-- End Meta -->

                    <!-- OpenGraph -->
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          OpenGraph
                        </button>
                      </h2>
                      <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          <!-------------------------------->

                          <div class="row">
                            <div class="col-6">
                              <!-- og title -->
                              <div class="form-group _form-group">
                                <label for="input_og_title">
                                  Title - OpenGraph <span class="wajib">* </span>
                                </label>
                                <input id="input_og_title" value="<?php echo e(old('en_og_title')); ?>" name="en_og_title" type="text" class="form-control <?php $__errorArgs = ['en_og_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write title here.." />
                                <?php $__errorArgs = ['en_og_title'];
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
                              <!-- end og title -->
                            </div>
                            <div class="col-6">
                              <!-- og site name -->
                              <div class="form-group _form-group">
                                <label for="input_og_site_name">
                                  Site Name - OpenGraph <span class="wajib">* </span>
                                </label>
                                <input id="input_og_site_name" value="<?php echo e(old('en_og_site_name')); ?>" name="en_og_site_name" type="text" class="form-control <?php $__errorArgs = ['en_og_site_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write site name here.." />
                                <?php $__errorArgs = ['en_og_site_name'];
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
                              <!-- end og site name -->
                            </div>
                          </div>

                          <!-------------------------------->

                          <div class="row">
                            <div class="col-6">
                              <!-- og url -->
                              <div class="form-group _form-group">
                                <label for="input_og_url">
                                  URL - OpenGraph <span class="wajib">* </span>
                                </label>
                                <input id="input_og_url" value="<?php echo e(old('en_og_url')); ?>" name="en_og_url" type="text" class="form-control <?php $__errorArgs = ['en_og_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write url here.." />
                                <?php $__errorArgs = ['en_og_url'];
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
                              <!-- end og url -->
                            </div>
                            <div class="col-6">
                              <!-- og type -->
                              <div class="form-group _form-group">
                                <label for="input_og_type">
                                  Type - OpenGraph <span class="wajib">* </span>
                                </label>
                                <input id="input_og_type" value="<?php echo e(old('en_og_type')); ?>" name="en_og_type" type="text" class="form-control <?php $__errorArgs = ['en_og_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write type here.." />
                                <?php $__errorArgs = ['en_og_type'];
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
                              <!-- end og type -->
                            </div>
                          </div>

                          <!-------------------------------->

                          <div class="row">
                            <div class="col-6">
                              <!-- og locale -->
                              <div class="form-group _form-group">
                                <label for="input_og_locale">
                                  Locale - OpenGraph <span class="wajib">* </span>
                                </label>
                                <input id="input_og_locale" value="<?php echo e(old('en_og_locale')); ?>" name="en_og_locale" type="text" class="form-control <?php $__errorArgs = ['en_og_locale'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write locale here.." />
                                <?php $__errorArgs = ['en_og_locale'];
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
                              <!-- end og locale -->
                            </div>
                            <div class="col-6">
                              <!-- og locale alternate -->
                              <div class="form-group _form-group">
                                <label for="input_og_locale_alternate">
                                  Locale: alternate - OpenGraph <span class="wajib">* </span>
                                </label>
                                <input id="input_og_locale_alternate" value="<?php echo e(old('en_og_locale_alternate')); ?>" name="en_og_locale_alternate" type="text" class="form-control <?php $__errorArgs = ['en_og_locale_alternate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write locale alternate here.." />
                                <?php $__errorArgs = ['en_og_locale_alternate'];
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
                              <!-- end og locale alternate -->
                            </div>
                          </div>

                          <!-------------------------------->

                          <!-- og description -->
                          <div class="form-group _form-group">
                            <label for="input_og_description">
                              Description - OpenGraph <span class="wajib">* </span>
                            </label>
                            <textarea id="input_og_description" name="en_og_description" type="text" class="form-control <?php $__errorArgs = ['en_og_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write title here.." rows="3"><?php echo e(old('en_og_description')); ?></textarea>
                            <?php $__errorArgs = ['en_og_description'];
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
                          <!-- end og description -->

                          <!-- image -->
                          <div class="form-group _form-group">
                            <label for="upload_img">
                              Image - OpenGraph <span class="wajib">* </span>
                            </label>
                            <input type="file" value="<?php echo e(old('en_og_image')); ?>" name="en_og_image" require class="form-control <?php $__errorArgs = ['en_og_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="upload_img">
                            <?php $__errorArgs = ['en_og_image'];
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
                          <!-- end image -->

                          <!-------------------------------->

                          <div class="row">
                            <div class="col-6">
                              <!-- og image width -->
                              <div class="form-group _form-group">
                                <label for="input_og_image_width">
                                  Image: width - OpenGraph <span class="wajib">* </span>
                                </label>
                                <input id="input_og_image_width" value="<?php echo e(old('en_og_image_width')); ?>" name="en_og_image_width" type="text" class="form-control <?php $__errorArgs = ['en_og_image_width'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="image width as px" />
                                <?php $__errorArgs = ['en_og_image_width'];
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
                              <!-- end og image width -->
                            </div>
                            <div class="col-6">
                              <!-- og image height -->
                              <div class="form-group _form-group">
                                <label for="input_og_image_height">
                                  Image: height - OpenGraph <span class="wajib">* </span>
                                </label>
                                <input id="input_og_image_height" value="<?php echo e(old('en_og_image_height')); ?>" name="en_og_image_height" type="text" class="form-control <?php $__errorArgs = ['en_og_image_height'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="image height as px" />
                                <?php $__errorArgs = ['en_og_image_height'];
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
                              <!-- end og image height -->
                            </div>
                          </div>

                          <!-------------------------------->

                        </div>
                      </div>
                    </div>
                    <!-- End OpenGraph -->

                    <!-- Twitter -->
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          Twitter
                        </button>
                      </h2>
                      <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          <!-------------------------------->

                          <div class="row">
                            <div class="col-6">
                              <!-- twitter title -->
                              <div class="form-group _form-group">
                                <label for="input_twitter_title"></label>
                                Title - Twittter <span class="wajib">* </span>
                                </label>
                                <input id="input_twitter_title" value="<?php echo e(old('en_twitter_title')); ?>" name="en_twitter_title" type="text" class="form-control <?php $__errorArgs = ['en_twitter_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write title here.." />
                                <?php $__errorArgs = ['en_twitter_title'];
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
                              <!-- end twitter card -->
                            </div>
                            <div class="col-6">
                              <!-- twitter site -->
                              <div class="form-group _form-group">
                                <label for="input_twitter_site">
                                  Site - Twitter <span class="wajib">* </span>
                                </label>
                                <input id="input_twitter_site" value="<?php echo e(old('en_twitter_site')); ?>" name="en_twitter_site" type="text" class="form-control <?php $__errorArgs = ['en_twitter_site'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write site name here.." />
                                <?php $__errorArgs = ['en_twitter_site'];
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
                              <!-- end twitter site -->
                            </div>
                          </div>

                          <!-------------------------------->

                          <div class="row">
                            <div class="col-6">
                              <!-- twitter card -->
                              <div class="form-group _form-group">
                                <label for="input_twitter_card">
                                  Card - Twitter <span class="wajib">* </span>
                                </label>
                                <input id="input_twitter_card" value="<?php echo e(old('en_twitter_card')); ?>" name="en_twitter_card" type="text" class="form-control <?php $__errorArgs = ['en_twitter_card'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write card here.." />
                                <?php $__errorArgs = ['en_twitter_card'];
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
                              <!-- end twitter card -->
                            </div>
                            <div class="col-6">
                              <!-- twitter site name -->
                              <div class="form-group _form-group">
                                <label for="input_twitter_creator">
                                  Creator - Twittter <span class="wajib">* </span>
                                </label>
                                <input id="input_twitter_creator" value="<?php echo e(old('en_twitter_creator')); ?>" name="en_twitter_creator" type="text" class="form-control <?php $__errorArgs = ['en_twitter_creator'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write site name here.." />
                                <?php $__errorArgs = ['en_twitter_creator'];
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
                              <!-- end og site name -->
                            </div>
                          </div>

                          <!-------------------------------->

                          <!-- image -->
                          <div class="form-group _form-group">
                            <label for="upload_img">
                              Image - Twitter <span class="wajib">* </span>
                            </label>
                            <input type="file" value="<?php echo e(old('en_twitter_image')); ?>" name="en_twitter_image" require class="form-control <?php $__errorArgs = ['en_twitter_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="upload_img">
                            <?php $__errorArgs = ['en_twitter_image'];
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
                          <!-- end image -->

                          <!-- twitter description -->
                          <div class="form-group _form-group">
                            <label for="input_twitter_description">
                              Description - Twitter <span class="wajib">* </span>
                            </label>
                            <textarea id="input_twitter_description" name="en_twitter_description" type="text" class="form-control <?php $__errorArgs = ['en_twitter_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write title here.." rows="3"><?php echo e(old('en_twitter_description')); ?></textarea>
                            <?php $__errorArgs = ['en_twitter_description'];
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
                          <!-- end twitter description -->

                        </div>
                      </div>
                    </div>
                    <!-- End Twitter -->

                    <!-- Schema Markup -->
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingSeven">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                          Schema Markup
                        </button>
                      </h2>
                      <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          <!-------------------------------->

                          <!-- schema markup description -->
                          <div class="form-group _form-group">
                            <label for="input_twitter_description">
                              Schema Markup <span class="wajib">* </span>
                            </label>
                            <textarea id="input_en_schema_markup" name="en_schema_markup" type="text" class="form-control <?php $__errorArgs = ['en_schema_markup'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Write title here.." rows="3"><?php echo e(old('en_schema_markup')); ?></textarea>
                            <?php $__errorArgs = ['en_schema_markup'];
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
                          <!-- end twitter description -->

                        </div>
                      </div>
                    </div>
                    <!-- End Schema Markup -->

                  </div>
                  <!-- End Other Language -->
                </div>

              </div>
            </div>

            <div class="row">
              <div class="col-12">
                <div class="float-right mTop">
                  <a class="btn btn-outline-primary _btn-primary px-4" href="<?php echo e(route('metas.index')); ?>">Back</a>
                  <button type="submit" class="btn btn-primary _btn-primary px-4">
                    Save
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
  var $englishForm = $('#english-form');
  var $spanishForm = $('#spanish-form');
  var $englishLink = $('#english-link');
  var $spanishLink = $('#spanish-link');

  $englishLink.click(function() {
    $englishLink.toggleClass('bg-aqua-active');
    $englishForm.toggleClass('d-none');
    $spanishLink.toggleClass('bg-aqua-active');
    $spanishForm.toggleClass('d-none');
  });

  $spanishLink.click(function() {
    $englishLink.toggleClass('bg-aqua-active');
    $englishForm.toggleClass('d-none');
    $spanishLink.toggleClass('bg-aqua-active');
    $spanishForm.toggleClass('d-none');
  });
</script>

<script>
  $(document).ready(function() {
    $("#input_project_title").change(function(event) {
      $("#input_project_slug").val(
        event.target.value
        .trim()
        .toLowerCase()
        .replace(/[^a-z\d-]/gi, "-")
        .replace(/-+/g, "-")
        .replace(/^-|-$/g, "")
      );
    });
  });

  $(document).ready(function() {
    $("#input_post_title").change(function(event) {
      $("#input_post_slug").val(
        event.target.value
        .trim()
        .toLowerCase()
        .replace(/[^a-z\d-]/gi, "-")
        .replace(/-+/g, "-")
        .replace(/^-|-$/g, "")
      );
    });
  });

  $(document).ready(function() {
    $("#input_en_title").change(function(event) {
      $("#input_en_slug").val(
        event.target.value
        .trim()
        .toLowerCase()
        .replace(/[^a-z\d-]/gi, "-")
        .replace(/-+/g, "-")
        .replace(/^-|-$/g, "")
      );
    });

    $("#input_en_schema_markup").tinymce({
      relative_urls: false,
      content_style: "body {font-size: 14px; font-family: 'Montserrat', sans-serif; }.mce-content-body[data-mce-placeholder]:not(.mce-visualblocks)::before {color: #bfbfbf; font-size: 14px}",
      language: "en",
      height: "404",
      plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table directionality",
        "emoticons template paste textpattern",
      ],
      toolbar1: "fullscreen preview",
      toolbar2: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",

      file_picker_callback: function(callback, value, meta) {
        let x = window.innerWidth || document.documentElement.clientWidth || document
          .getElementsByTagName('body')[0].clientWidth;
        let y = window.innerHeight || document.documentElement.clientHeight || document
          .getElementsByTagName('body')[0].clientHeight;

        let cmsURL =
          "<?php echo e(route('unisharp.lfm.show')); ?>" +
          '?editor=' + meta.fieldname;
        if (meta.filetype == 'image') {
          cmsURL = cmsURL + "&type=Images";
        } else {
          cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.openUrl({
          url: cmsURL,
          title: 'Filemanager',
          width: x * 0.8,
          height: y * 0.8,
          resizable: "yes",
          close_previous: "no",
          onMessage: (api, message) => {
            callback(message.content);
          }
        });
      }
    });

    $("#input_id_schema_markup").tinymce({
      relative_urls: false,
      content_style: "body {font-size: 14px; font-family: 'Montserrat', sans-serif; }.mce-content-body[data-mce-placeholder]:not(.mce-visualblocks)::before {color: #bfbfbf; font-size: 14px}",
      language: "en",
      height: "404",
      plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table directionality",
        "emoticons template paste textpattern",
      ],
      toolbar1: "fullscreen preview",
      toolbar2: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",

      file_picker_callback: function(callback, value, meta) {
        let x = window.innerWidth || document.documentElement.clientWidth || document
          .getElementsByTagName('body')[0].clientWidth;
        let y = window.innerHeight || document.documentElement.clientHeight || document
          .getElementsByTagName('body')[0].clientHeight;

        let cmsURL =
          "<?php echo e(route('unisharp.lfm.show')); ?>" +
          '?editor=' + meta.fieldname;
        if (meta.filetype == 'image') {
          cmsURL = cmsURL + "&type=Images";
        } else {
          cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.openUrl({
          url: cmsURL,
          title: 'Filemanager',
          width: x * 0.8,
          height: y * 0.8,
          resizable: "yes",
          close_previous: "no",
          onMessage: (api, message) => {
            callback(message.content);
          }
        });
      }
    });
  });
</script>


<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Brandztory Projects\brandztory-website\bz-cms\resources\views/admin/meta-pages/create.blade.php ENDPATH**/ ?>