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
    <h3 class="card-title mb-0">Edit Purchase Invoice</h3>

    <div class="d-flex align-items-center gap-2 ms-auto ">
        <!-- Cancel PO Button -->
        <button type="button" id="cancel_btn" class="btn btn-danger d-flex align-items-center m-3">
            <i class="fas fa-ban me-2"></i> Cancel PO
        </button>

        <!-- All Purchases Button -->
        <a href="{{ route('purchases.index') }}" class="btn btn-secondary d-flex align-items-center">
            <i class="fas fa-list me-2"></i> All Purchases
        </a>
    </div>
</div>

    <div class="card-body">
        <x-session-message/>

        <form action="{{ route('purchases.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Supplier Selection --}}
            <div class="row mb-3">
                
                <div class="col-md-12">
                    
                    <label for="supplier_id" class="form-label fw-semibold text-lg">Select Supplier</label>
                    <a href="{{ route('suppliers.create') }}"> 
                        <i class="fas fa-plus plus_icon"></i>
                    </a>
                    <select class="form-control" style="height:50px;" id="supplier_id" name="supplier_id" required>
                        <option value="">-- Select Supplier --</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{$supplier->id}}" {{ isset($data->supplier_id) && $data->supplier_id == $supplier->id ? 'selected' : '' }}>
                                {{ $supplier->supplier_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('supplier_id')
                        <p class="alert alert-danger mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Product Items --}}
            <div id="product_rows_container">
                @if(isset($data) && $data->purchase_items)
                    @foreach ($data->purchase_items as $item)
                   <div class="row g-2 mb-3 align-items-end product-row">
    {{-- Product Selection --}}
    <div class="col-md-3">
        <label class="form-label fw-semibold">Product</label>
        <a href="{{ route('products.create') }}"> 
            <i class="fas fa-plus plus_icon"></i>
        </a>
        <select name="product_id[]" class="form-control" style="height:45px;" required>
            <option value="">-- Select Product --</option>
            @foreach($products as $product)
                <option value="{{ $product->id }}" {{ isset($item->product_id) && $item->product_id == $product->id ? 'selected' : '' }}>
                    {{ $product->product_name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Quantity --}}
    <div class="col-md-2">
        <label class="form-label fw-semibold">Qty</label>
        <input type="number" name="quantity[]" class="form-control quantity" 
               value="{{ $item->quantity ?? '' }}" style="height:45px;" min="1" required>
    </div>

    {{-- Purchase Price --}}
    <div class="col-md-2">
        <label class="form-label fw-semibold">Price</label>
        <input type="number" step="0.01" name="purchase_price[]" 
               class="form-control purchase_price" value="{{ $item->purchase_price ?? '' }}" 
               style="height:45px;" required>
    </div>

    {{-- Total Price --}}
    <div class="col-md-2">
        <label class="form-label fw-semibold">Total</label>
        <input type="number" step="0.01" name="total_price[]" 
               class="form-control total_price" value="{{ $item->total_price ?? '' }}" 
               style="height:45px;" readonly>
    </div>


    {{-- Received Quantity --}}
    <div class="col-md-2">
        <label class="form-label fw-semibold">Rec Qty</label>
        <input type="number" name="received_quantity[]" 
               class="form-control received_quantity" 
               style="height:45px; weight:"  >
    </div>
    @if($errors->has('received_quantity.*'))
    <p class="text-sm"style="color:red;">{{ $errors->first('received_quantity.*') }}</p>
    @endif

    {{-- Remove Button --}}
    <div class="col-md-1 d-flex align-items-end">
        <button type="button" class="btn btn-danger btn-sm remove-row" title="Remove" style="margin-bottom: 8px;">
            <i class="fas fa-times"></i> 
        </button>
    </div>
</div>
                    @endforeach
                @endif
            </div>

          
            <div class="mb-3">
                <a style="cursor: pointer" class="btn btn-success" id="add_row">
                    <i class="fas fa-plus"></i> 
                </a>
            </div>

          
            <div class="row mt-4">
                {{-- Payment Method --}}
                <div class="col-md-6">
                    <div class="card p-3">
                        <label class="fw-bold mb-2 text-center text-lg">Pay With:</label>
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="paid_with" value="cash" 
                                       {{ isset($data->paid_with) && $data->paid_with == 'cash' ? 'checked' : '' }} id="paid_cash">
                                <label class="form-check-label" for="paid_cash">
                                    <img src="{{ asset('assets/dist/img/cash-outline.svg') }}" alt="CASH" height="50" width="50">
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="paid_with" value="card" 
                                       {{ isset($data->paid_with) && $data->paid_with == 'card' ? 'checked' : '' }} id="paid_card">
                                <label class="form-check-label" for="paid_card">
                                    <img src="{{ asset('assets/dist/img/Card-outline.svg') }}" alt="CARD" height="50" width="50">
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="paid_with" value="bank" 
                                       {{ isset($data->paid_with) && $data->paid_with == 'bank' ? 'checked' : '' }} id="paid_bank">
                                <label class="form-check-label" for="paid_bank">
                                    <img src="{{ asset('assets/dist/img/bank-svgrepo-com.svg') }}" alt="BANK" height="50" width="50">
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="paid_with" value="bkash" 
                                       {{ isset($data->paid_with) && $data->paid_with == 'bkash' ? 'checked' : '' }} id="paid_bkash">
                                <label class="form-check-label" for="paid_bkash">
                                    <img src="{{ asset('assets/dist/img/BKash-Logo.wine.svg') }}" alt="BKASH" height="85" width="85">
                                </label>  
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="paid_with" value="nagad" 
                                       {{ isset($data->paid_with) && $data->paid_with == 'nagad' ? 'checked' : '' }} id="paid_nagad">   
                                <label class="form-check-label" for="paid_nagad">
                                    <img src="{{ asset('assets/dist/img/Nagad-Logo.wine.svg') }}" alt="NAGAD" height="85" width="85">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

               
                <div class="col-md-6">
                    <div class="card p-3 text-center">
                      
  <label class="form-label fw-bold text-lg">Status</label>
                   <input type="text" name="status" id="status"class="form-control" style="height:50px;" value="{{$data->status??''}}" @readonly(true) />
                

                        {{-- Total Amount --}}
                        <label class="fw-bold fs-5 mb-2 text-lg">Total Amount:</label>
                        <input type="text"
                               class="form-control bg-dark text-white text-center fw-bold fs-4 text-xl"
                               style="height:80px;"
                               name="total_amount"
                               readonly
                               id="total_amount"
                               value="{{ isset($data->total_amount) ? number_format($data->total_amount, 2) : '0.00' }}">
                    </div>
                </div>
            </div>

           
            <div class="row mt-3">
                <div class="col-12 text-center">
                    <input type="submit"
                           class="btn btn-success btn-lg fw-semibold fs-3 text-lg font-bold"
                           style="width: 80%; padding: 25px 0;"
                           id="update_btn"
                           value="Update Purchase"/>
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
        let total = (qty * price).toFixed(2);
        row.find('.total_price').val(total);
        return parseFloat(total);
    }

    function countTotalAmount(){
        let totalAmount = 0.00;
        $('.product-row').each(function(){
            totalAmount += calculateRowTotal($(this));
        });
        $('#total_amount').val(totalAmount.toFixed(2));
    }

    // Calculate totals when quantity or price changes
    $(document).on('change keyup', '.quantity, .purchase_price', function(){
        let row = $(this).closest('.product-row');
        calculateRowTotal(row);
        countTotalAmount();
    });

    // Add new row
    $('#add_row').click(function(){
        let newRow = $('.product-row:first').clone();
        newRow.find('input').val('');
        newRow.find('select').val('');
        $('#product_rows_container').append(newRow);
        countTotalAmount();
        $('#supplier_id').trigger('change');
    });

    // Remove row
    $(document).on('click', '.remove-row', function(){
        if($('.product-row').length > 1){
            $(this).closest('.product-row').remove();
            countTotalAmount();
        } else {
            alert('At least one product row is required.');
        }
    });
    countTotalAmount();

$('#supplier_id').on('change',function(){
let supplierId= $(this).val();

$.ajax({
url:"{{route('products.search')}}",
type:'GET',
dataType:'json',
data:{
supplier_id:supplierId
},
success:function(Searchproducts){
    if(Searchproducts.length==0){
        alert("no product found");
    }
$('select[name="product_id[]"]').each(function(){
                        let select = $(this);
                        select.empty();
                        select.append('<option value="">-- Select Product --</option>');
                        Searchproducts.forEach(Searchproducts => {
                            select.append(`<option value="${Searchproducts.id}">${Searchproducts.product_name}</option>`);
                        });
})
},
error:function(xhr){

    alert("error occured"+xhr.statusText);
}
})
});



$('.received_quantity ').on('change keyup',function(){
    decideStatus();
});

function decideStatus() {
    let allPending = true;
    let allComplete = true;

    $('.product-row').each(function(){
        let Qty = parseFloat($(this).find('.quantity').val()) || 0;
        let receiveQty = parseFloat($(this).find('.received_quantity').val()) || 0;

        if(receiveQty > 0) allPending = false;       
        if(receiveQty < Qty) allComplete = false;  
    });

    if(allPending){
        $('#status').val('pending');
    } else if(allComplete){
        $('#status').val('complete');
    } else {
        $('#status').val('partially_received');
    }
}

$('#cancel_btn').on('click',function(){
if(confirm("Are you sure you want to delete this PO?")){
$('#status').val('cancelled');
$('#update_btn').click();
}


});


 if($('#status').val()==='cancelled'){
        $('input').prop('readonly',true);
        $('select').prop('disabled',true);
        $('#update_btn , #add_row').hide();
        $('#cancel_btn ,.remove-row').prop('disabled',true);
        // $('').prop('disabled',true);
    }



});

</script>
@endsection