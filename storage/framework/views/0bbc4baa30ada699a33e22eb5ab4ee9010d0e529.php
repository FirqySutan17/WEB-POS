<header class="main-nav">
    <div class="sidebar-user text-center">
        <div class="set-drop">
            <button class="setting-primary dropSet" style="border: none;"><i data-feather="settings"></i></button>
            <div class="dropdownSet">
                <a class="dropStyle <?php echo e(routeActive('profile.edit')); ?>" href="<?php echo e(route('profile.edit')); ?>"><i
                        data-feather="user-check"></i>Edit Profile</a>
                <a class="dropStyle <?php echo e(routeActive('password.edit')); ?>" href="<?php echo e(route('password.edit')); ?>"><i
                        data-feather="lock"></i>Change Password</a>
            </div>
        </div>

        <img class="img-90 rounded-circle" src="<?php echo e(asset('file_upload/'. Auth::user()->image)); ?>" alt=""
            style="width: 90px; height: 90px; object-fit: cover;" />
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
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"></i></div>
                    </li>
                    <li>
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive('home')); ?>" href="<?php echo e(route('home')); ?>">
                            <i data-feather="home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['Manage Skill', 'Manage Portfolio'])): ?>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Master</h6>
                        </div>
                    </li>
                    <?php endif; ?>

                    <!-- skill -->
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Skill')): ?>
                    <li>
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive(['skill.index', 'skill.show', 'skill.edit', 'skill.create'])); ?>"
                            href="<?php echo e(route('skill.index')); ?>">
                            <i data-feather="circle"></i>
                            <span>Categories</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <!-- End skill -->

                    <!-- Portfolio -->
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Portfolio')): ?>
                    <li>
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive(['portfolio.index', 'portfolio.show', 'portfolio.edit', 'portfolio.create'])); ?>"
                            href="<?php echo e(route('portfolio.index')); ?>">
                            <i data-feather="circle"></i>
                            <span>Portfolio</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <!-- End Portfolio -->

                    <li class="sidebar-main-title">
                        <div>
                            <h6>Settings</h6>
                        </div>
                    </li>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['Manage Users', 'Manage Roles'])): ?>
                    <li class="dropdown">
                        <a class="nav-link navSubMenu menu-title <?php echo e(routeActive(['user.index', 'user.show', 'user.edit', 'user.create', 'roles.index', 'roles.show', 'roles.edit', 'roles.create'])); ?>"
                            href="javascript:void(0)"><i data-feather="users"></i><span>Users Management</span></a>
                        <ul class="nav-submenu menu-content">

                            <li><a href="<?php echo e(route('users.index')); ?>"
                                    class="<?php echo e(routeActive(['users.index', 'users.show', 'users.edit', 'users.create'])); ?>">Users</a>
                            </li>

                            <li><a href="<?php echo e(route('roles.index')); ?>"
                                    class="<?php echo e(routeActive(['roles.index', 'roles.show', 'roles.edit', 'roles.create'])); ?>">Roles</a>
                            </li>

                        </ul>
                    </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Meta')): ?>
                    <li>
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive(['metas.index', 'metas.show', 'metas.edit', 'metas.create'])); ?>"
                            href="<?php echo e(route('metas.index')); ?>">
                            <i data-feather="bookmark"></i>
                            <span>Meta Pages</span>
                        </a>
                    </li>
                    <?php endif; ?>

                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
    <div class="copyrightBox">
        <p>Copyright <?php echo e(date('Y')); ?>-<?php echo e(date('y', strtotime('+1 year'))); ?> &copy; Brandztory CMS</p>
    </div>
</header><?php /**PATH D:\Personal\Github\koontjie-be\resources\views/layouts/admin/partials/sidebar.blade.php ENDPATH**/ ?>