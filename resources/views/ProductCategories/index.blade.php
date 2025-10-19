
@extends('layout.app')
@section('title', 'Brands')
@section('content')
 <style>
.margin{
  margin: 10px
}


 </style>
    
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Product Categories</h3>
    <a href="{{route('categories.create')}}" class="btn btn-info float-right">Add Category</a>
  </div>
  @if(session('success'))
  <div class="alert alert-success" id="success-alert">
    {{session('success')}}
  </div>
  @endif
  @if(session('update_success'))
  <div class="alert alert-success" id="success-alert">{{session('update_success')}}</div>
  @endif
    @if(session('delete_success'))
  <div class="alert alert-danger" id="success-alert">{{session('delete_success')}}</div>
  @endif
  <div class="card-body">
  <form method="get" action="{{route('categories.search')}}" class="mb-3">
  <input type="text" name="query" class="form-control"
         placeholder="Search by name or code">
  <button type="submit" class="btn btn-primary btn-sm margin">Search</button>
</form>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          
          <th>Name</th>
          <th>Code</th>
          <th>Status</th>
          <th>Created At</th>
           <th>Updated At</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $d)
        <tr>
        
          
          <td>{{$d['product_category_name']}}</td>
          <td>{{$d['product_category_code']}}</td>
          <td>{{$d['status']}}</td>
          <td>{{$d['created_at']}}</td>
          <td>{{$d['updated_at']}}</td>
          <td >
            <a href="{{'#'}}" class="btn btn-info btn-sm" title="View"><i class="fas fa-eye"></i></a>
            <a href="{{route('categories.edit',['category'=>$d['id']])}}" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
           
           <form action="{{route('brands.destroy',['brand'=>$d['id']])}}" method="post" style="display:inline">
            @method('DELETE')
            @csrf
         <button type="submit" value="Delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you Sure')"><i class="fas fa-trash-alt"></i></button>
            {{-- <a href="{{route('brands.destroy',['brand'=>$d['id']])}}" class="btn btn-danger btn-sm" onclick="confirm('Are You sure')" title="Delete"><i class="fas fa-trash-alt"></i></a> --}}
           </form>
        </tr>
              @endforeach
              </tbody>
    </table>
    <a href="{{url('/')}}" class="btn btn-secondary mt-3">Back</a>
  </div>
  <div class="card-footer center">
    {{$data->links('pagination::bootstrap-5')}}
  </div>
   
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function(){
if($('#success-alert').length){
setTimeout(() => {
  $('#success-alert').fadeOut('slow');
}, 3000);
  

}
  })
</script>