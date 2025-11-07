<style>
.plus_icon{
    background-color:greenyellow;
    font:small;
     padding:2px;
     cursor:pointer;
     border-radius: 40%;
}
</style>
@extends('layout.app')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title text-xl">Create New Purchase</h3>
        <a href="{{ route('purchases.index') }}" class="btn btn-secondary">All Purchases</a>
    </div>
    <div class="card-body">
        <x-session-message/>

        <form action="{{route('purchases.store')}}" method="POST">
            @csrf
            {{-- Supplier Selection --}}
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="supplier_id" class="form-label fw-semibold text-lg">Select Supplier</label><a href="{{route('suppliers.create')}}"> <i class="fas fa-plus plus_icon" ></i></a>
                    <select class="form-control "style="height:50px;"  id="supplier_id" name="supplier_id" required>
                        <option value="">-- Select Supplier --</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
<div id="product_rows_container">
    <div class="row g-3 mb-3 align-items-end product-row">
      
        <div class="col-md-4">
            <label class="form-label text-lg fw-semibold">Product</label><a href="{{route('products.create')}}"> <i class="fas fa-plus plus_icon" ></i></a>
            <input type="text" class="form-control product_name" style="height:50px;"placeholder="Type product name..." required>
            <input type="hidden" name="product_id[]" class="product_id">
            <div class="search_result list-group mt-1"></div>
        </div>

       
        <div class="col-md-2">
            <label class="form-label text-lg fw-semibold">Quantity</label>
            <input type="number" name="quantity[]" class="form-control quantity" style="height:50px;"min="1" required>
        </div>

        
        <div class="col-md-2">
            <label class="form-label text-lg fw-semibold">Price-PerUnit</label>
            <input type="number" step="0.01" name="purchase_price[]" class="form-control purchase_price"style="height:50px;" required>
        </div>

        
        <div class="col-md-2">
            <label class="form-label text-lg fw-semibold">Total Price</label>
            <input type="number" step="0.01" name="total_price[]" class="form-control total_price"style="height:50px;" readonly>
        </div>
        
       
        <div class="col-md-2 d-flex align-items-end">
            <button type="button" class="btn btn-danger btn-sm remove-row" title="Remove">
                <i class="fas fa-minus me-1"></i> 
            </button>
        </div>
    </div>
</div>
<div class="mb-3">
    <a style="cursor: pointer" class="btn btn-success"id="add_row" ><i class="fas fa-plus"></i></a>
</div>
 
{{-- Payment Method, Total Amount & Submit Button --}}
<div class="row mt-4">
    <!-- Payment Method Card (Left) -->
    <div class="col-md-6">
        <div class="card p-3">
            <label class="fw-bold mb-2 text-center text-lg">Pay With:</label>
            <div class="d-flex flex-wrap justify-content-center gap-2">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="paid_with" value="cash" id="paid_cash" checked>
                    <label class="form-check-label" for="paid_cash"><img  src="{{ asset('assets/dist/img/cash-outline.svg') }}" alt="CASH" height="50" width="50"></label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="paid_with" value="card" id="paid_card">
                    <label class="form-check-label" for="paid_card"><img  src="{{ asset('assets/dist/img/Card-outline.svg') }}" alt="CARD" height="50" width="50"></label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="paid_with" value="bank" id="paid_bank">
                    <label class="form-check-label" for="paid_bank"><img  src="{{ asset('assets/dist/img/bank-svgrepo-com.svg') }}" alt="BANK" height="50" width="50"></label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="paid_with" value="bkash" id="paid_bkash">
                    <label class="form-check-label" for="paid_bkash"><img  src="{{ asset('assets/dist/img/BKash-Logo.wine.svg') }}" alt="BKASH" height="85" width="85"></label>  
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="paid_with" value="nagad" id="paid_nagad">   
                    <label class="form-check-label" for="paid_nagad"><img  src="{{ asset('assets/dist/img/Nagad-Logo.wine.svg') }}" alt="NAGAD" height="85" width="85"></label>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Amount (Right) -->
    <div class="col-md-6">
        <div class="card p-3 text-center">
            <label class="fw-bold fs-5 mb-2 text-lg">Total Amount:</label>
            <input type="text"
                   class="form-control bg-dark text-white text-center fw-bold fs-4 text-xl"
                   style="height:80px;"
                   name="total_amount"
                   readonly
                   id="total_amount"
                   value="0.00">
        </div>
    </div>
</div>

<!-- Submit Button (Full Width Below) -->
<div class="row mt-3">
    <div class="col-12 text-center">
        <input type="submit"
               class="btn btn-success btn-lg fw-semibold fs-3 text-lg font-bold"
               style="width: 80%;  padding: 25px 0;"
               value="Create Purchase"/>
    </div>
</div>

        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    function calculateRowTotal(row){
        let qty = parseFloat(row.find('.quantity').val()) || 0;
        let price = parseFloat(row.find('.purchase_price').val()) || 0;
        row.find('.total_price').val((qty * price).toFixed(2));
    }

    
    $(document).on('change keyup', '.quantity, .purchase_price', function(){
        let row = $(this).closest('.product-row');
        calculateRowTotal(row);
        countTotalAmmount();
    });

   
    $(document).on('keyup', '.product_name', function () {
        let query = $(this).val();
        let row = $(this).closest('.product-row');
        let resultContainer = row.find('.search_result');
         let Supplier_id= $('#supplier_id').val();


        if (query.length >= 2) {
            $.ajax({
                url: "{{route('products.search')}}",
                type: 'GET',
                data: { term: query ,supplier_id:Supplier_id},
                dataType: 'json',
                success: function(response) {
                    resultContainer.html(response.html);
                },
                error: function(xhr) {
                    resultContainer.html('<div class="text-danger">Error loading products</div>');
                }
            });
        } else {
            resultContainer.html('');
        }
    });

    $(document).on('click', '.search_result .list-group-item', function(e){
        e.preventDefault();
        let row = $(this).closest('.product-row');
        row.find('.product_name').val($(this).data('name'));
        row.find('.product_id').val($(this).data('id'));
        row.find('.search_result').html('');
    });
    $(document).on('click', function(e) {
    if (!$(e.target).closest('.product-row').length) {
        $('.search_result').html('');
    }
});
   

    // Add new row
    $('#add_row').click(function(){
        let newRow = $('.product-row:first').clone();
        newRow.find('input').val(''); 
        newRow.find('.search_result').html('');
        $('#product_rows_container').append(newRow);
        countTotalAmmount();
    });

$(document).on('click','.remove-row',function(){
    if($('.product-row').length > 1){
        $(this).closest('.product-row').remove();
        countTotalAmmount()
    }else{
        alert('At least one product row is required.');
    }
});
function countTotalAmmount(){
    
    let totalAmount=0.00 ;
    $('.total_price').each(function(){
        totalAmount += parseFloat($(this).val())||0 ;
    });
    $('#total_amount').val(totalAmount.toFixed(2));
}

countTotalAmmount()

});

</script>
@endsection