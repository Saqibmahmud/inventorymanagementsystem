<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
  <title>Inventory</title>

  {{-- Include styles --}}
  @include('partials.styles')

</head>
<body class="hold-transition sidebar-mini layout-fixed ">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('assets/dist/img/images.png') }}" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-info navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('dashboard') }}" class="nav-link">Home</a>
      </li>
      @can('View-Permission')
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('permissions.index')}}" class="nav-link">Permissions</a>
      </li>
      @endcan
      @can('View-Role')
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('roles.index')}}" class="nav-link">Roles</a>
      </li>
      @endcan
      @can('View-User')
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('users.index')}}" class="nav-link">Users</a>
      </li>
      @endcan
      @can('View-Customer')
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('customers.index')}}" class="nav-link">Customers</a>
      </li>
      @endcan
      @can('View-Supplier')
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('suppliers.index')}}" class="nav-link">Suppliers</a>
      </li>
      @endcan
      @if(Auth::check())
      <li class="nav-item d-none d-sm-inline-block">
       <form method="POST" action={{route('logout')}}>@csrf @method('Post')<button class="nav-link">LogOut</button>   </form>
      </li>
      @endif
    </ul>

    <!-- Right navbar links -->

<div class="d-none d-sm-flex align-items-center ms-sm-3">
    <x-dropdown align="right" width="48">
        <x-slot name="trigger">
            {{-- Replaced Tailwind classes with Bootstrap equivalent dropdown toggler classes --}}
            <button class="d-inline-flex align-items-center px-3 py-2 border border-transparent text-sm lh-sm fw-medium rounded text-secondary bg-white hover:text-dark focus:outline-none transition ease-in-out duration-150"
                    type="button" 
                    data-bs-toggle="dropdown" 
                    aria-expanded="false">
                
                <div>{{isset(Auth::user()->name) ?Auth::user()->name:'' }}</div>

                <div class="ms-1">
                    {{-- SVG icons are kept as-is, but you might consider using Bootstrap Icons or Font Awesome --}}
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
            </button>
        </x-slot>

        <x-slot name="content">
            <x-dropdown-link :href="route('profile.edit')" class="dropdown-item">
                {{ __('Profile') }}
            </x-dropdown-link>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')" class="dropdown-item"
                    onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
        </x-slot>
    </x-dropdown>
</div>

<div class="me-n2 d-flex align-items-center d-sm-none">
    {{-- Replaced Tailwind classes with Bootstrap Navbar Toggler and utility classes --}}
    <button @click="open = ! open" class="navbar-toggler p-2 rounded text-secondary hover:text-dark bg-light focus:outline-none focus:bg-light focus:text-dark transition duration-150 ease-in-out" 
            type="button" 
            data-bs-toggle="collapse" 
            data-bs-target="#responsive-menu" 
            aria-controls="responsive-menu" 
            aria-expanded="false" 
            aria-label="Toggle navigation">
        {{-- SVG is generally left alone, but you'd control visibility with Alpine/JS or use Bootstrap icons --}}
        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path :class="{'d-none': open, 'd-inline-flex': ! open }" class="d-inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            <path :class="{'d-none': ! open, 'd-inline-flex': open }" class="d-none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>

{{-- Responsive Navigation Menu --}}
<div :class="{'d-block': open, 'd-none': ! open}" class="d-none d-sm-none collapse" id="responsive-menu">
    <div class="pt-2 pb-3 space-y-1">
        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="nav-link">
            {{ __('Dashboard') }}
        </x-responsive-nav-link>
    </div>

    <div class="pt-4 pb-1 border-top border-gray-200">
        <div class="px-4">
            <div class="fw-medium text-base text-dark">{{ isset(Auth::user()->name) ?Auth::user()->name:''}}</div>
            <div class="fw-medium text-sm text-secondary">{{ isset(Auth::user()->email)?Auth::user()->email:'' }}</div>
        </div>

        <div class="mt-3 space-y-1">
            <x-responsive-nav-link :href="route('profile.edit')" class="nav-link">
                {{ __('Profile') }}
            </x-responsive-nav-link>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')" class="nav-link"
                    onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
</div>

    {{-- //--------- --}}
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-info elevation-2">
">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
      <img src="{{ asset('assets/dist/img/images.png') }}" alt="Inventory Logo" class="brand-image img elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Inventory_Project</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('assets/dist/img/icon.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="" class="d-block">Main Menu</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item menu-open">
            <a href="{{route('dashboard') }}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          {{-- Purchases er menu --}}

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-clipboard-check"></i>
              <p>
                Purchase
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('purchases.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Purchase</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('purchases.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Purchase</p>
                </a>
              </li>
            </ul>
          </li>
            {{-- Sales er menu --}}
              <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-check"></i>
              <p>
                Sales
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Invoice</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Invoice</p>
                </a>
              </li>
            
            </ul>
          </li>
          {{-- Products Category er menu --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fab fa-product-hunt"></i>
              <p>
                Products
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('products.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Products</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('products.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Product</p>
                </a>
              </li>
            
            </ul>
          </li>

          {{-- Brands er menu --}}
               <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th "></i>
              <p>
                Brands
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('brands.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Brands</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('brands.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Brand</p>
                </a>
              </li>
            
            </ul>
          </li>
  {{-- Products Category er menu --}}
       <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-list-ul"></i>
              <p>
                Product Categories
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('categories.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Categories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('categories.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Category</p>
                </a>
              </li>
            
            </ul>
          </li>
{{--  Customers er menu --}}
 <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Customers
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('customers.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Customers</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('customers.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Customer</p>
                </a>
              </li>
             
            </ul>
          </li>
          {{--  Employee er menu --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                HRM
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Employees</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('users.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Employee</p>
                </a>
              </li>
             
            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <!-- Page Header -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @yield('content')
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <strong>Copyright &copy; 2022-2025 
      <a href="https://adminlte.io">Inventory.io</a>.
    </strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-light">
    <!-- Control sidebar content goes here -->
  </aside>
</div>
<!-- ./wrapper -->

{{-- Include scripts --}}
@include('partials.scripts')
@isset($script)
{{$script}}  
@endisset
</body>
</html>
