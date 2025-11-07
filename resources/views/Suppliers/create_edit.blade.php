@extends('layout.app')
@section('content')
<div class="card">
<div class="card-header">
 @if(isset($data))
    <h3 class="card-title text-xl">Edit Supllier</h3>
      @else
    <h3 class="card-title text-xl">Add Supplier</h3>
    
@endif
</div>
<div class="card-body">
<div class="form-grup">

    <form action="{{isset($data)?route('suppliers.update',['customer'=>$data['id']]):route('suppliers.store')}}" method="POST">
        @csrf
        @if(isset($data))
         @method('PUT') 
         @endif
<label for="name">Supplier Name<span style="color:red;">*</span></label>
<input type="text" name="supplier_name" class="form-control" value="{{old('supplier_name', $data->supplier_name?? '')}}" required>
@error('supplier_name')
<p class="text-danger">{{$message}}</p>  
@enderror
<label for="name">Contact Name<span style="color:red;">*</span></label>
<input type="text" name="contact_name" class="form-control" value="{{old('contact_name', $data->contact_name?? '')}}" required>
@error('supplier_name')
<p class="text-danger">{{$message}}</p>  
@enderror
<label for="email"> Email</label>
<input type="text" name="email" class="form-control" value='{{old('email',$data->email?? '')}}'>
@error('email')
<p class="text-danger">{{$message}}</p>
@enderror
<label for="phone">Phone<span style="color:red;">*</span></label>
<input type="text" name="phone" class="form-control" value='{{old('phone',$data->phone ?? '')}}'required>
@error('phone')
<p class="text-danger">{{$message}}</p>
@enderror
<label for="address">Address<span style="color:red;">*</span></label>
<input type="text" name="address" class="form-control" value='{{old('address',$data->address ?? '')}}'required>
@error('address')
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