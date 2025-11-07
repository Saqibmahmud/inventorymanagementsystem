@php
    use Rmunate\Utilities\SpellNumber;

@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase View</title>
    <style>
        @page {
           
        }
        body {
            font-family: Arial, sans-serif;
            font-size: large;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #444;
            padding: 6px 10px;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
        }
        h3 {
            text-align: center;
            margin-bottom: 20px;
            font-size: x-large;
            text-decoration: underline;
        }
   
        img {
            display: block;
            margin: 0 auto 10px; /* top 0, bottom 10px, centered horizontally */
            width: 600px;
            height: auto;
            height: 300px;
        }
        
        /* Sticky navigation buttons */
        .sticky-nav {
            position: fixed;
            top: 20px;
            right: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            z-index: 1000;
        }
        
        .nav-button {
            height: 60px;
            width: 100px;
            border-radius: 20px;
            background-color: #4a90e2;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
            text-align: center;
        }
        
        .nav-button:hover {
            background-color: #357ae8;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
        }
        
        #print {
            background-color: #4CAF50;
        }
        
        #home {
            background-color: #2196F3;
        }
        
        #edit {
            background-color: #FF9800;
        }
         #cancel {
            background-color: red;
        }
        
        
       
.detail{
    display: flex;
    justify-content: space-between;
}
.w_1{
width: 50%;
}

.text-sm{
font-size:15px;
}
.text-center{
    text-align:center;
}

    </style>
</head>
<body>
    <!-- Sticky Navigation Buttons -->
    <div class="sticky-nav">
        <div id="print" class="nav-button">Print</div>
        <div id="home" class="nav-button">Home</div>
        <div id="edit" class="nav-button">Edit</div>
       
    </div>

    <div class="container w-1/60 mx-auto mt-5 p-4 border">
        <img src="{{ asset('assets\dist\img\Saqib_al_mahmud.png') }}"> 
        <p class="text-center text-sm"><strong>Supplier:</strong> {{ $purchase->supplier->supplier_name ?? 'N/A' }}</p>
        <p class="text-center text-sm"><strong>Supplier address:</strong> {{ $purchase->supplier->address ?? 'N/A' }}</p>
             <p class='text-center text-sm'><strong>Branch Name</strong> {{$purchase->branches->name}}</p>
        <p class='text-center text-sm'><strong> Address</strong>  {{$purchase->branches->location}}</p>

        <hr>

        <h3>Purchase Order Invoice</h3>
        <div class="detail">
<div class="w_1">
        <p><strong>Purchase ID:</strong> {{ $purchase->id }}</p>
        <p><strong>Purchase Date:</strong> {{ $purchase->purchase_date }}</p>
        <p><strong>Created By:</strong> {{ $purchase->user->name ?? 'N/A' }}</p>
         <p><strong>Updated By:</strong> {{ $purchase->updated_user->name ?? 'N/A' }}</p>
        
</div>
<div class="w-1">
        <p><strong>Status:</strong> {{ $purchase->status }}</p>
          <p><strong>Invoice generated at:</strong> {{ $purchase->updated_at }}</p>
          <p><strong>Payment Method:</strong> {{ $purchase->paid_with }}</p>

    
</div>


</div>
        <table>
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>Product</th>
                    <th>QTY</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                      <th>Received QTY</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchase->purchase_items as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->product->product_name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->purchase_price, 2) }}</td>
                        <td>{{ number_format($item->total_price, 2) }}</td>
                                <td>{{ $item->received_quantity}}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5" style="text-align:right">Grand Total:</th>
                    <th>{{ number_format($purchase->total_amount, 2) }}</th>
                </tr>
                <tr>   
                    <th>In Words</th>
                    <td colspan="5">{{ SpellNumber::value((int)$purchase->total_amount)->toLetters() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
     <br><br><br>
 
        <p class='text-center text-sm'>Saqib Al Mahmud<p>
       <p class='text-center text-sm'> PO Invoice of Sales Managemnet System </p>
       <p class='text-center text-sm'> {{$purchase->branches->name}}</p>
        <p class='text-center text-sm'> {{$purchase->branches->location}}</p>
    </body>
   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
$('#print').click(function(){
$('#print').hide();
$('#home').hide();
$('#edit').hide();
window.print();
});

$('#home').click(function(){

window.location.href="{{route('purchases.index')}}"

});
$('#edit').click(function(){

window.location.href="{{route('purchases.edit',['purchase'=>$purchase->id])}}"

})
        });





    </script>

</html>