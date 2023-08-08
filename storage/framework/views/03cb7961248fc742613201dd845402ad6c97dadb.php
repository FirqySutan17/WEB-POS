<header class="main-nav">
    <div class="sidebar-user text-center">
        <div class="set-drop">
            <button class="setting-primary dropSet" style="border: none;"><i data-feather="settings"></i></button>
            <div class="dropdownSet">
                <a class="dropStyle <?php echo e(routeActive('profile.edit')); ?>" href="<?php echo e(route('profile.edit')); ?>"><i data-feather="user-check"></i>Edit Profile</a>
                <a class="dropStyle <?php echo e(routeActive('password.edit')); ?>" href="<?php echo e(route('password.edit')); ?>"><i data-feather="lock"></i>Change Password</a>
            </div>
        </div>

        <img class="img-90 rounded-circle" src="<?php echo e(asset('file_upload/'. Auth::user()->image)); ?>" alt="" style="width: 90px; height: 90px; object-fit: cover;" />
        <a href="<?php echo e(route('home')); ?>">
            <h6 style="font-size: 16px; font-weight: 600; margin-top: 10px"><?php echo e(Auth::user()->name); ?></h6>
        </a>
        <p class="mb-0 font-roboto"><?php echo e(Auth::user()->roles->first()->name??null); ?></p>
    </div>
    <nav>
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>
                    <li>
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive('home')); ?>" href="<?php echo e(route('home')); ?>">
                            <i data-feather="home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['Manage How We Work', 'Manage Tech Stack'])): ?>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Master</h6>
                        </div>
                    </li>
                    <?php endif; ?>

                    <!-- How We Work -->
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage How We Work')): ?>
                    <li>
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive(['how-we-work.index', 'how-we-work.show', 'how-we-work.edit', 'how-we-work.create'])); ?>" href="<?php echo e(route('how-we-work.index')); ?>">
                            <i data-feather="circle"></i>
                            <span>How We Work</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <!-- End How We Work -->

                    <!-- Tech Stack -->
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Tech Stack')): ?>
                    <li>
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive(['tech-stack.index', 'tech-stack.show', 'tech-stack.edit', 'tech-stack.create'])); ?>" href="<?php echo e(route('tech-stack.index')); ?>">
                            <i data-feather="circle"></i>
                            <span>Tech Stack</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <!-- End Tech Stack -->

                    <!-- Partner -->
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Partner')): ?>
                    <li>
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive(['partner.index', 'partner.show', 'partner.edit', 'partner.create'])); ?>" href="<?php echo e(route('partner.index')); ?>">
                            <i data-feather="circle"></i>
                            <span>Partner</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <!-- End Partner -->

                    <!-- Team -->
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Team')): ?>
                    <li>
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive(['team.index', 'team.show', 'team.edit', 'team.create'])); ?>" href="<?php echo e(route('team.index')); ?>">
                            <i data-feather="circle"></i>
                            <span>Team</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <!-- End Team -->

                    <!-- Service -->
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Service')): ?>
                    <li>
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive(['service.index', 'service.show', 'service.edit', 'service.create'])); ?>" href="<?php echo e(route('service.index')); ?>">
                            <i data-feather="circle"></i>
                            <span>Service</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <!-- End Service -->

                    <!-- Gallery -->
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Gallery')): ?>
                    <li>
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive(['gallery.index', 'gallery.show', 'gallery.edit', 'gallery.create'])); ?>" href="<?php echo e(route('gallery.index')); ?>">
                            <i data-feather="circle"></i>
                            <span>Gallery</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <!-- End Gallery -->

                    <!-- Journey -->
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Journey')): ?>
                    <li>
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive(['journey.index', 'journey.show', 'journey.edit', 'journey.create'])); ?>" href="<?php echo e(route('journey.index')); ?>">
                            <i data-feather="circle"></i>
                            <span>Journey</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <!-- End Journey -->

                    <!-- Product -->
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Product')): ?>
                    <li>
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive(['product.index', 'product.show', 'product.edit', 'product.create'])); ?>" href="<?php echo e(route('product.index')); ?>">
                            <i data-feather="circle"></i>
                            <span>Product</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <!-- End Product -->

                    <!-- Product Promotion -->
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Product Promotion')): ?>
                    <li>
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive(['product-promotion.index', 'product-promotion.show', 'product-promotion.edit', 'product-promotion.create'])); ?>" href="<?php echo e(route('product-promotion.index')); ?>">
                            <i data-feather="circle"></i>
                            <span>Product Promotion</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <!-- End Product Promotion -->

                    <!-- Event -->
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Event')): ?>
                    <li>
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive(['event.index', 'event.show', 'event.edit', 'event.create'])); ?>" href="<?php echo e(route('event.index')); ?>">
                            <i data-feather="circle"></i>
                            <span>Event</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <!-- End Event -->

                    <!-- Portfolio -->
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Portfolio')): ?>
                    <li>
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive(['portfolio.index', 'portfolio.show', 'portfolio.edit', 'portfolio.create'])); ?>" href="<?php echo e(route('portfolio.index')); ?>">
                            <i data-feather="circle"></i>
                            <span>Portfolio</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <!-- End Portfolio -->

                     <!-- Career -->
                     <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Career')): ?>
                     <li>
                         <a class="nav-link menu-title link-nav <?php echo e(routeActive(['career.index', 'career.show', 'career.edit', 'career.create'])); ?>" href="<?php echo e(route('career.index')); ?>">
                             <i data-feather="circle"></i>
                             <span>Career</span>
                         </a>
                     </li>
                     <?php endif; ?>
                     <!-- End career -->

                    <!-- How We Work -->
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage How We Work')): ?>
                    
                    
                    
                    <?php endif; ?>
                    <!-- End How We Work -->

                    <li class="sidebar-main-title">
                        <div>
                            <h6>Settings</h6>
                        </div>
                    </li>
                    
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['Manage Users', 'Manage Roles'])): ?>
                    <li class="dropdown">
                        <a class="nav-link navSubMenu menu-title <?php echo e(routeActive(['user.index', 'user.show', 'user.edit', 'user.create', 'roles.index', 'roles.show', 'roles.edit', 'roles.create'])); ?>" href="javascript:void(0)"><i data-feather="users"></i><span>Users Management</span></a>
                        <ul class="nav-submenu menu-content">
                            
                            <li><a href="<?php echo e(route('users.index')); ?>" class="<?php echo e(routeActive(['users.index', 'users.show', 'users.edit', 'users.create'])); ?>">Users</a></li>
                            
                            <li><a href="<?php echo e(route('roles.index')); ?>" class="<?php echo e(routeActive(['roles.index', 'roles.show', 'roles.edit', 'roles.create'])); ?>">Roles</a></li>
                           
                        </ul>
                    </li>
                    <?php endif; ?>
                    
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Meta')): ?>
                    <li>
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive(['metas.index', 'metas.show', 'metas.edit', 'metas.create'])); ?>" href="<?php echo e(route('metas.index')); ?>">
                            <i data-feather="bookmark"></i>
                            <span>Meta Pages</span>
                        </a>
                    </li>
                    <?php endif; ?>

                    <!-- skill -->
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Skill')): ?>
                    <li>
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive(['skill.index', 'skill.show', 'skill.edit', 'skill.create'])); ?>" href="<?php echo e(route('skill.index')); ?>">
                            <i data-feather="circle"></i>
                            <span>Skill</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <!-- End skill -->

                    <!-- Project Type -->
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Project Type')): ?>
                    <li>
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive(['project-type.index', 'project-type.show', 'project-type.edit', 'project-type.create'])); ?>" href="<?php echo e(route('project-type.index')); ?>">
                            <i data-feather="circle"></i>
                            <span>Project Type</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <!-- End skill -->
                    
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
    <div class="copyrightBox">
        <p>Copyright <?php echo e(date('Y')); ?>-<?php echo e(date('y', strtotime('+1 year'))); ?> &copy; Brandztory CMS</p>
    </div>
</header><?php /**PATH D:\Personal\Github\laravel-cms\resources\views/layouts/admin/partials/sidebar.blade.php ENDPATH**/ ?>