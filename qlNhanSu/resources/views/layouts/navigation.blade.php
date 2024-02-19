@include('header')
<nav x-data="{ open: false }" style="background: #2B3643;" class=" dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        {{-- <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" /> --}}
                        <img src="/images/logo.png" alt="" srcset="" width="40px">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <div>
                        <header class="main-header mt-2" style="margin-left: 120px">
                            {{-- <nav class="navbar navbar-static-top"> --}}
                                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                                </a>
                            {{-- </nav> --}}
                        </header>
                    </div>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                {{-- <img src="{{ asset('avatar-' .auth()->id() . '.png') }}" width="40" class="mr-2" alt=""> --}}
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button style="background: #2B3643; color: white" class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium rounded-md text-white-500 dark:text-white-400 dark:bg-wtext-white-800 hover:text-white-700 dark:hover:text-white-300 focus:outline-none transition ease-in-out duration-150">
                            <div>
                                <img src="/uploads/avatars/{{ Auth::user()->avatar }}" style="width: 32px; height: 32px; border-radius: 50%; margin-right: 20px" alt="">
                            </div>

                            <div style="position: relative;">

                                <div>{{ Auth::user()->name }}</div>
                            </div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Thông tin tài khoản') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('profile.change-pass')">
                            {{ __('Đổi mật khẩu') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Đóng phiên làm việc') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Trang chủ') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Thông tin cá nhân') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Đóng phiên làm việc') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

<div class="wrapper">
    {{-- <nav class="sideBar" id="sideBarID">
        <div class="toggle_menu"><i class="fa-solid fa-bars"></i></div>
        <ul>
            <li class="{{ request() -> is('dashboard') ? 'active' : '' }}"><a href="{{ route('dashboard') }}"><i class="fa-solid fa-house col-md-3"></i>Trang chủ</a></li>
            <li class="{{ request() -> is('khoas*') ? 'active' : '' }}"><a href="{{ route('khoas.index') }}"><i class="fa-solid fa-building col-md-3"></i>Khoa</a></li>
            <li class="{{ request() -> is('users*') ? 'active' : '' }}"><a href="{{ route('users.index') }}"><i class="fa-solid fa-user-group col-md-3"></i>Tài khoản</a></li>
            <li class="{{ request() -> is('profile*') ? 'active' : '' }}"><a href="{{ route('profile.edit') }}"><i class="fa-solid fa-exclamation col-md-3"></i>Thông tin tài khoản</a></li>
        </ul>
    </nav> --}}

    {{-- <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        </a>
    </nav> --}}

    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Tìm kiếm...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->

          <ul class="sidebar-menu" data-widget="tree">

            <li>
              <a href="menu.html">
                <i class="fa fa-th"></i> <span>Quản lý Menu </span>
                <span class="pull-right-container">
                  <small class="label pull-right bg-green">FE</small>
                </span>
              </a>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Quản lý banner</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href=""><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                <li><a href=""><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
              </ul>
            </li>

            <li>
              <a href="">
                <i class="fa fa-th"></i> <span>Widgets</span>
                <span class="pull-right-container">
                  <small class="label pull-right bg-green">Hot</small>
                </span>
              </a>
            </li>

          </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <div class="content-wrapper">
        @yield('main-content')
    </div>

</div>

@include('footer')
