@extends('layout.app')
@section('content')
<div class="card">
<div class="card-header">
 @if(isset($data))
    <h3 class="card-title">Edit Customer</h3>
      @else
    <h3 class="card-title">Add Customer</h3>
    
@endif
</div>
<div class="card-body">
<div class="form-grup">

    <form action="{{isset($data)?route('customers.update',['customer'=>$data['id']]):route('customers.store')}}" method="POST">
        @csrf
        @if(isset($data))
         @method('PUT') 
         @endif
<label for="name">Customer Name<span style="color:red;">*</span></label>
<input type="text" name="customer_name" class="form-control" value="{{old('customer_name', $data->customer_name?? '')}}" required>
@error('customer_name')
<p class="text-danger">{{$message}}</p>  
@enderror
<label for="customer_email">Customer Email</label>
<input type="text" name="customer_email" class="form-control" value='{{old('customer_email',$data->customer_email?? '')}}'>
@error('customer_email')
<p class="text-danger">{{$message}}</p>
@enderror
<label for="customer_phone">Customer Phone<span style="color:red;">*</span></label>
<input type="text" name="customer_phone" class="form-control" value='{{old('customer_phone',$data->customer_phone ?? '')}}'required>
@error('customer_phone')
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