@extends('layout.app')
@section('content')
<div class="card">
<div class="card-header">
<h3 class="card-title">Products</h3>
    <a href="{{route('products.create')}}" class="btn btn-info float-right">Add Products</a>
  </div>
  <x-session-message/>
<div class="card-body">
<form method="get" action="{{route('brands.search')}}" class="mb-3">
  <input type="text" name="query" class="form-control"
         placeholder="Search by name or code">
  <button type="submit" class="btn btn-primary btn-sm margin">Search</button>
</form>
<p id="stock_warning" style="color:red">*red marked once are low on stock</p>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Product Name</th>
          <th>Code/SKU</th>
          <th>Brand</th>
          <th>Category</th>
          <th>Description</th>
          <th>Selling Price</th>
          <th>Stock Quantity</th>
          <th>reorder Level</th>
          <th>Created At</th>
          <th>Updated At</th>
          <th colspan="2">Actions</th>
 
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $d)
        <tr>
          
          <td>{{$d['product_name']}}</td>
          <td>{{$d['sku']}}</td>
          <td>{{$d->brands->brand_name}}</td>
          <td>{{$d->product_categories->product_category_name}}</td>
          <td>{{$d['description']}}</td>
          <td>{{$d['price']}}</td>
          <td class="stock_quantity">{{$d['stock_quantity']}}</td>
          <td class="reorder_level">{{$d['reorder_level']}}</td>
          <td>{{$d['created_at']}}</td>
          <td>{{$d['updated_at']}}</td>
          <td >
            <a href="{{'#'}}" class="btn btn-info btn-sm" title="View"><i class="fas fa-eye"></i></a>
            <a href="{{route('products.edit',['product'=>$d['id']])}}" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
        </tr>
              @endforeach
              </tbody>
    </table>
    <a href="{{route('dashboard')}}" class="btn btn-secondary mt-3">Back</a>
  </div>
  <div class="card-footer center">
    {{$data->links('pagination::bootstrap-5')}}
  </div>
   
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() { 
    $('tbody tr').each(function() {
       
        let $row = $(this);
        let stockQuantity = parseInt($row.find('.stock_quantity').text());
        let reorderLevel = parseInt($row.find('.reorder_level').text());
        if (stockQuantity < reorderLevel) {
            $row.css('background-color', '#f8d7da'); 
            $row.css('color', '#721c24'); 
        } else {
            $row.css('background-color', 'transparent')
            $row.css('color', 'inherit');
        }
    });
}); 
  
</script>