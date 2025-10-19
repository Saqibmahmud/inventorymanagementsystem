        @extends('layout.app')
        @section('content')
        <div class="card">
        <div class="card-header">
        <h3 class="card-title">Users</h3>
        <a href="{{route('users.create')}}" class="btn btn-info float-right">Add Users</a>
        </div>
        <div class="card-body">
        <form>
        {{-- search hobe --}}
        </form>
        <x-session-message/>
        <table class="table table-bordered table-striped">
        <thead>
        <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Created_At</th>
        <th>Updated_at</th>
        {{-- <th>Permissions</th> --}}
        <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($data as $d )
        <tr>
        <td>{{$d['name']}}</td>
        <td>{{$d['email']}}</td>
        <td>{{$d['roles']->pluck('name')->implode(',')}}</td>
        <td>{{$d['created_at']}}</td>
        <td>{{$d['updated_at']}}</td>
        <td>
        <a href="{{route('users.edit',['user'=>$d['id']])}}"class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
        <a href="javascript:void(0)" onclick="deleteUser({{$d['id']}},'{{$d['name']}}',this)" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
        </td>

        </tr>
        @endforeach
        </tbody>
        </table>
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
        function deleteUser(id,name,btn){
            if(confirm("Are you sure you want to delete this user:"+name+"?")){
                let row=$(btn).closest('tr');
        $.ajax({
        url :"{{url('users')}}/"+id ,
        type:"DELETE",
        data:{
        id:id,
        _token:'{{csrf_token()}} '
        },
        success:(response)=>{
        if(response.status){
        row.remove();
        }
        else{
        alert(response.message);
        }
        },
        error:(xhr)=>{
        alert("an error occured"+ xhr.statusText);
        }
        })



            }


        }





        </script>