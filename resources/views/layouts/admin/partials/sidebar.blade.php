<header class="main-nav">
    <div class="sidebar-user text-center">
        <div class="set-drop">
            <button class="setting-primary dropSet" style="border: none;"><i data-feather="settings"></i></button>
            <div class="dropdownSet">
                <a class="dropStyle {{routeActive('profile.edit')}}" href="{{ route('profile.edit') }}"><i
                        data-feather="user-check"></i>Edit Profile</a>
                <a class="dropStyle {{routeActive('password.edit')}}" href="{{ route('password.edit') }}"><i
                        data-feather="lock"></i>Change Password</a>
            </div>
        </div>

        <img class="img-90 rounded-circle" src="{{ asset('file_upload/'. Auth::user()->image) }}" alt=""
            style="width: 90px; height: 90px; object-fit: cover;" />
        <a href="{{ route('home') }}">
            <h6 style="font-size: 16px; font-weight: 600; margin-top: 10px">{{ Auth::user()->name }}</h6>
        </a>
        <p class="mb-0 font-roboto">{{ Auth::user()->roles->first()->name??null }}</p>
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
                        <a class="nav-link menu-title link-nav {{routeActive('home')}}" href="{{ route('home') }}">
                            <i data-feather="home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    @canany(['PC Show', 'P Show'])
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Master</h6>
                        </div>
                    </li>
                    @endcan

                    @canany(['PC Show', 'P Show'])
                    <li class="dropdown">
                        <a class="nav-link navSubMenu menu-title {{ routeActive(['product.index', 'product.show', 'product.edit', 'product.create','product-categories.index', 'product-categories.show', 'product-categories.edit', 'product-categories.create']) }}"
                            href="javascript:void(0)"><i data-feather="package"></i><span>Products Management</span></a>
                        <ul class="nav-submenu menu-content">
                            @can('PC Show')
                            <li><a href="{{ route('product-categories.index') }}"
                                    class="{{routeActive(['product-categories.index', 'product-categories.show', 'product-categories.edit', 'product-categories.create'])}}">
                                    Categories</a>
                            </li>
                            @endcan
                            @can('P Show')
                            <li><a href="{{ route('product.index') }}"
                                    class="{{routeActive(['product.index', 'product.show', 'product.edit', 'product.create'])}}">Products</a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan

                    @canany(['RS Show', 'RT Show'])
                    <li class="dropdown">
                        <a class="nav-link navSubMenu menu-title {{ routeActive(['report.transaction', 'report.stock']) }}"
                            href="javascript:void(0)"><i data-feather="package"></i><span>Report</span></a>
                        <ul class="nav-submenu menu-content">
                            @can('RS Show')
                            <li>
                                <a href="{{ route('report.stock') }}" class="{{routeActive('report.stock')}}">
                                    Stock
                                </a>
                            </li>
                            @endcan
                            @can('RT Show')
                            <li>
                                <a href="{{ route('report.transaction') }}"
                                    class="{{routeActive('report.transaction')}}">
                                    Transaction
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcanany

                    @canany(['Transaction', 'Receive'])
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Transaksi</h6>
                        </div>
                    </li>
                    @endcanany
                    <!-- skill -->
                    @can('Receive')
                    <li>
                        <a class="nav-link menu-title link-nav {{routeActive(['receive.index', 'receive.show', 'receive.edit', 'receive.create'])}}"
                            href="{{ route('receive.index') }}">
                            <i data-feather="circle"></i>
                            <span>Receive</span>
                        </a>
                    </li>
                    @endcan
                    <!-- End skill -->

                    <!-- Portfolio -->
                    @can('Transaction')
                    <li>
                        <a class="nav-link menu-title link-nav {{routeActive(['transaction.index'])}}"
                            href="{{ route('transaction.index') }}">
                            <i data-feather="circle"></i>
                            <span>Transaction</span>
                        </a>
                    </li>
                    @endcan
                    <!-- End Portfolio -->

                    @canany(['Manage Users', 'Manage Roles'])
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Settings</h6>
                        </div>
                    </li>
                    @endcan

                    @canany(['Manage Users', 'Manage Roles'])
                    <li class="dropdown">
                        <a class="nav-link navSubMenu menu-title {{ routeActive(['user.index', 'user.show', 'user.edit', 'user.create', 'roles.index', 'roles.show', 'roles.edit', 'roles.create']) }}"
                            href="javascript:void(0)"><i data-feather="users"></i><span>Users Management</span></a>
                        <ul class="nav-submenu menu-content">

                            <li><a href="{{ route('users.index') }}"
                                    class="{{routeActive(['users.index', 'users.show', 'users.edit', 'users.create'])}}">Users</a>
                            </li>

                            <li><a href="{{ route('roles.index') }}"
                                    class="{{routeActive(['roles.index', 'roles.show', 'roles.edit', 'roles.create'])}}">Roles</a>
                            </li>

                        </ul>
                    </li>
                    @endcan

                    @can('Manage Meta')
                    <li>
                        <a class="nav-link menu-title link-nav {{routeActive(['metas.index', 'metas.show', 'metas.edit', 'metas.create'])}}"
                            href="{{ route('metas.index') }}">
                            <i data-feather="bookmark"></i>
                            <span>Meta Pages</span>
                        </a>
                    </li>
                    @endcan

                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
    <div class="copyrightBox">
        <p>Copyright {{date('Y')}}-{{date('y', strtotime('+1 year'))}} &copy; Brandztory CMS</p>
    </div>
</header>