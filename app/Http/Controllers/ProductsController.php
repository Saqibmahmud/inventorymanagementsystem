<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Brands;
use App\Models\Product_Categories;
use App\Models\Products;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class ProductsController extends Controller 
{
  public function __construct() {
    $this->middleware('permission:View-Product')->only(['index']);
    $this->middleware('permission:Add-Product')->only(['create','store']);
    $this->middleware('permission:Edit-Product')->only(['edit','update']);
    $this->middleware('permission:Delete-Product')->only(['destroy']);
  }
    public function index(){
      $user= Auth::user();
        $allProducts=Products::where('branch_id',$user->branch_id)->with('product_categories','brands','supplier')->paginate(10);
return view('products.index',['data'=>$allProducts]);
    }
    public function create(){
        $allCategories= Product_Categories::where('status',1)->get();
        $allBrands=Brands::where('status',1)->get();
        $suppliers =Supplier::get();
        $data=null;
        return view('Products.create_edit',compact('allCategories','allBrands','data','suppliers'));
        
    }
    public function store(StoreProductRequest $request){
  $user=Auth::user();
    $new_product = new Products();
     $new_product->supplier_id= $request->input('supplier_id');
    $new_product->product_name= $request->input('product_name');
    $new_product->sku= $request->input('sku');
    $new_product->brands_id= $request->input('brands_id');
    $new_product->product_categories_id= $request->input('product_categories_id');
    $new_product->description= $request->input('description');
    $new_product->price= $request->input('price');
    // $new_product->stock_quantity= $request->input('stock_quantity');
    $new_product->reorder_level= $request->input('reorder_level');
    $new_product->branch_id=$user->branch_id;
    $new_product->save();
    return redirect()->route('products.index')->with('success','Product Created Successfully');
        
    }
    public function edit($product){
      $user=Auth::user();
        $existing_prod= Products::where('id',$product)
                                  ->where('branch_id',$user->branch_id)->first();
        $allBrand= Brands::where('status',1)->get();
        $allCategories=Product_Categories::where('status',1)->get();   
         $suppliers =Supplier::get();   
        return view('Products.create_edit',['data'=>$existing_prod,'allBrands'=>$allBrand,'allCategories'=>$allCategories,'suppliers'=>$suppliers]);
    }
    public function update( UpdateProductRequest $request,$product){
      $user=Auth::user();
       $existing_product= Products::where('id',$product)->first();
       $existing_product->product_name= $request->input('product_name');
       $existing_product->sku= $request->input('sku');
       $existing_product->brands_id= $request->input('brands_id');
       $existing_product->product_categories_id= $request->input('product_categories_id');
       $existing_product->description= $request->input('description');
       $existing_product->price= $request->input('price');
    //    $existing_product->stock_quantity= $request->input('stock_quantity');
       $existing_product->reorder_level= $request->input('reorder_level');
       $existing_product->branch_id = $user->branch_id;
       $existing_product->save();
       return redirect()->route('products.index')->with('success','Product Updated Successfully');
        
    }
    public function destroy(){
        
    }

  public function search(Request $request)
{
$user=Auth::user();
$term = $request->input('term');

if(!$request->ajax()){
// $user=Auth::user();
// $term = $request->input('term');
$Searchproducts = Products::where(function($query) use ($term){
$query->where('product_name','LIKE',"%{$term}%")
->orwhere('sku','LIKE',"%{$term}%");
})
->where('branch_id',$user->branch_id)
->paginate(10);

return view('Products.index',['data'=>$Searchproducts]);

  }

  // $user=Auth::user();
  // $term = $request->input('term');
  $supplier_id=$request->input('supplier_id');

  if(isset($term) && isset($supplier_id)){
      $Searchproducts = Products::where('product_name', 'LIKE', "%{$term}%")
                              ->where('supplier_id',$supplier_id)
                              ->where('branch_id',$user->branch_id)
                              ->get();
  $html=view('Products.load_search_data',['searched_products'=>$Searchproducts])->render();
  return response()->json(['html'=>$html]);
}
elseif(isset($supplier_id) && !isset($term)){

$Searchproducts=Products::where('supplier_id',$supplier_id)->where('branch_id',$user->branch_id)->get();
return response()->json($Searchproducts) ;

}
elseif(isset($term) && !isset($supplier_id)){
  
 
$Searchproducts=Products::where('branch_id',$user->branch_id)->where('product_name', 'LIKE', "%{$term}%")->get();
$html=view('Products.load_search_data',['searched_products'=>$Searchproducts])->render();
 return response()->json(['html'=>$html]);

}
return response()->json([
  'status'=>false,
  'message'=>"Error occured!Products could not be found"
]);
    
}

public function productPriceByName(Request $request){
  $user=Auth::user();
$product_name=$request->input('name');
$productPrice=Products::where('branch_id',$user->branch_id)->where('product_name', $product_name)->select('price')->first();
return response()->json([
'status'=>true,
'price'=>$productPrice->price
]);


}





}
