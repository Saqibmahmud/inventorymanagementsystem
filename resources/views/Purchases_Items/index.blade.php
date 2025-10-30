        @extends('layout.app')
        @section('content')
        <div class="card">
        <div class="card-header">
        <h3 class="card-title"> Purchased Items </h3>
        {{-- <a href="{{route('suppliers.create')}}" class="btn btn-info float-right">+ New Purchase</a> --}}
        </div>
       ['purchase_id','product_id','quantity','purchase_price','total_price'];
        <div class="card-body">
        <form>
        {{-- search hobe --}}
        </form>
        <x-session-message/>
        <table class="table table-bordered table-striped">
        <thead>
        <tr>
        <th>Purchase Id</th>
        <th>Product</th>
        <th>Quantity</th>
         <th>Purchase Price</th>
        <th>Total Price</th>
        <th>Created At</th>
        <th>Actions</th>
        </tr>
        </thead>
        <tbody >
          @foreach ($purchase_items as $d )
        <tr>
        <td>{{$d['purchase_id']}}</td>
        <td>{{$d->product->product_id}}</td>
          <td>{{$d['email']}}</td>
        <td>{{$d['phone']}}</td>
        <td>{{$d['address']}}</td>
        <td>{{$d['created_at']}}</td>
        <td>{{$d['updated_at']}}</td>
        <td>
        <a href="{{route('customers.edit',['customer'=>$d['id']])}}"class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
        <a href="javascript:void(0)" onclick="deleteCustomer({{$d['id']}},'{{$d['customer_name']}}',this)" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
        </td>

        </tr>
        @endforeach
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
        if(confirm("Are you sure you want to delete this supplier:"+name+"?")){
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