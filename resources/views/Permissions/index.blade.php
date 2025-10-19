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
    <h3 class="card-title">Permissions</h3>
    <a href="{{route('permissions.create')}}" class="btn btn-info float-right">Add Permissons</a>
  </div>
  <x-session-message/>
  <div class="card-body">
  <form method="get" action="{{route('brands.search')}}" class="mb-3">
  <input type="text" name="query" class="form-control"
         placeholder="Search by name or code">
  <button type="submit" class="btn btn-primary btn-sm margin">Search</button>
</form>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          
          <th>Permissions Name</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $d)
        <tr>
          
          <td>{{$d['name']}}</td>
          <td >
            <a href="{{route('permissions.edit',['id'=>$d['id']])}}" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>

<a href='javascript:void(0)' class='btn btn-danger btn-sm' onclick="deletePermission(this,{{$d['id']}})"><i class="fas fa-trash-alt"></i></a>
          </td>
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
  });


  function deletePermission(btn,id){
    if(confirm("Are you sure you want to delete this permission?")){
      let row=$(btn).closest('tr');
      $.ajax({
        url: "{{ url('permission')}}/" + id,
       type:'DELETE',
       data:{
        id:id,
        _token:'{{csrf_token()}}'
       },
       dataType:'json',
       success: function(response){
        if (response.status){
          row.remove();
        }else{
          alert(response.message);
        }
       },
       error: function(xhr){
        alert("An error occurred while deleting the permission.");
       }
      
      })
    }
  }
</script>