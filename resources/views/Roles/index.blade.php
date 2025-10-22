@extends('layout.app')
@section('content')

<style>
.margin{
  margin: 10px
}
 </style>
  
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Roles&Permissions</h3>
    <a href="{{route('roles.create')}}" class="btn btn-info float-right">Add Roles&Permisssions</a>
  </div>
  <x-session-message/>
  <div class="card-body">
 
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          
          <th>Role Name</th>
          <th>Permissions</th>
          <th>Created At</th>
          <th>Last Updated</th>
          <th>Actions</th>
          
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $d)

        <tr>

          <td>{{$d['name']}}</td>
          <td>{{$d['permissions']->pluck('name')->implode(',')}}</td>
             <td>{{$d['created_at']}}</td>
                <td>{{$d['updated_at']}}</td>
          <td >
            <a href="{{route('roles.edit',['role'=>$d['id']])}}" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>       
<a href='javascript:void(0)' class='btn btn-danger btn-sm' onclick="deleteRole(this, {{$d['id']}})"><i class="fas fa-trash-alt"></i></a>


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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        if($('#success-alert').length){
            setTimeout(() => {
                $('#success-alert').fadeOut('slow'); 
            }, 3000); 
        }
    });

    function deleteRole(btn,id){
        if(confirm("Are You Sure You Want to Delete the ROLE?"))
        {
          let row=$(btn).closest('tr');
            $.ajax({
                url: "{{url('roles')}}/" + id,
                type :'DELETE',
                data:{
                    id: id,
                    _token: '{{ csrf_token() }}' 
                },
                success:function(response){
                    if(response.status){
                        row.remove();
                    }
                    else{
                        alert(response.message)
                    }
                }, 
                error: function(xhr){
                    alert("An error Occured: " + xhr.statusText);
                } 
            });
        }
    }
</script>

@endsection