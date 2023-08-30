<div class="page-main-header">
  <div class="main-header-right row m-0">
    <div class="main-header-left">
      <div class="logo-wrapper"><a href="{{ route('home') }}">
          {{-- <h5 style="margin-top:10px; font-family: 'Poppins', sans-serif; color: #fff"><strong>RIMBA CMS</strong>
          </h5> --}}
          <img class="img-fluid" style="width: 120px" src="{{asset('images/logo.png')}}" alt=""></a>
      </div>
      {{-- <div class="dark-logo-wrapper"><a href="{{ route('index') }}"><img class="img-fluid"
            src="{{asset('assets/images/logo/dark-logo.png')}}" alt=""></a></div> --}}

      @if(Auth::user()->roles->first()->name == 'cashier')

      @else
      <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="align-center" id="sidebar-toggle"> </i>
      </div>
      @endif
    </div>

    <!--
    <div class="left-menu-header col">
      <ul>
        <li>
          <form class="form-inline search-form" action="{{ route('users.index') }}" method="GET">
            <div class="search-bg"><i class="fa fa-search"></i>
              <input name="keyword" value="{{ request()->get('keyword') }}" type="search" class="form-control-plaintext"
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
            <a href="{{ route('logout') }}"
              onclick="event.preventDefault();document.getElementById('logout-form').submit();">
              <i class='bx bx-log-out-circle'></i> {{__('Logout') }}
            </a>
          </button>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>


        </li>
        <!--
        <li class="onhover-dropdown p-0">
          <a class="btn btn-primary-light" href="{{ route('logout') }}"
            onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
              data-feather="log-out"></i>{{ __('Logout') }}</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </li>
      -->
      </ul>
    </div>
    <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
  </div>
</div>

<script>
  console.log(Auth::user()->role)
</script>