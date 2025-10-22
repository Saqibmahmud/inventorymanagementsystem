        @extends('layout.app')
        @section('content')
        <div class="card">
        <div class="card-header">
        <h3 class="card-title">Customers </h3>
        <a href="{{route('customers.create')}}" class="btn btn-info float-right">Add New Customers</a>
        </div>
        <div class="card-body">
        <form>
        {{-- search hobe --}}
        </form>
        <x-session-message/>
        <table class="table table-bordered table-striped">
        <thead>
        <tr>
        <th>Customer Name</th>
        <th>Customer Email</th>
        <th>Customer Phone</th>
        <th>Created At</th>
        <th>Updated At</th>
        {{-- <th>Permissions</th> --}}
        <th>Actions</th>
        </tr>
        </thead>
        <tbody id="customer-data">
    
        @include('Customers.load_data',['customers'=>$customers])
        </tbody>
        </table>
         <a href="{{route('dashboard')}}" class="btn btn-secondary mt-3">Back</a>
        </div>
        
 <div style="text-align: center;">  <button class="btn btn-primary" id="load-more" data-page="1" >Load More</button>   </div>
              
                    
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
$('#load-more').click(function(){
let button=$(this);
    let page= parseInt($(button).data('page'))+1;

    $.ajax({
url:"{{route('customers.index')}}",
type:'GET',
data:{page:page},
dataType:'json',
success:(response)=>{
if($.trim(response.html)===''){

    button.text("No more Data").prop('disabled',true);
    return ;
}
$("#customer-data").append(response.html);
button.data('page',page);

},
error:(xhr)=>{
    alert("An error occured"+xhr.statusText);
}

 })

});

 window.deleteCustomer= function(id,name,btn){
        if(confirm("Are you sure you want to delete this customer:"+name+"?")){
            let row=$(btn).closest('tr');
    $.ajax({
    url :"{{url('customers')}}/"+id ,
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

})



        </script>