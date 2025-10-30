@extends('layout.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">All Purchases</h3>
        <a href="{{ route('purchases.create') }}" class="btn btn-info float-right">+ New Purchase</a>
    </div>
    <div class="card-body">
        <x-session-message/>


<p class="text-center text-lg font-black" id="report_header">Pending Purchase Orders</p>
<label class="badge bg-warning text-dark mb-3 text-lg">Pending
<input type='radio' name='status_filter' value='pending' checked></label>
<label class="badge bg-info text-dark mb-3 text-lg">Partially Received
<input type='radio' name='status_filter' value='partially_received'></label>
<label class="badge bg-success text-dark mb-3 text-lg">Complete
<input type='radio' name='status_filter' value='complete'></label>
<label class="badge bg-danger text-dark mb-3 text-lg">Cancelled
<input type='radio' name='status_filter' value='cancelled'></label>

      
        <table class="table table-bordered table-striped">
            
            <thead>
                <tr>
                    <th>Supplier</th>
                    <th>PO Creation Date</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Created By</th>
                      <th>Updated By</th>
                    <th>Pay with</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="purchase-data">
                {{-- data ekhane --}}
            </tbody>
        </table>

        <div class="text-center mt-3">
            <button class="btn btn-primary" id="load-more" data-page="1">Load More</button>
        </div>

        <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">Back</a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){

    // Auto fade success messages
    if($('#success-alert').length){
        setTimeout(() => $('#success-alert').fadeOut('slow'), 3000);
    }
function loadPurchases(status='pending',append=false){
$.ajax({
url:"{{route('purchases.index')}}",
type:'GET',
dataType:'json',
data:{status:status,
    page:currentPage
},
success:function(response){
    if(append){
        $('#purchase-data').append(response.html);

    }
    else{$('#purchase-data').html(response.html);
    }

$('#report_header').text(status.charAt(0).toUpperCase() + status.slice(1) + " Purchase Orders");
if(response.hasMore){
    $('#load-more').show();
}else{
    $('#load-more').hide();
}
},
error:function(xhr){
    alert("error occured"+xhr.statusText);
}


});

};
let currentPage=1;
let currentStatus='pending';
loadPurchases(currentStatus,false);
$('input[name="status_filter"]').on('change',function(){
let status=$(this).val();
currentPage=1;
currentStatus=status;
loadPurchases(currentStatus,false);
});

$('#load-more').click(function(){
    currentPage++;
    loadPurchases(currentStatus,true);
})


});
</script>
@endsection
