<div class="page-main-header">
  <div class="main-header-right row m-0">
    <div class="main-header-left">
      <div class="logo-wrapper"><a href="<?php echo e(route('home')); ?>">
          
          <img class="img-fluid" style="width: 100%" src="<?php echo e(asset('images/logo-rimba.png')); ?>" alt=""></a>
      </div>
      
      <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="align-center" id="sidebar-toggle"> </i>
      </div>
    </div>

    <!--
    <div class="left-menu-header col">
      <ul>
        <li>
          <form class="form-inline search-form" action="<?php echo e(route('users.index')); ?>" method="GET">
            <div class="search-bg"><i class="fa fa-search"></i>
              <input name="keyword" value="<?php echo e(request()->get('keyword')); ?>" type="search" class="form-control-plaintext"
                placeholder="Search here......">
            </div>
          </form>
          <span class="d-sm-none mobile-search search-bg"><i class="fa fa-search"></i></span>
        </li>
      </ul>
    </div>
  -->

    <div class="nav-right col pull-right right-menu p-0">
      <ul class="nav-menus">


        <li class="onhover-dropdown p-0">
          <button class="btn btn-primary-light" type="button">
            <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
              <i class='bx bx-log-out-circle'></i> <?php echo e(__('Logout')); ?>

            </a>
          </button>
          <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
            <?php echo csrf_field(); ?>
          </form>


        </li>
        <!--
        <li class="onhover-dropdown p-0">
          <a class="btn btn-primary-light" href="<?php echo e(route('logout')); ?>"
            onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
              data-feather="log-out"></i><?php echo e(__('Logout')); ?></a>
          <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
            <?php echo csrf_field(); ?>
          </form>
        </li>
      -->
      </ul>
    </div>
    <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
  </div>
</div><?php /**PATH D:\Personal\Github\compro.rimba.laravel\resources\views/layouts/admin/partials/header.blade.php ENDPATH**/ ?>