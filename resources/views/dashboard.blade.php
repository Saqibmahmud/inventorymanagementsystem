
    @extends('layout.app')
    @section('content')
<div class="row">
          <div class="col-lg-6 col-12">
            <!-- small box -->
           @can('Add-Brand')
            <div class="small-box bg-indigo">
              <div class="inner">
                <h3> </h3>
                <p>Add New Brand</p>
              </div>
              <div class="icon">
                <i class="ion-ios-filing" style="font-size: 70px"> </i>
              </div>
              <a href="{{route('brands.create')}}" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          @endcan
          <!-- ./col -->
          @can('Add-Category')
          <div class="col-lg-6 col-12">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3> </h3>
                <p>Add New Product Categories </p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          @endcan
          <!-- ./col -->
          @can('Add-Product')
          <div class="col-lg-6 col-12">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3> </h3>
                <p>Add New Products</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          @endcan 
          <!-- ./col -->
          @can('Add-Supplier')
             <div class="col-lg-6 col-12">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3> </h3>
                <p>Add New Supplier</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add" style="font-size:70px;"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          @endcan
          <!-- ./col -->
          @can('Add-Sale')
  <div class="col-lg-6 col-12">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3> </h3>
                <p>Add New Sale</p>
              </div>
              <div class="icon">
                <i class="ion-android-cart" style="font-size:70px;"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          @endcan
          <!-- ./col -->
          @can('Add-Purchase')
          <div class="col-lg-6 col-12">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3> </h3>
                <p>Add New Purchase</p>
              </div>
              <div class="icon">
                <i class="ion-android-cloud-done" style="font-size:70px;"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          @endcan
          <!-- ./col -->
          @can('View-Stock-Report')
          <div class="col-lg-6 col-12">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3> </h3>
                <p>Stock Details & Reports</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          @endcan
          <!-- ./col -->



        </div>
      
            </div>
            @endsection
{{-- </x-app-layout> --}}
