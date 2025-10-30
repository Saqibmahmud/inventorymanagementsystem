<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Brands;
use App\Models\Product_Categories;
use App\Models\Products;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(){
        $allProducts=Products::with('product_categories','brands','supplier')->paginate(10);
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
    $new_product->save();
    return redirect()->route('products.index')->with('success','Product Created Successfully');
        
    }
    public function edit($product){
        $existing_prod= Products::where('id',$product)->first();
        $allBrand= Brands::where('status',1)->get();
        $allCategories=Product_Categories::where('status',1)->get();   
         $suppliers =Supplier::get();   
        return view('Products.create_edit',['data'=>$existing_prod,'allBrands'=>$allBrand,'allCategories'=>$allCategories,'suppliers'=>$suppliers]);
    }
    public function update( UpdateProductRequest $request,$product){
       $existing_product= Products::where('id',$product)->first();
       $existing_product->product_name= $request->input('product_name');
       $existing_product->sku= $request->input('sku');
       $existing_product->brands_id= $request->input('brands_id');
       $existing_product->product_categories_id= $request->input('product_categories_id');
       $existing_product->description= $request->input('description');
       $existing_product->price= $request->input('price');
    //    $existing_product->stock_quantity= $request->input('stock_quantity');
       $existing_product->reorder_level= $request->input('reorder_level');
       $existing_product->save();
       return redirect()->route('products.index')->with('success','Product Updated Successfully');
        
    }
    public function destroy(){
        
    }
  public function search(Request $request)
  {
    $term = $request->input('term');
    $supplier_id=$request->input('supplier_id');

    if(isset($term) && isset($supplier_id)){
        $Searchproducts = Products::where('product_name', 'LIKE', "%{$term}%")
                               ->where('supplier_id',$supplier_id)->get();
    $html=view('Products.load_search_data',['searched_products'=>$Searchproducts])->render();
    return response()->json(['html'=>$html]);
  }
  elseif(isset($supplier_id) && !isset($term)){

$Searchproducts=Products::where('supplier_id',$supplier_id)->get();
return response()->json($Searchproducts) ;

  }
  return response()->json([
    'status'=>false,
    'message'=>"Error occured!Products could not be found"
  ]);
      
}
}
