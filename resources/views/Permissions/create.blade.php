@extends('layout.app')
@section('content')
<div class="card">
  <div class="card-header">
    @if(isset($data))
    <h3 class="card-title text-xl">Edit Permissions</h3>
    @else
    <h3 class="card-title text-xl">Add Permissions</h3>
    @endif
  </div>
  <div class="card-body">
    <div class="form-group">
 <form action="{{isset($data)?route('permissions.update',['id'=>$data->id]): route('permissions.store')}}" method="post">
    @csrf
    @if(isset($data))
     @method('PUT')
    @endif
            <label for="name">Permission Name</label>
        <input type="text" name="name" class="form-control" value="{{old('name',$data->name?? '' )}}">
        @error('name')
        
        <p class="alert alert-danger">{{$message}} </p>
            
        @enderror
        <input type='submit' class="btn btn-primary mt-3" value="Confirm">
        
 </form>
    </div>
    @endsection
    