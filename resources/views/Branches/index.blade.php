@extends('layout.app')
@section('title', 'Branches')
@section('content')
 <style>
.margin{
  margin: 10px
}


 </style>
    
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Branches</h3>
    <a href="{{route('branches.create')}}" class="btn btn-info float-right">Add Branch</a>
  </div>
  <x-session-message/>
  <div class="card-body">
  {{-- <form method="get" action="{{route('branches.search')}}" class="mb-3">
  <input type="text" name="query" class="form-control"
         placeholder="Search by name or code">
  <button type="submit" class="btn btn-primary btn-sm margin">Search</button>
</form> --}}
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          
          <th>Name</th>
          <th>Location</th>
          <th>Created At</th>
           <th>Updated At</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($branches as $d)
        <tr>
          
          <td>{{$d['name']}}</td>
          <td>{{$d['location']}}</td>
          <td>{{$d['created_at']}}</td>
          <td>{{$d['updated_at']}}</td>
          <td >
            <a href="{{'#'}}" class="btn btn-info btn-sm" title="View"><i class="fas fa-eye"></i></a>
            <a href="{{route('branches.edit',['branch'=>$d['id']])}}" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
           <a href="javascript:void(0)" onclick="deleteBranch(this,'{{$d['name']}}',{{$d['id']}})" class="btn btn-danger btn-sm"  title="Delete"><i class="fas fa-trash-alt"></i></a>
        </tr>
              @endforeach
              </tbody>
    </table>
    <a href="{{route('dashboard')}}" class="btn btn-secondary mt-3">Back</a>
  </div>
  <div class="card-footer center">
    {{$branches->links('pagination::bootstrap-5')}}
  </div>
   
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
  if($('#success-alert').length!=0){
   setTimeout(() => {
    $('#success-alert').fadeOut('slow');
   }, 3000); 
  }





});
function deleteBranch(btn,name,id){
  if(!confirm("Are you sure you want to delete this branch:"+name)){
    return;
  }
let row=$(btn).closest('tr');
$.ajax({
url:"{{url('branches')}}/"+id,
type:'DELETE',
data:{
  id:id,
  _token:'{{csrf_token()}}'
},
success:function(response){
if(response.status){
row.remove();
}
else
alert(response.message);
},
error:function(xhr){
  alert("An error occured"+xhr.statusText);
}
});
}

</script>

@endsection