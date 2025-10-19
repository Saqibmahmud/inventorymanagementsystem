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
        <textarea name="product_category_code" class="form-control"></textarea>
        
 
    </div>
       <label for="status" class="form-label">Status</label>
       <select name="status" class="form-control">
        <option value="">Select Status</option>
<option value="Active" {{old('status')=='Active' ? 'selected' : ''}}>Active</option>
<option value="Inacticve"{{old('status')=='Inactive' ? 'selected' : ''}}>Inactive</option>

       </select>
           
    <button type="submit" class="btn btn-primary">Add category</button>  

    
    <a href="{{route('categories.index')}}" class="btn btn-secondary mt-3">Back</a>
      </form>
  </div>
</div>
@endsection

            