@extends('layout.app')
@section('content')
<div class="card">
<div class="card-header">
 @if(isset($data))
    <h3 class="card-title">Edit Roles</h3>
      @else
    <h3 class="card-title">Add Roles</h3>
@endif
</div>
<div class="card-body">
<div class="form-grup">

    <form action="{{isset($data)?route('roles.update',['role'=>$data['id']]):route('roles.store')}}" method="POST">
        @csrf
        @if(isset($data))
         @method('PUT') 
         @endif
<label for="name">Role Name</label>
<input type="text" name="name" class="form-control" value='{{old('name',$data->name?? '')}}'>
@error('name')
<p class="alert alert-danger">{{$message}}</p>
@enderror
@foreach($allPermission as $per)
@if(isset($hasPermission))
<input {{($hasPermission->contains($per->name)) ? 'checked': ''}}  type="checkbox" name="permissions[]" value="{{$per->name}}"  >
@else
<input type="checkbox" name="permissions[]" value="{{$per->name}}"  >
@endif
<label for="">{{$per->name}}</label>
@endforeach
<br>

<input type="submit" class="btn btn-primary mt-0" value="Confirm">
</form>
</div>
</div>
</div>
</div>

@endsection