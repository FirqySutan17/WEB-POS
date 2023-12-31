@if(Auth::user()->roles->first()->name == 'Cashier')
<style>
    .page-wrapper.compact-wrapper .page-body-wrapper .page-body {
        margin-left: 0px !important;
    }
</style>
@else
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

                    @can(['P Show'])
                    <li>
                        <a class="nav-link menu-title link-nav {{routeActive(['product.index', 'product.show', 'product.edit', 'product.create'])}}"
                            href="{{ route('product.index') }}">
                            <i data-feather="package"></i>
                            <span>Product</span>
                        </a>
                    </li>
                    @endcan

                    <!-- skill -->
                    @can('T Show')
                    <li>
                        <a class="nav-link menu-title link-nav {{routeActive(['cashflow.index', 'cashflow.show', 'cashflow.edit', 'cashflow.create'])}}"
                            href="{{ route('cashflow.index') }}">
                            <i data-feather="dollar-sign"></i>
                            <span>Cashflow</span>
                        </a>
                    </li>
                    @endcan
                    <!-- End skill -->

                    <!-- skill -->
                    @can('T Create')
                    <li>
                        <a class="nav-link menu-title link-nav {{routeActive(['shift.index', 'shift.show', 'shift.edit', 'shift.create'])}}"
                            href="{{ route('shift.index') }}">
                            <i data-feather="send"></i>
                            <span>Shift Management</span>
                        </a>
                    </li>
                    @endcan
                    <!-- End skill -->

                    <!-- skill -->
                    @can('T Show')
                    <li>
                        <a class="nav-link menu-title link-nav {{routeActive(['membership.index', 'membership.show', 'membership.edit', 'membership.create'])}}"
                            href="{{ route('membership.index') }}">
                            <i data-feather="users"></i>
                            <span>Membership</span>
                        </a>
                    </li>
                    @endcan
                    <!-- End skill -->

                    @canany(['RS Show', 'RT Show'])
                    <li class="dropdown">
                        <a class="nav-link navSubMenu menu-title {{ routeActive(['report.transaction','report.transactioninvoice', 'report.transactionproduct','report.stock', 'report.receive', 'report.receiveno', 'report.receiveproduct']) }}"
                            href="javascript:void(0)"><i data-feather="file-text"></i><span>Report</span></a>
                        <ul class="nav-submenu menu-content">
                            <li>
                                <a href="{{ route('report.receive') }}"
                                    class="{{routeActive(['report.receive', 'report.receiveno', 'report.receiveproduct'])}}">
                                    Receive
                                </a>
                            </li>
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
                                    class="{{routeActive(['report.transaction','report.transactioninvoice', 'report.transactionproduct'])}}">
                                    Transaction
                                </a>
                            </li>
                            @endcan

                            <li>
                                <a href="{{ route('report.cashflow') }}" class="{{routeActive(['report.cashflow'])}}">
                                    Cash flow
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('report.bestseller') }}"
                                    class="{{routeActive(['report.bestseller'])}}">
                                    Best Seller
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('report.labarugi') }}" class="{{routeActive(['report.labarugi'])}}">
                                    Margin Item
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('report.monthly') }}" class="{{routeActive(['report.monthly'])}}">
                                    Monthly
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endcanany

                    {{-- <li class="sidebar-main-title">
                        <div>
                            <h6>Accounting</h6>
                        </div>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link navSubMenu menu-title {{routeActive(['common-code.index', 'common-code.create', 'common-code.edit', 'account-code.index', 'account-code.create', 'account-code.edit'])}}"
                            href="javascript:void(0)"><i data-feather="codepen"></i><span>Code</span></a>
                        <ul class="nav-submenu menu-content">
                            <li>
                                <a href="{{ route('account-code.index') }}"
                                    class="{{routeActive(['account-code.edit', 'account-code-index', 'account-code.create'])}}">
                                    Account
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('common-code.index') }}" class="{{routeActive('common-code.index')}}">
                                    Common
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link navSubMenu menu-title {{routeActive(['purchase-order.index', 'purchase-order.create', 'purchase-order.edit', 'receive-material.index', 'receive-material.create', 'receive-material.edit'])}}"
                            href="javascript:void(0)"><i data-feather="aperture"></i><span>Material</span></a>
                        <ul class="nav-submenu menu-content">

                            <li>
                                <a href="{{ route('purchase-order.index') }}"
                                    class="{{routeActive(['purchase-order.index', 'purchase-order.create', 'purchase-order.edit'])}}">
                                    P/O
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('receive-material.index') }}"
                                    class="{{routeActive(['receive-material.index', 'receive-material.create', 'receive-material.edit'])}}">
                                    Receive
                                </a>
                            </li>

                        </ul>
                    </li> --}}

                    {{-- <li class="dropdown">
                        <a class="nav-link navSubMenu menu-title {{routeActive(['account-slip.index', 'account-slip.create', 'account-slip.edit'])}}"
                            href="javascript:void(0)"><i data-feather="file-text"></i><span>Account</span></a>
                        <ul class="nav-submenu menu-content">

                            <li>
                                <a href="{{ route('account-slip.index') }}"
                                    class="{{routeActive(['account-slip.index', 'account-slip.create', 'account-slip.edit'])}}">
                                    Account Slip
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('receive-material.index') }}"
                                    class="{{routeActive(['receive-material.index', 'receive-material.create', 'receive-material.edit'])}}">
                                    Trial Balance
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('receive-material.index') }}"
                                    class="{{routeActive(['receive-material.index', 'receive-material.create', 'receive-material.edit'])}}">
                                    Daily Remainder
                                </a>
                            </li>
                        </ul>
                    </li> --}}

                    @canany(['Transaction', 'Receive'])
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Transaction</h6>
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
                    @can('Receive')
                    <li>
                        <a class="nav-link menu-title link-nav {{routeActive(['adjust_stock.index', 'adjust_stock.show', 'adjust_stock.edit', 'adjust_stock.create'])}}"
                            href="{{ route('adjust_stock.index') }}">
                            <i data-feather="circle"></i>
                            <span>Adjust Stock</span>
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

                    @can('Product Categories')
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Settings</h6>
                        </div>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link navSubMenu menu-title {{routeActive(['closing-date.edit','product-category.edit', 'product-category.index', 'product-category.create', 'code.edit', 'code.index', 'code.create', 'supplier.edit', 'supplier.index', 'supplier.create'])}}"
                            href="javascript:void(0)"><i data-feather="settings"></i><span>System</span></a>
                        <ul class="nav-submenu menu-content">

                            <li>
                                <a href="{{ route('code.index') }}"
                                    class="{{routeActive(['code.index', 'code.create', 'code.edit'])}}">
                                    Code
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('supplier.index') }}"
                                    class="{{routeActive(['supplier.index', 'supplier.create', 'supplier.edit'])}}">
                                    Supplier
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('closing-date.edit', 1) }}"
                                    class="{{routeActive('closing-date.edit')}}">Closing
                                    Date
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('product-category.index') }}"
                                    class="{{routeActive(['product-category.edit', 'product-category.index', 'product-category.create'])}}">Product
                                    Categories
                                </a>
                            </li>

                        </ul>
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

                    {{-- @can('Manage Meta')
                    <li>
                        <a class="nav-link menu-title link-nav {{routeActive(['metas.index', 'metas.show', 'metas.edit', 'metas.create'])}}"
                            href="{{ route('metas.index') }}">
                            <i data-feather="bookmark"></i>
                            <span>Meta Pages</span>
                        </a>
                    </li>
                    @endcan --}}

                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
    <div class="copyrightBox">
        <p>Copyright {{date('Y')}}-{{date('y', strtotime('+1 year'))}} &copy; Brandztory CMS</p>
    </div>
</header>
@endif