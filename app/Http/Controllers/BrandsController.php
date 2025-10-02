<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    //
    public function Index(){
$allBrands=Brands::all();
return view('brands.index',['data'=>$allBrands]);
        
    } 
    public function Create(){
        return view('brands.create');
    }

    public function Store(Request $request){
       
        $request->validate([
            'brand_name'=>'required',
            'brand_code'=>'required',
            'status'=>'required'
        ]);
        $brands= new Brands() ;
        $brands->brand_name=$request->input('brand_name');
        $brands->brand_code = $request->input('brand_code');
    $brands->status = $request->input('status');

    $brands->save();
    return redirect()->route('brands.index')->with('success','Brand Added Successfully') ;

    }

    // public function Show($id){
    //     return "Brands Show".$id;
    // }
    public function Edit($id){}
    public function Update(Request $request, $id){}
    public function Destroy($id){}

}
