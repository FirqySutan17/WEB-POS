<header class="main-nav">
    <div class="sidebar-user text-center">
        <div class="set-drop">
            <button class="setting-primary dropSet" style="border: none;"><i data-feather="settings"></i></button>
            <div class="dropdownSet">
                <a class="dropStyle <?php echo e(routeActive('profile.edit')); ?>" href="<?php echo e(route('profile.edit')); ?>"><i data-feather="user-check"></i>Edit Profile</a>
                <a class="dropStyle <?php echo e(routeActive('password.edit')); ?>" href="<?php echo e(route('password.edit')); ?>"><i data-feather="lock"></i>Change Password</a>
            </div>
        </div>

        <img class="img-90 rounded-circle" src="<?php echo e(env('MEDIA_URL') . Auth::user()->image); ?>" alt="" />
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

                    <!-- Partner -->
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Partner')): ?>
                    <li>
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive(['team.index', 'team.show', 'team.edit', 'team.create'])); ?>" href="<?php echo e(route('team.index')); ?>">
                            <i data-feather="circle"></i>
                            <span>Team</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <!-- End Partner -->

                    <!-- Partner -->
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Partner')): ?>
                    <li>
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive(['service.index', 'service.show', 'service.edit', 'service.create'])); ?>" href="<?php echo e(route('service.index')); ?>">
                            <i data-feather="circle"></i>
                            <span>Service</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <!-- End Partner -->

                    <!-- Partner -->
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Partner')): ?>
                    <li>
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive(['gallery.index', 'gallery.show', 'gallery.edit', 'gallery.create'])); ?>" href="<?php echo e(route('gallery.index')); ?>">
                            <i data-feather="circle"></i>
                            <span>Gallery</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <!-- End Partner -->

                    <!-- Partner -->
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Partner')): ?>
                    <li>
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive(['journey.index', 'journey.show', 'journey.edit', 'journey.create'])); ?>" href="<?php echo e(route('journey.index')); ?>">
                            <i data-feather="circle"></i>
                            <span>Journey</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <!-- End Partner -->

                    <!-- Partner -->
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Partner')): ?>
                    <li>
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive(['product.index', 'product.show', 'product.edit', 'product.create'])); ?>" href="<?php echo e(route('product.index')); ?>">
                            <i data-feather="circle"></i>
                            <span>Product</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <!-- End Partner -->

                    <!-- Partner -->
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Partner')): ?>
                    <li>
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive(['product-promotion.index', 'product-promotion.show', 'product-promotion.edit', 'product-promotion.create'])); ?>" href="<?php echo e(route('product-promotion.index')); ?>">
                            <i data-feather="circle"></i>
                            <span>Product Promotion</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <!-- End Partner -->

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['Manage Users', 'Manage Roles'])): ?>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Settings</h6>
                        </div>
                    </li>
                    <?php endif; ?>
                    
                    <li class="dropdown">
                        <a class="nav-link navSubMenu menu-title <?php echo e(routeActive(['user.index', 'user.show', 'user.edit', 'user.create', 'roles.index', 'roles.show', 'roles.edit', 'roles.create'])); ?>" href="javascript:void(0)"><i data-feather="users"></i><span>Users Management</span></a>
                        <ul class="nav-submenu menu-content">
                            
                            <li><a href="<?php echo e(route('users.index')); ?>" class="<?php echo e(routeActive(['users.index', 'users.show', 'users.edit', 'users.create'])); ?>">Users</a></li>
                            
                            <li><a href="<?php echo e(route('roles.index')); ?>" class="<?php echo e(routeActive(['roles.index', 'roles.show', 'roles.edit', 'roles.create'])); ?>">Roles</a></li>
                           
                        </ul>
                    </li>
                    
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
    <div class="copyrightBox">
        <p>Copyright <?php echo e(date('Y')); ?>-<?php echo e(date('y', strtotime('+1 year'))); ?> &copy; Brandztory CMS</p>
    </div>
</header><?php /**PATH D:\Personal\Github\compro.rimba.laravel\resources\views/layouts/admin/partials/sidebar.blade.php ENDPATH**/ ?>