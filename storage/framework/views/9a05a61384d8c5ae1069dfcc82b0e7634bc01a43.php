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
        <a href="user-profile">
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

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['Manage Banners', 'Manage Banner Category', 'Manage Posts', 'Manage Post Category', 'Manage Post Tag'])): ?>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Content</h6>
                        </div>
                    </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['Manage Banners', 'Manage Banner Category'])): ?>
                    <li class="dropdown">
                        <a class="nav-link navSubMenu menu-title <?php echo e(routeActive(['banners.index', 'banners.show', 'banners.edit', 'banners.create', 'banner-categories.index', 'banner-categories.show', 'banner-categories.edit', 'banner-categories.create'])); ?>" href="javascript:void(0)"><i data-feather="flag"></i><span>Banners</span></a>
                        <ul class="nav-submenu menu-content">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Banners')): ?>
                            <li>
                                <a class="<?php echo e(routeActive(['banners.index', 'banners.show', 'banners.edit', 'banners.create'])); ?>" href="<?php echo e(route('banners.index')); ?>">Banner</a>
                            </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Banner Category')): ?>
                            <li>
                                <a class="<?php echo e(routeActive(['banner-categories.index', 'banner-categories.show', 'banner-categories.edit', 'banner-categories.create'])); ?>" href="<?php echo e(route('banner-categories.index')); ?>">Categories</a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['Manage Posts', 'Manage Post Category', 'Manage Post Tag'])): ?>
                    <li class="dropdown">
                        <a class="nav-link navSubMenu menu-title <?php echo e(routeActive(['posts.index', 'posts.show', 'posts.edit', 'posts.create', 'post-categories.index', 'post-categories.show', 'post-categories.edit', 'post-categories.create', 'post-tags.index', 'post-tags.show', 'post-tags.edit', 'post-tags.create'])); ?>" href="javascript:void(0)"><i data-feather="edit"></i><span>Posts</span></a>
                        <ul class="nav-submenu menu-content">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Posts')): ?>
                            <li>
                                <a class="<?php echo e(routeActive(['posts.index', 'posts.show', 'posts.edit', 'posts.create'])); ?>" href="<?php echo e(route('posts.index')); ?>">Post</a>
                            </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Post Category')): ?>
                            <li>
                                <a class="<?php echo e(routeActive(['post-categories.index', 'post-categories.show', 'post-categories.edit', 'post-categories.create'])); ?>" href="<?php echo e(route('post-categories.index')); ?>">Categories</a>
                            </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Post Tag')): ?>
                            <li>
                                <a class="<?php echo e(routeActive(['post-tags.index', 'post-tags.show', 'post-tags.edit', 'post-tags.create'])); ?>" href="<?php echo e(route('post-tags.index')); ?>">Tags</a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['Manage Users', 'Manage Roles'])): ?>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Settings</h6>
                        </div>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link navSubMenu menu-title <?php echo e(routeActive(['user.index', 'user.show', 'user.edit', 'user.create', 'roles.index', 'roles.show', 'roles.edit', 'roles.create'])); ?>" href="javascript:void(0)"><i data-feather="users"></i><span>Users & Roles</span></a>
                        <ul class="nav-submenu menu-content">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Users')): ?>
                            <li><a href="<?php echo e(route('users.index')); ?>" class="<?php echo e(routeActive(['users.index', 'users.show', 'users.edit', 'users.create'])); ?>">Users</a></li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Roles')): ?>
                            <li><a href="<?php echo e(route('roles.index')); ?>" class="<?php echo e(routeActive(['roles.index', 'roles.show', 'roles.edit', 'roles.create'])); ?>">Roles</a></li>
                            <?php endif; ?>
                        </ul>
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
</header><?php /**PATH C:\Brandztory Projects\Check Coding\admin-cms\resources\views/layouts/admin/partials/sidebar.blade.php ENDPATH**/ ?>