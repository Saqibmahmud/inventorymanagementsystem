@extends('layout.app')
@section('content')
<div class="card">
<div class="card-header">
    
    @if(isset($data))
    <h3 class="card-title text-xl "> Edit Branch</h3>
    @else
     <h3 class="card-title text-xl"> Add New Branch</h3>
@endif
    </div>
<div class="card-body">
<div class="form-group"></div>
<form   action="{{isset($data)?route('branches.update',[$data->id]):route('branches.store')}} "   method="POST">
@csrf
    @if(isset($data))
    @method('PUT')
    @endif
<label for='name' class="form-label">Name</label>
<input name="name" class="form-control"type='text'value="{{old('name',$data->name??'')}}">
<label for="location" class="form-label">Address</label>
<textarea  class="form-control" name="location">{{$data->location ?? ''}}</textarea> 
@error('location')
    <p class="text-red-500">{{$message}}</p>
@enderror
<br>
<input type='submit' class="btn btn-primary mt-0"value="Confirm"  >

</form>



</div>

</div>





@endsection