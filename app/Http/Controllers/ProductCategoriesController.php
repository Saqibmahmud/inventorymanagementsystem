<?php

namespace App\Http\Controllers;

use App\Models\Product_Categories;
use Illuminate\Http\Request;


class ProductCategoriesController extends Controller
{
    public function Index(){
        $allCategories =Product_Categories::paginate(5)->withQueryString();
        return view('productcategories.index',['data'=>$allCategories]);
    }

    public function Create(){
        return view('productcategories.create');
        
    }
    public function Store(Request $request){
        $request->validate([
            'product_category_name'=>'required',
            'product_category_code'=>'required',
            'status'=>'required'
        ]);
        $category= new Product_Categories();
        $category->product_category_name=$request->input('product_category_name');
        $category->product_category_code=$request->input('product_category_code');
        $category->status=$request->input('status');
        $category->save();
        return redirect()->route('categories.index')->with('success','Product Categorry Succesful created');
    }
    public function Edit($category){
        $selected_category=Product_Categories::Where('id',$category)->first();
        if(!$category){
            return redirect()->route('categories.index')->with('error','Category not found');
        }
        return view('productcategories.edit',['data'=>$selected_category]);
    }
    public function Update(Request $request ,$category){
        $selected_category=Product_Categories::where('id',$category)->first();
        if(!$selected_category){
            return redirect()->route('categories.index')->with('error','Category not found');
        }

        $selected_category->update($request->all());
        return redirect()->route('categories.index')->with('success','Category updated successfully');

    }


     



public function Search(Request $request){
$query= $request->input('query');
$categories= Product_Categories::Where('product_category_name','LIKE',"%{$query}%")
                                 ->orWhere('product_category_code','LIKE',"%{$query}%")
                                 ->paginate(5) ;
return view('productcategories.index',['data'=>$categories]);


}

}
