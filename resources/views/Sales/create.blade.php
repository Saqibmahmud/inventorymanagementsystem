<style>
.plus_icon{
    background-color:greenyellow;
    font:small;
     padding:2px;
     cursor:pointer;
     border-radius: 40%;
}

/* Custom styling for larger total and due amount fields */
.large-amount-field {
    height: 70px !important;
    font-size: 1.8rem !important;
    font-weight: bold;
}
</style>
@extends('layout.app')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title text-xl"> New Sale Invoice</h3>
        <a href="{{ route('purchases.index') }}" class="btn btn-secondary">All Sales</a>
    </div>
    <div class="card-body">
  <x-session-message/>

  <!-- 🧾 Customer Information -->
  <div class="card mb-4 shadow-sm border-success">
    <div class="card-header text-black  text-lg fw-bolder">
     <u> Customer Information</u>
     <hr>
    </div>
        <form action="{{ route('sales.store') }}" method="POST">
    @csrf
          
    <div class="card-body">
      <div class="row g-3 ">
     <div class="col-md-3">
          <label class="form-label fw-semibold text-lg">Phone Number</label>
          <input type="text" name="customer_phone" id="customer_phone" class="form-control" style="height:45px;" placeholder="Enter phone number" required>
        </div>
        <div class="col-md-3   ">
          <label class="form-label  text-black fw-semibold text-lg">Customer Name</label>
          <input type="text" name="customer_name" id="customer_name" class="form-control" style="height:45px;" placeholder="Enter name" required>
         <input type="hidden" name="customer_id" id="customer_id" required>
        </div>
     
        <div class="col-md-3">
          <label class="form-label fw-semibold text-lg">Email</label>
          <input type="email" name="customer_email" id="customer_email" class="form-control" style="height:45px;" placeholder="Enter email">
        </div>
       
      </div>
    </div>
  </div>
    <div id="product_rows_container">
      <div class="row g-3 mb-3 align-items-end product-row">
        <div class="col-md-4">
          <label class="form-label text-lg fw-semibold">Product</label>
          <input type="text" class="form-control product_name"  style="height:50px;" placeholder="Type product name..." required>
          <input type="hidden" name="product_id[]" class="product_id">
          <div class="search_result list-group mt-1"></div>
        </div>

        <div class="col-md-2">
          <label class="form-label text-lg fw-semibold">Quantity</label>
          <input type="number" name="quantity[]" class="form-control quantity" style="height:50px;" min="1" required>
        </div>

        <div class="col-md-2">
          <label class="form-label text-lg fw-semibold">Price-PerUnit</label>
          <input type="number" step="0.01" name="selling_price[]" class="form-control selling_price" style="height:50px;" required readonly>
        </div>

        <div class="col-md-2">
          <label class="form-label text-lg fw-semibold">Total Price</label>
          <input type="number" step="0.01" name="total_price[]" class="form-control total_price" style="height:50px;" readonly>
        </div>

        <div class="col-md-2 d-flex align-items-end">
          <button type="button" class="btn btn-danger btn-sm remove-row" title="Remove">
            <i class="fas fa-minus me-1"></i>
          </button>
        </div>
      </div>
    </div>

    <div class="mb-3">
      <a style="cursor: pointer" class="btn btn-success" id="add_row"><i class="fas fa-plus"></i></a>
    </div>

  
    <div class="row mt-4">
      <!-- Payment Method -->
      <div class="col-md-6">
        <div class="card p-3">
          <label class="fw-bold mb-2 text-center text-lg">Pay With:</label>
          <div class="d-flex flex-wrap justify-content-center gap-2">
            @foreach(['cash' => 'cash-outline.svg', 'card' => 'Card-outline.svg', 'bank' => 'bank-svgrepo-com.svg', 'bkash' => 'BKash-Logo.wine.svg', 'nagad' => 'Nagad-Logo.wine.svg'] as $method => $icon)
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="paid_with" value="{{ $method }}" id="paid_{{ $method }}" {{ $loop->first ? 'checked' : '' }}>
              <label class="form-check-label" for="paid_{{ $method }}">
                <img src="{{ asset('assets/dist/img/'.$icon) }}" alt="{{ strtoupper($method) }}" height="60">
              </label>
            </div>
            @endforeach
          </div>
        </div>
      </div>

      <!-- Totals & Discount (Side by Side Layout) -->
      <div class="col-md-6">
        <!-- Discount Field -->
        <div class="card p-3 text-center mb-3">
          <label class="fw-bold fs-5 mb-2 text-lg">Voucher / Discount:</label>
          <input type="number" step="0.01" name="discount" id="discount" class="form-control text-center fw-bold fs-4 " placeholder="Enter discount"style="height:40px;">
        </div>
       
        <!-- Total and Due Amount Side by Side -->
        {{-- <div class="row g-3"> --}}
         
            <div class="card p-3 text-center h-100">
              <label class="fw-bold fs-5 mb-2 text-lg">Total Amount:</label>
              <input type="text" class="form-control bg-dark text-white text-center fw-bold large-amount-field" name="total_amount" id="total_amount" readonly value="0.00">
            </div>
          </div>
        

          {{-- <div class="col-md-6">
            <div class="card p-3 text-center h-100">
              <label class="fw-bold fs-5 mb-2 text-lg">Due Amount:</label>
              <input type="text" class="form-control bg-dark text-white text-center fw-bold large-amount-field" name="due_amount" id="due_amount" readonly value="0.00">
            </div>
          </div> --}}
        </div> 
      </div>
    </div>

    <!-- Submit Button -->
    <div class="row mt-4">
      <div class="col-12 text-center">
        <input type="submit" class="btn btn-success btn-lg fw-semibold fs-3" style="width: 80%; padding: 20px 0;" value="Create Sale" />
      </div>
    </div>
  </form>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {

    let originalTotal = 0.00; 
    let currentFocus = -1;

function price_perunit(row){
    let productName = row.find('.product_name').val().trim(); 
    if(!productName) return; 

    $.ajax({
        url: "{{ route('products.price') }}",
        type: 'GET',
        data: { name: productName },
        dataType: 'json',
        success: function(response){
            if(response.status){
                row.find('.selling_price').val(parseFloat(response.price).toFixed(2));
                calculateRowTotal(row); 
                countTotalAmount(); 
            } else {
                row.find('.selling_price').val('0.00');
            }
        },
        error: function(){
            row.find('.selling_price').val('0.00');
        }
    });
}



    // ----- CALCULATE ROW TOTAL -----
    function calculateRowTotal(row){
        let qty = parseFloat(row.find('.quantity').val()) || 0;
        let price = parseFloat(row.find('.selling_price').val()) || 0;
        row.find('.total_price').val((qty * price).toFixed(2));
    }

    // ----- UPDATE TOTAL AMOUNT -----
    function countTotalAmount(){
        let totalAmount = 0.00;
        $('.total_price').each(function(){
            totalAmount += parseFloat($(this).val()) || 0;
        });
        originalTotal = totalAmount;
        applyDiscount();
    }

    // ----- APPLY DISCOUNT -----
    function applyDiscount() {
        let discount = parseFloat($('#discount').val()) || 0;
        let finalTotal = originalTotal - discount;
        if (finalTotal < 0) finalTotal = 0;
        $('#total_amount').val(finalTotal.toFixed(2));
    }

    $('#discount').on('keyup change', function() {
        applyDiscount();
    });

    // ----- ADD NEW PRODUCT ROW -----
    $('#add_row').click(function(){
        let newRow = $('.product-row:first').clone();
        newRow.find('input').val('');
        newRow.find('.search_result').html('');
        $('#product_rows_container').append(newRow);
        countTotalAmount();
    });

    // ----- REMOVE PRODUCT ROW -----
    $(document).on('click','.remove-row',function(){
        if($('.product-row').length > 1){
            $(this).closest('.product-row').remove();
            countTotalAmount();
        } else {
            alert('At least one product row is required.');
        }
    });

    // ----- PRODUCT TOTAL ON QUANTITY OR PRICE CHANGE -----
    $(document).on('keyup change', '.quantity, .selling_price', function(){
        let row = $(this).closest('.product-row');
        calculateRowTotal(row);
        countTotalAmount();
    });

    // ----- CUSTOMER SEARCH -----
    $('#customer_phone').on('keyup change', function(){
        let phone = $(this).val().trim();
        if(phone.length >= 11){
            $.ajax({
                type: "GET",
                url: "{{route('customers.search')}}",
                data: {phoneNumber: phone},
                dataType: "json",
                success: function (response) {
                    if(response.status) {
                        $('#customer_name').val(response.data.customer_name);
                        $('#customer_email').val(response.data.customer_email);
                        $('#customer_id').val(response.data.id);
                    }
                }
            });
        } else {
            $('#customer_name').val('');
            $('#customer_email').val('');
        }
    });

    // ----- PRODUCT SEARCH + KEYBOARD NAVIGATION -----
    $(document).on('keydown', '.product_name', function(e){
        if(e.key === "Enter") e.preventDefault(); // prevent form submit
    });

    $(document).on('keyup', '.product_name', function(e){
        let query = $(this).val();
        let row = $(this).closest('.product-row');
        let resultContainer = row.find('.search_result');
        let items = resultContainer.find('.list-group-item');

        // Keyboard navigation
        if(e.key === "ArrowDown") {
            currentFocus++;
            addActive(items);
        } else if(e.key === "ArrowUp") {
            currentFocus--;
            addActive(items);
        } else if(e.key === "Enter") {
            if(currentFocus > -1 && items.length){
                $(items[currentFocus]).trigger('click');
            }
        } else {
            // Fetch results on typing
            if(query.length >= 2){
                $.ajax({
                    url: "{{route('products.search')}}",
                    type: 'GET',
                    data: { term: query },
                    dataType: 'json',
                    success: function(response){
                        resultContainer.html(response.html);
                        currentFocus = -1; // reset navigation
                    },
                    error: function(xhr){
                        resultContainer.html('<div class="text-danger">Error loading products</div>');
                    }
                });
            } else {
                resultContainer.html('');
            }
        }
    });

    // ----- CLICK TO SELECT PRODUCT -----
    $(document).on('click', '.search_result .list-group-item', function(e){
        e.preventDefault();
        let row = $(this).closest('.product-row');
        row.find('.product_name').val($(this).data('name'));
        row.find('.product_id').val($(this).data('id'));
        row.find('.selling_price').val($(this).data('price')); // auto-fill price if available
        row.find('.search_result').html('');
        price_perunit(row);
        calculateRowTotal(row);
        countTotalAmount();
    });

    // ----- HIGHLIGHT ACTIVE ITEM -----
    function addActive(items){
        if(!items) return false;
        items.removeClass('active');
        if(currentFocus >= items.length) currentFocus = 0;
        if(currentFocus < 0) currentFocus = items.length - 1;
        $(items[currentFocus]).addClass('active');
    }

    // ----- CLOSE DROPDOWN WHEN CLICK OUTSIDE -----
    $(document).on('click', function(e){
        if(!$(e.target).closest('.product-row').length){
            $('.search_result').html('');
        }
    });

    // ----- INITIALIZE TOTAL -----
    countTotalAmount();






});
</script>

@endsection