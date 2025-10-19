<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    //
    public function Index(){
 $allBrands=Brands::paginate(5)->withQueryString();;


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
    public function Edit($brand){
    if(!$brand){
    return redirect()->route('brands.index')->with('error','Something Went Wrong');
    }

    $data= Brands::where('id',$brand)->first();   
   
    if(!$data){
    return redirect()->route('brands.index')->with('error','Brand Not Found');
    }
    return view("brands.edit",['data'=>$data]);

    }

    public function Update(Request $request, $brand){
    $request->validate(
        ['brand_name'=> 'required',
        'brand_code'=>'required',
        'status'=>'required']
    ) ;
    $data=Brands::where('id',$brand)->first() ;
    if($data){
    $data->update([
        'brand_name'=>$request->input('brand_name'),
        'brand_code'=>$request->input('brand_code'),
        'status'=>$request->input('status')
    ]);
    return redirect()->route('brands.index')->with('update_success','Brand Updated Successfully');
}

    }
    public function Destroy($brand){
  $brand=Brands::where('id',$brand)->first() ;
  $brand->delete() ;
    return redirect()->route('brands.index')->with('delete_success','Brand Deleted Successfully') ;

    }

    public function Search(Request $request){
    $query= $request->input('query') ;
    $brands= Brands::where('brand_name','LIKE',"%{$query}%")
                   ->orWhere('brand_code','LIKE',"%{$query}%")
                ->paginate(5);
                
    return view('brands.index',['data'=>$brands]) ;
                   
                   

    }

}
