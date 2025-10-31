<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchasesRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Models\Purchases;
use App\Models\Products;
use App\Models\Purchases_Items;
use App\Models\Stock_Transactions;
use App\Models\Supplier ;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\DB;

class PurchasesController extends Controller 
{
    public function __construct() {
    $this->middleware('permission:View-Purchase')->only(['index']);
    $this->middleware('permission:Add-Purchase')->only(['create','store']);
    $this->middleware('permission:Edit-Purchase')->only(['edit','update']);
    $this->middleware('permission:Delete-Purchase')->only(['destroy']);
  }
    public function index(Request $request){
       
        $status_filter=$request->input('status');
     
   $pendingPurchases=Purchases::with(['supplier','user','updated_user'])->where('status',Purchases::STATUS_PENDING)->paginate(5);
     $completePurchases=Purchases::with(['supplier','user','updated_user'])->where('status',Purchases::STATUS_COMPLETE)->paginate(10);
     $partiallyReceivedPurchases=Purchases::with(['supplier','user','updated_user'])->where('status',Purchases::STATUS_PARTIALLY_RECEIVED)->paginate(10);
    $cancelledPurchases=Purchases::with(['supplier','user','updated_user'])->where('status',Purchases::STATUS_CANCELLED)->paginate(10);
      
if($status_filter==Purchases::STATUS_PENDING){
    $purchases=$pendingPurchases;
}
elseif($status_filter==Purchases::STATUS_COMPLETE){
    $purchases=$completePurchases;
}
elseif($status_filter==Purchases::STATUS_PARTIALLY_RECEIVED){
    $purchases=$partiallyReceivedPurchases;
}
elseif($status_filter==Purchases::STATUS_CANCELLED){
    $purchases=$cancelledPurchases;
}
else{
    $purchases=$pendingPurchases;
}
if($request->ajax()){
    $html=view('purchases.load_data',['purchases'=>$purchases])->render();
return response()->json([
    'html'=>$html,
    'hasMore'=> $purchases->hasmorePages()]);
    }
return view('purchases.index',['purchases'=>$purchases]);

}


public function create(){
        $products=Products::all();
        $suppliers=Supplier::all();

        return view('purchases.create',['products'=>$products,'suppliers'=>$suppliers]);
    }

    public function store(StorePurchasesRequest $request){
   
    DB::beginTransaction();
    try{
   $user = Auth::user();
     $new_purchase= new Purchases();
     $new_purchase->supplier_id=$request->input('supplier_id');
     $new_purchase->purchase_date=now();
     $new_purchase->total_amount=$request->input('total_amount');
    //  $new_purchase->status= $request->input('status');
     $new_purchase->created_by= $user->id;
        $new_purchase->paid_with=$request->input('paid_with');;
     $new_purchase->save();
$product_ids=$request->input('product_id');
$quantities=$request->input('quantity');
$purchase_prices=$request->input('purchase_price');
$total_prices=$request->input('total_price');

foreach($product_ids as $key=> $product_id){
Purchases_Items::create([
'purchase_id'=>$new_purchase->id,
'product_id'=>$product_id,
'quantity'=>$quantities[$key],
'purchase_price'=>$purchase_prices[$key],
'total_price'=>$total_prices[$key]

]) ;

}
DB::commit();
    }
    catch(\Exception $e){
        DB::rollback() ;
    }
return redirect()->route('purchases.show',['purchase'=>$new_purchase->id ]);
//return view('purchases.view',['purchase'=>$new_purchase]);
     //return  redirect()->route('purchases.index')->with('success','Purchase Created Successfully');
    }

public function show($purchase){
    $purchase=Purchases::with(['supplier','user','updated_user','purchase_items.product'])->where('id',$purchase)->first();
    return view('purchases.view',['purchase'=>$purchase]);

}

public function edit($purchase){
    $existing_purchase= Purchases::with(['supplier','purchase_items.product'])->where('id',$purchase)->first();
    $all_products =Products::all();
    $all_suppliers=Supplier::all();
    return  view('purchases.edit',['suppliers' => $all_suppliers,'products'=>$all_products,'data'=>$existing_purchase]);
}

public function update(UpdatePurchaseRequest $request,$purchase){
    
    
    $exist_purchase= Purchases::with(['supplier','updated_user','purchase_items.product'])->where('id',$purchase)->first() ;
   
  DB::beginTransaction();
  try{
     $user= Auth::user();
     
$exist_purchase->supplier_id= $request->input('supplier_id');
$exist_purchase->total_amount=$request->input('total_amount');
$exist_purchase->status= $request->input('status');

$exist_purchase->updated_by= $user->id;
 $exist_purchase->paid_with=$request->input('paid_with');
  $exist_purchase->save();

  $product_ids=$request->input('product_id');
$quantities=$request->input('quantity');
$received_quantities=$request->input('received_quantity');
$purchase_prices=$request->input('purchase_price');
$total_prices=$request->input('total_price');

 Purchases_Items::where('purchase_id', $exist_purchase->id)->delete();

foreach($product_ids as $key=>$product_id){
Purchases_Items::create([
    'purchase_id'=>$exist_purchase->id,
'product_id'=>$product_id,
'quantity'=>$quantities[$key],
'purchase_price'=>$purchase_prices[$key],
'total_price'=>$total_prices[$key],
'received_quantity'=>$received_quantities[$key]
]);
$product=Products::find($product_id);
if($product){
$product->stock_quantity += $received_quantities[$key];
$product->save();
}
$type=Stock_Transactions::TRANSACTION_TYPE_PURCHASE;
Stock_Transactions::create([
'product_id'=>$product_id,
'transaction_type'=>$type,
'quantity'=>$quantities[$key],
'transaction_date'=>now(),
'reference_id'=>$exist_purchase->id,
'reference_type'=>Purchases::class
]);
}

DB::commit();

  }
  catch(\Exception $err){
DB::rollBack();
return redirect()->back()->with('error', 'Failed to save purchase: ' . $err->getMessage());
  }
    
return redirect()->route('purchases.show',['purchase'=>$exist_purchase->id ]);


}






}
