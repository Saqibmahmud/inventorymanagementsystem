@extends('layout.app')
@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Product Categories</h3>
  
  </div>
  <div class="card-body">
    <div class="form-group">
 <form action="{{route('categories.store')}}" method="post">
    @csrf
        <label for="product_category_name">Product Category Name</label>
        <input type="text" name="product_category_name" class="form-control" >
       
    </div>
    <div class="form-group">
        <label for="product_category_code">Product Category Code</label>
       <input type="text" name="product_category_code" class="form-control" >    
       @error('product_category_code')
         <p class="alert alert-danger">{{$message}}</p>
       @enderror
        
 
    </div>
       <label for="status" class="form-label">Status</label>
       <select name="status" class="form-control">
        <option value="">Select Status</option>
<option value=1 {{old('status')==1 ? 'selected' : ''}}>Active</option>
<option value=0 {{old('status')==0 ? 'selected' : ''}}>Inactive</option>

       </select>
           
    <button type="submit" class="btn btn-primary">Add category</button>  

    
    <a href="{{route('categories.index')}}" class="btn btn-secondary mt-3">Back</a>
      </form>
  </div>
</div>
@endsection

            