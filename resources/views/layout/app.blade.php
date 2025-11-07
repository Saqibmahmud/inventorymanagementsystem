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
    
      @role('Super Admin') 
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('branches.select')}}" class="nav-link"> <i class="fas fa-exchange-alt"></i> Branch</a>
      </li>
      @endrole
    
    </ul>

    {{-- //--------- --}}
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
 <a class="nav-link" data-widget="navbar" href="#" role="definition">
       <strong><i class="fas fa-store"></i>Branch : {{isset(Auth::user()->branch_id)? \App\Models\Branches::where('id',Auth::user()->branch_id)->first()->name :''}}
        </strong></a>
      </li>



        
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

    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
      <img src="{{ asset('assets/dist/img/images.png') }}" alt="Inventory Logo" class="brand-image img elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Inventory_Project</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
   <li class="nav-item dropdown">
  <a href="#" class="nav-link d-flex align-items-center" data-toggle="dropdown" aria-expanded="false">
    <img src="{{ asset('assets/dist/img/icon.png') }}" class="img-circle elevation-2 mr-2" alt="User Image" style="width: 40px; height: 40px;">
    <p class="mb-0 text-white">
      {{Auth::user()->name??'';}} <i class="fas fa-angle-down ml-1"></i>
    </p>
  </a>
  <div class="dropdown-menu dropdown-menu-left">
    <a href="{{ route('profile.edit') }}" class="dropdown-item" style="font: bold; color:black;"> 
      <i class="fas fa-user mr-2"></i> Profile
    </a>
    <div class="dropdown-divider"></div>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="dropdown-item text-danger">
        <i class="fas fa-sign-out-alt mr-2"></i> Logout
      </button>
    </form>
  </div>
</li>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

    {{-- Dashboard --}}
    <li class="nav-item menu-open">
      <a href="{{ route('dashboard') }}" class="nav-link active">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
      </a>
    </li>

    {{-- Purchase Menu --}}
    @canany(['Add-Purchase','View-Purchase'])
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-clipboard-check"></i>
        <p>
          Purchase
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        @can('View-Purchase')
        <li class="nav-item">
          <a href="{{ route('purchases.index') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>All Purchase</p>
          </a>
        </li>
        @endcan
        @can('Add-Purchase')
        <li class="nav-item">
          <a href="{{ route('purchases.create') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Create Purchase</p>
          </a>
        </li>
        @endcan
      </ul>
    </li>
    @endcanany

    {{-- Sales Menu --}}
    @canany(['View-Sale','Add-Sale'])
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-check"></i>
        <p>
          Sales
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        @can('View-Sale')
        <li class="nav-item">
          <a href="{{route('sales.index')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>All Invoice</p>
          </a>
        </li>
        @endcan
        @can('Add-Sale')
        <li class="nav-item">
          <a href="{{route('sales.create')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Create Invoice</p>
          </a>
        </li>
        @endcan
      </ul>
    </li>
    @endcanany

    {{-- Products Menu --}}
    @canany(['View-Product','Add-Product'])
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fab fa-product-hunt"></i>
        <p>
          Products
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        @can('View-Product')
        <li class="nav-item">
          <a href="{{ route('products.index') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>All Products</p>
          </a>
        </li>
        @endcan
        @can('Add-Product')
        <li class="nav-item">
          <a href="{{ route('products.create') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Add Product</p>
          </a>
        </li>
        @endcan
      </ul>
    </li>
    @endcanany

    {{-- Brands Menu --}}
    @canany(['View-Brand','Add-Brand'])
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>
          Brands
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        @can('View-Brand')
        <li class="nav-item">
          <a href="{{ route('brands.index') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>All Brands</p>
          </a>
        </li>
        @endcan
        @can('Add-Brand')
        <li class="nav-item">
          <a href="{{ route('brands.create') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Add Brand</p>
          </a>
        </li>
        @endcan
      </ul>
    </li>
    @endcanany

    {{-- Categories Menu --}}
    @canany(['View-Category','Add-Category'])
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-list-ul"></i>
        <p>
          Product Categories
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        @can('View-Category')
        <li class="nav-item">
          <a href="{{ route('categories.index') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>All Categories</p>
          </a>
        </li>
        @endcan
        @can('Add-Category')
        <li class="nav-item">
          <a href="{{ route('categories.create') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Add Category</p>
          </a>
        </li>
        @endcan
      </ul>
    </li>
    @endcanany

    {{-- Customers Menu --}}
    @canany(['View-Customer','Add-Customer'])
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>
          Customers
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        @can('View-Customer')
        <li class="nav-item">
          <a href="{{ route('customers.index') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>All Customers</p>
          </a>
        </li>
        @endcan
        @can('Add-Customer')
        <li class="nav-item">
          <a href="{{ route('customers.create') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Add Customer</p>
          </a>
        </li>
        @endcan
      </ul>
    </li>
    @endcanany
       {{-- Suppliers Menu --}}
    @canany(['View-Supplier','Add-Supplier'])
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-truck"></i>
        <p>
          Suppliers
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        @can('View-Supplier')
        <li class="nav-item">
          <a href="{{ route('suppliers.index') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>All Suppliers</p>
          </a>
        </li>
        @endcan
        @can('Add-Supplier')
        <li class="nav-item">
          <a href="{{ route('suppliers.create') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Add Supplier</p>
          </a>
        </li>
        @endcan
      </ul>
    </li>
    @endcanany

    {{-- HRM Menu --}}
    @canany(['View-User','Add-User'])
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>
          HRM
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        @can('View-User')
        <li class="nav-item">
          <a href="{{ route('users.index') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>All Employees</p>
          </a>
        </li>
        @endcan
        @can('Add-User')
        <li class="nav-item">
          <a href="{{ route('users.create') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Add Employee</p>
          </a>
        </li>
        @endcan
      </ul>
    </li>
    @endcanany

    {{-- Branches Menu --}}
    @canany(['View-Branch','Add-Branch'])
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-industry"></i>
        <p>
          Branches
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        @can('View-Branch')
        <li class="nav-item">
          <a href="{{ route('branches.index') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>All Branches</p>
          </a>
        </li>
        @endcan
        @can('Add-Branch')
        <li class="nav-item">
          <a href="{{ route('branches.create') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Add Branch</p>
          </a>
        </li>
        @endcan
      </ul>
    </li>
    @endcanany

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
