<style>
.plus_icon{
    background-color:greenyellow;
    font:small;
     padding:2px;
     cursor:pointer;
        border-radius: 40%;
     
}
</style>
@extends('layout.app')
@section('content')
<div class="card">
<div class="card-header">
@if(isset($data))
<h3 class="card-title">Edit Products</h3>
@else
<h3 class="card-title">Add Products</h3>
@endif
</div>
<x-session-message/>
<div class="card-body">
<div class="form-grup">

<form action="{{isset($data)?route('products.update',['product'=>$data['id']]):route('products.store')}}" method="POST">
        @csrf
        @if(isset($data))
         @method('PUT') 
         @endif
<label for="supplier_id">Supplier Name</label>
<select type="text" name="supplier_id" class="form-control" >
  <option value="">--Select Supplier--</option>
    @foreach ($suppliers as $sup)
    <option value="{{old('supplier_id',$sup->id)}}"{{isset($data->supplier_id) && $data->supplier_id == $sup->id? 'selected':''  }}  >{{$sup->supplier_name}}</option>
    @endforeach
</select>
    @error('supplier_id')
<p class="text-danger">{{$message}}</p>  
@enderror

<label for="product_name">Product Name</label>
<input type="text" name="product_name" class="form-control" value='{{old('product_name',$data->product_name ?? '')}}'>
@error('product_name')
<p class="text-danger">{{$message}}</p>  
@enderror
<label for="sku">SKU/Code</label>
<input type="text" name="sku" class="form-control" value='{{old('sku',$data->sku?? '')}}'>
@error('sku')
<p class="text-danger">{{$message}}</p>  
@enderror

<label for="brands_id" class="form-label">Brand Name</label><a href="{{route('brands.create')}}"> <i class="fas fa-plus plus_icon" ></i></a>

<select name="brands_id" id="brands_id" class="form-control" required>
<option value="">Select Brand</option>
@foreach ($allBrands as $brand)

    <option value="{{$brand->id}}"{{ old('brands_id', $data->brands_id?? '')==  $brand->id ? 'selected':''}}>{{$brand->brand_name}}</option>
@endforeach
</select> 
@error('brands_id')
<p class="text-danger">{{$message}}</p>
@enderror 

<label for="product_categories_id" class="form-label">Category Name</label><a href="{{route('categories.create')}}"> <i class="fas fa-plus plus_icon" ></i></a>
<select name="product_categories_id" class='form-control'>
<option value="">Select Category</option>

    @foreach ($allCategories as $category)
    <option value="{{$category->id}}" {{ old('product_categories_id',$data->product_categories_id ?? '')== $category->id ? 'selected' : ''}}>{{$category->product_category_name}}</option>
@endforeach
</select>
@error('product_categories_id')
<p class="text-danger">{{$message}}</p>
@enderror 
<label for="description">Description</label>
<textarea for="description" name="description" class="form-control">{{old('description',$data->description?? '')}}</textarea>
<label for="price">Selling Price</label>
<input type="text" name="price" class="form-control" value='{{old('price',$data->price ?? '')}}'>
@error('price')
<p class="text-danger">{{$message}}</p>  
@enderror

<label for="stock_quantity">Stock Quantity</label>
<input type="text" name="stock_quantity" class="form-control" value='{{old('stock_quantity',$data->stock_quantity ?? '')}}'readonly>
@error('stock_quantity')
<p class="text-danger">{{$message}}</p>  
@enderror


<label for="reorder_level">Reorder Level</label>
<input type="text" name="reorder_level" class="form-control"  value='{{old('reorder_level',$data->reorder_level ?? '')}}' >
@error('reorder_level')
<p class="text-danger">{{$message}}</p>  
@enderror


<br>
<input type="submit" class="btn btn-primary mt-0" value="Confirm">
</form>
</div>
</div>
</div>


@endsection 

