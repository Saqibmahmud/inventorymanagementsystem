@extends('layout.app')
@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Brands</h3>
  
  </div>
  <div class="card-body">
    <div class="form-group">
 <form action="{{route('brands.store')}}" method="post">
    @csrf
        <label for="brand_name">Brand Name</label>
        <input type="text" name="brand_name" class="form-control" >
       
    </div>
    <div class="form-group">
        <label for="brand_code">Code</label>
        <textarea name="brand_code" class="form-control"></textarea>
        
 
    </div>
       <label for="status" class="form-label">Status</label>
       <select name="status" class="form-control">
<option value=1 {{old('status')==1 ? 'selected' : ''}}>Active</option>
<option value=0 {{old('status')==0 ? 'selected' : ''}}>Inactive</option>

       </select>
           
    <button type="submit" class="btn btn-primary">Add Brand</button>  

    
    <a href="{{route('brands.index')}}" class="btn btn-secondary mt-3">Back</a>
      </form>
  </div>
</div>
@endsection

            