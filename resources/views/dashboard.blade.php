 @extends('layout.app')
@section('content')
<div class="container-fluid">
{{-- @php

$user=Auth::user();
  dd($user);
@endphp --}}
  {{-- ===== TOP STAT CARDS (LARGER) ===== --}}
  <div class="row">
   

    <div class="col-lg-3 col-md-6 col-12 mb-4">
      <div class="small-box bg-success" style="height: 180px;">
        <div class="inner">
          <h2 style="font-size: 2.5rem;">0</h2>
          <p style="font-size: 1.2rem;">Total Customers</p>
        </div>
        <div class="icon">
          <i class="fas fa-user-tie" style="font-size: 80px;"></i>
        </div>
        <a href="{{ route('customers.index') }}" class="small-box-footer" style="font-size: 1rem;">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 col-12 mb-4">
      <div class="small-box bg-warning" style="height: 180px;">
        <div class="inner">
          <h2 style="font-size: 2.5rem;">0</h2>
          <p style="font-size: 1.2rem;">Sales This Month</p>
        </div>
        <div class="icon">
          <i class="fas fa-shopping-cart" style="font-size: 80px;"></i>
        </div>
        <a href="#" class="small-box-footer" style="font-size: 1rem;">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 col-12 mb-4">
      <div class="small-box bg-danger" style="height: 180px;">
        <div class="inner">
          <h2 style="font-size: 2.5rem;">0</h2>
          <p style="font-size: 1.2rem;">Purchases This Month</p>
        </div>
        <div class="icon">
          <i class="fas fa-truck-loading" style="font-size: 80px;"></i>
        </div>
        <a href="#" class="small-box-footer" style="font-size: 1rem;">More info  <i class="fas fa-arrow-circle-right"></i></a>
       
    </div>
    </div>

    <div class="col-lg-3 col-md-6 col-12 mb-4">
      <div class="small-box bg-primary" style="height: 180px;">
        <div class="inner">
          <h2 style="font-size: 2.5rem;">0 ৳</h2>
          <p style="font-size: 1.2rem;">Revenue This Month</p>
        </div>
        <div class="icon">
          <i class="fas fa-chart-line" style="font-size: 80px;"></i>
        </div>
        <a href="#" class="small-box-footer" style="font-size: 1rem;">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    
     <div class="col-lg-3 col-md-6 col-12 mb-4">
      <div class="small-box bg-info" style="height: 180px;">
        <div class="inner">
          <h2 style="font-size: 2.5rem;">0</h2>
          <p style="font-size: 1.2rem;">Total Employees</p>
        </div>
        <div class="icon">
          <i class="fas fa-users" style="font-size: 80px;"></i>
        </div>
        <a href="{{ route('users.index') }}" class="small-box-footer" style="font-size: 1rem;">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>

  {{-- ===== ACTION BOXES SECTION ===== --}}
  <div class="row mt-4">
    {{-- Keep your existing action boxes here --}}
    @can('Add-Brand')
    <div class="col-lg-3 col-md-4 col-12">
      <div class="small-box bg-indigo">
        <div class="inner">
          <p>Add New Brand</p>
        </div>
       <div class="icon"> 
    <i class="fas fa-folder-open"></i> 
</div>
        <a href="{{ route('brands.create') }}" class="small-box-footer">Create <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    @endcan
    {{-- Repeat for other boxes --}}
    
    @can('Add-Category') 
    <div class="col-lg-3 col-md-4 col-12"> 
      <div class="small-box bg-success"> 
        <div class="inner">
           <p>Add New Category</p> 
         </div> 
         <div class="icon"> 
           <i class="fas fa-chart-bar"></i> {{-- Changed from ion ion-stats-bars --}}
         </div> 
         <a href="{{ route('categories.create') }}" class="small-box-footer">
           Create <i class="fas fa-arrow-circle-right"></i>
         </a> 
      </div> 
    </div>
@endcan
@can('Add-Product') 
    <div class="col-lg-3 col-md-4 col-12"> 
      <div class="small-box bg-warning"> 
        <div class="inner"> 
          <p>Add New Product</p> 
        </div> 
        <div class="icon">
           <i class="fas fa-box"></i> {{-- Changed from ion ion-bag, using a common product icon --}}
         </div> 
         <a href="{{ route('products.create') }}" class="small-box-footer">
           Create <i class="fas fa-arrow-circle-right"></i>
         </a>
      </div> 
    </div> 
@endcan
@can('Add-Supplier') 
    <div class="col-lg-3 col-md-4 col-12"> 
      <div class="small-box bg-info"> 
        <div class="inner"> 
          <p>Add New Supplier</p> 
        </div> 
        <div class="icon"> 
          <i class="fas fa-truck"></i> {{-- Changed from ion ion-person-add, using a common supplier icon --}}
        </div>
        <a href="{{ route('suppliers.create') }}" class="small-box-footer">
            Create <i class="fas fa-arrow-circle-right"></i>
        </a> 
      </div> 
    </div> 
@endcan 
@can('Add-Customer') 
    <div class="col-lg-3 col-md-4 col-12"> 
      <div class="small-box bg-purple"> 
        <div class="inner">
           <p>Add New Customer</p>
         </div>
         <div class="icon"> 
            <i class="fas fa-user-plus"></i> {{-- Changed from ion-android-person-add --}}
         </div> 
         <a href="{{ route('customers.create') }}" class="small-box-footer">
            Create <i class="fas fa-arrow-circle-right"></i>
         </a> 
      </div> 
    </div> 
@endcan 
@can('Add-Sale')
    <div class="col-lg-3 col-md-4 col-12"> 
      <div class="small-box bg-primary"> 
        <div class="inner"> 
            <p>Add New Sale</p>
         </div> 
         <div class="icon "> 
            <i class="fas fa-shopping-cart"></i> 
         </div> {{-- This one was already correct --}}
         <a href="#" class="small-box-footer">
            Create <i class="fas fa-arrow-circle-right"></i>
         </a> 
      </div>
    </div> 
@endcan 
@can('Add-Purchase') 
    <div class="col-lg-3 col-md-4 col-12">
      <div class="small-box bg-secondary">
        <div class="inner">
          <p>Add New Purchase</p>
        </div> 
        <div class="icon"> 
            <i class="fas fa-dolly"></i> {{-- Changed from ion-android-cloud-done, using a common purchase icon --}}
         </div> 
         <a href="{{ route('purchases.create') }}" class="small-box-footer">
            Create <i class="fas fa-arrow-circle-right"></i>
            </a> 
        </div>
    </div> 
@endcan 
@can('View-Stock-Report') 
    <div class="col-lg-3 col-md-4 col-12"> 
      <div class="small-box bg-danger">
         <div class="inner">
            <p>Stock Details & Reports</p>
         </div> 
         <div class="icon"> 
            <i class="fas fa-chart-pie"></i> {{-- Changed from ion ion-pie-graph --}}
         </div>
         <a href="#" class="small-box-footer">
            View <i class="fas fa-arrow-circle-right"></i>
         </a> 
      </div> 
    </div> 
@endcan
  </div>
</div>
@endsection  
