@extends('layout.app')
@section('title', 'Brands')
@section('content')
 
    
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Brands</h3>
    <a href="{{route('brands.create')}}" class="btn btn-info float-right">Add Brand</a>
  </div>
  @if(session('success'))
  <div class="alert alert-success" id="success-alert">
    {{session('success')}}
  </div>
  @endif
  <div class="card-body">
  <form method="get" action="#" class="mb-3">
  <input type="text" name="search" class="form-control"
         placeholder="Search by name or code"
         value="">
  <button type="submit" class="btn btn-primary btn-sm">Search</button>
</form>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>ID</th>
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
           <td class="hidden">{{$d['id']}}</td>
          <td>{{$d['brand_name']}}</td>
          <td>{{$d['brand_code']}}</td>
          <td>{{$d['status']}}</td>
          <td>{{$d['created_at']}}</td>
          <td>{{$d['updated_at']}}</td>
          <td>
            <a href="{{'#'}}" class="btn btn-info btn-sm" title="View"><i class="fas fa-eye"></i></a>
            <a href="{{'#'}}" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
            <a href="{{'#'}}" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure?')"><i class="fas fa-trash-alt"></i></a>

        </tr>
              @endforeach
              </tbody>
    </table>
    <a href="{{'#'}}" class="btn btn-secondary mt-3">Back</a>
  </div>
   {{-- <div class="card-footer">
   <nav aria-label="Brands Search Navigation">
    <ul class="pagination justify-content-center m-0">
      
        <li class="page-item">
          <a class="page-link" 
             href="{{}}">
          </a>
        </li>
 
    </ul>
  </nav> 
</div> --}}
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