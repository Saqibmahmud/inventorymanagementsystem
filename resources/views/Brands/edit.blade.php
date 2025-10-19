@extends('layout.app')
@section('title', 'Edit Brand')
@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Brand</h3>
  
  </div>
  <div class="card-body">
    <div class="form-group">
 <form action="{{route('brands.update',['brand'=>$data->id])}}" method="post">
    @csrf
    @method('PUT')
 
        <label for="brand_name">Brand Name</label>
        <input type="text" name="brand_name" class="form-control" value="{{old('brand_name', $data->brand_name)}}">
       
    </div>
    <div class="form-group">
        <label for="brand_code">Code</label>
        <input type="text" name="brand_code" class="form-control" value={{$data->brand_code}}>    
        {{-- value="{{old('brand_code',$data->brand_code)}} --}}
        
 
    </div>
       <label for="status" class="form-label">Status</label>
        <select name="status" class="form-control">
        <option value="">Select Status</option>
        <option value="active" {{ strtolower(old('status', $data->status)) == 'active' ? 'selected' : '' }}>Active</option>
        <option value="inactive" {{ strtolower(old('status', $data->status)) == 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>

           
    <button type="submit" class="btn btn-primary">Update Brand</button>  

    
    <a href="{{route('brands.index')}}" class="btn btn-secondary mt-3">Back</a>
      </form>
  </div>
</div>
@endsection
