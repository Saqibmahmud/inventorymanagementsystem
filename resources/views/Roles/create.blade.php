<style>
.cursor_pointer :hover{
  cursor: pointer;
}


</style>

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
<div class="row">
        @foreach($allPermission as $per)
            
           
            <div class="col-lg-2 col-md-3 col-sm-6 mb-2">
                <div class="form-check">
           
                    <input 
                        class="form-check-input cursor_pointer" 
                        type="checkbox" 
                        name="permissions[]" 
                        value="{{ $per->name }}" 
                        id="permission-{{ Str::slug($per->name) }}"
                        @if(isset($hasPermission) && $hasPermission->contains($per->name)) 
                            checked 
                        @endif
                    >
                    
                    <label class="form-check-label" for="permission-{{ Str::slug($per->name) }}">
                        {{ $per->name }}
                    </label>
                </div>
            </div>
        @endforeach
</div>
<input type="submit" class="btn btn-primary mt-0" value="Confirm">
</form>
</div>
</div>
</div>
</div>

@endsection