@extends('layout.app')
@section('content')
<div class="card">
<div class="card-header">
 @if(isset($data))
    <h3 class="card-title">Edit Users</h3>
      @else
    <h3 class="card-title">Add Users</h3>
    
@endif
</div>
<div class="card-body">
<div class="form-grup">

    <form action="{{isset($data)?route('users.update',['user'=>$data['id']]):route('users.store')}}" method="POST">
        @csrf
        @if(isset($data))
         @method('PUT') 
         @endif
<label for="name">User Name</label>
<input type="text" name="name" class="form-control" value='{{old('name',$data->name?? '')}}'>
@error('name')
<p class="text-danger">{{$message}}</p>  
@enderror
@if(!isset($data))
<label for="password">User Password</label>
<input type="password" name="password" class="form-control">
@error('password')
<p class="text-danger">{{$message}}</p>  
@enderror
@endif

<label for="email">User Email</label>
<input type="text" name="email" class="form-control" value='{{old('email',$data->email?? '')}}'>
@error('email')
<p class="text-danger">{{$message}}</p>
@enderror
@foreach($roles  as $r)
@if(isset($hasRole))
<input {{($hasRole->contains($r->name))? 'checked':''}} type='checkbox' name=roles[] value="{{$r->name}}" >
@else
<input  type='checkbox' name=roles[] value="{{$r->name}}" >
@endif

<label for="">{{$r->name}}</label>
@endforeach
@error('roles')
<p class="text-danger">{{$message}}</p>  
@enderror


  

<label for='branch'>Branch</label>
<select name='branch_id'>
  <option value-=''>--Select Branch--</option>
  @foreach ($branches as $branch )
  <option value="{{$branch->id}}" {{isset($data)&& $data->branch_id == $branch->id ?'selected':''}} > {{$branch->name}}</option>   
@endforeach
</select>
@error('branch_id')
<p class="text-danger">{{$message}}</p>  
@enderror


<br>

<input type="submit" class="btn btn-primary mt-0" value="Confirm">
</form>
</div>
</div>
</div>
</div>

@endsection