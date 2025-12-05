<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreSaleRequest;
use App\Models\Products;
use App\Models\Sales_item;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
   public function __construct() {
    $this->middleware('permission:View-Sale')->only(['index','show']);
    $this->middleware('permission:Add-Sale')->only(['create','update']);
    $this->middleware('permission:Edit-Purchase')->only(['edit','update']);
    $this->middleware('permission:Delete-Purchase')->only(['destroy']);
   }
    public function index(Request $request)
    {
         $user= Auth::user();
       
   $status_filter=$request->input('status');
   $pendingSales=Sales::with(['customer','user','updating_user'])->where('branch_id',$user->branch_id)->where('status',Sales::SALES_PENDING_STATUS)->paginate(10);
    $completeSales=Sales::with(['customer','user','updating_user'])->where('branch_id',$user->branch_id)->where('status',Sales::SALES_COMPLETE_STATUS)->paginate(10);
    $cancelledSales=Sales::with(['customer','user','updating_user'])->where('branch_id',$user->branch_id)->where('status',Sales::SALES_CANCELLED_STATUS)->paginate(10);
      
if($status_filter==Sales::SALES_PENDING_STATUS){
    $sales=$pendingSales;
}
elseif($status_filter==Sales::SALES_COMPLETE_STATUS){
    $sales= $completeSales;
}

elseif($status_filter==Sales::SALES_CANCELLED_STATUS){
    $sales=$cancelledSales;
}
else{
    $sales= $pendingSales;
}
if($request->ajax()){
    $html=view('sales.load_data',compact('sales'))->render();
return response()->json([
    'html'=>$html,
    'hasMore'=> $sales->hasmorePages()]);
    }
return view('sales.index',compact('sales'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Sales.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request)
    { 
    $user=AUth::user();
    $sale= new Sales();
    DB::beginTransaction();
try{
    $sale->customer_id=$request->customer_id;
    $sale->sale_date=now();
    $sale->total_amount=$request->total_amount;
    $sale->status=Sales::SALES_COMPLETE_STATUS;
    $sale->paid_with =$request->paid_with;
    $sale->discount=$request->discount;
    $sale->created_by= $user->id;
    $sale->branch_id= $user->branch_id;
    $sale->save();

    $product_ids=$request->input('product_id');
    $quantities=$request->input('quantity');
    $selling_prices=$request->input('selling_price');
    $total_prices=$request->input('total_price');

    foreach($product_ids as $key=>$product_id){
        Sales_item::create([
'sale_id'=>$sale->id ,
'product_id'=>$product_id,
'quantity'=>$quantities[$key],
'selling_price'=>$selling_prices[$key],
'total_price'=>$total_prices[$key]
        ]);
    
   if($sale->status == Sales::SALES_COMPLETE_STATUS){
    $product= Products::where('branch_id',$user->branch_id)->where('id',$product_id)->first();
    $product->stock_quantity -= (float)$quantities[$key]?? 0;
    $product->save();
   } 
    
    
    
    
    
    
    }

}
catch(\Exception $err){

}


       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
