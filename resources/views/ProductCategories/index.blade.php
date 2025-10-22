
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
          <td>{{($d['status']==1)?'Active':'Inactive'}}</td>
          <td>{{$d['created_at']}}</td>
          <td>{{$d['updated_at']}}</td>
          <td >
            <a href="{{'#'}}" class="btn btn-info btn-sm" title="View"><i class="fas fa-eye"></i></a>
            <a href="{{route('categories.edit',['category'=>$d['id']])}}" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
             <a href="javascript:void(0)" onclick="deleteCategory({{$d['id']}},'{{$d['product_category_name']}}',this)" class="btn btn-danger btn-sm"  title="Delete"><i class="fas fa-trash-alt"></i></a>
          
        </tr>
              @endforeach
              </tbody>
    </table>
    <a href="{{route('dashboard')}}" class="btn btn-secondary mt-3">Back</a>
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
  });
  function deleteCategory(id,name,btn){
  if(confirm("Are you sure you want to delete, category="+name+"?")){
 let row= $(btn).closest('tr');
 $.ajax({
url:"{{url('categories')}}/"+id,
type:'DELETE',
data:{
  id:id,
  _token:'{{csrf_token()}}'
},
success:(response)=>{
  if(response.status){
    row.remove();
  }
  else
  alert(response.message);

},
error:(xhr)=>{
alert("An error occured"+xhr.statusText)

}


 })
  }

  }
</script>