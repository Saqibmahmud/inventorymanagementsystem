@extends('layout.app') ;
@section('title', 'Edit Product Categories')
@section('content')
<div class="card">
 <div class="card-header">
    <h3 class="card-title">Product Categories</h3>

</div>

  <div class="card-body">
    <div class="form-group">
 <form action="{{route('categories.update',['category'=>$data->id])}}" method="post">
    @csrf
  @method('PUT')
 
        <label for="product_category_name">Product Category Name</label>
        <input type="text" name="product_category_name" class="form-control" value={{old('product_category_name',$data->product_category_name)}}>
       
    </div>
    <div class="form-group">
        <label for="product_category_code">Product Category Code</label>
        <input type="text" name="product_category_code" class="form-control" value={{$data->product_category_code}}>    
       
        
 
    </div>
       <label for="status" class="form-label">Status</label>
        <select name="status" class="form-control">
        <option value="">Select Status</option>
        <option value="active" {{ strtolower(old('status', $data->status)) == 'active' ? 'selected' : '' }}>Active</option>
        <option value="inactive" {{ strtolower(old('status', $data->status)) == 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>

           
    <button type="submit" class="btn btn-primary">Update Product Category</button>  

    
    <a href="{{route('categories.index')}}" class="btn btn-secondary mt-3">Back</a>
      </form>
  </div>
</div>
@endsection
