<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use Illuminate\Routing\Controllers\HasMiddleware;

class SupplierController extends Controller 
{
   public function __construct() {
    $this->middleware('permission:View-Supplier')->only(['index']);
    $this->middleware('permission:Add-Supplier')->only(['create','store']);
    $this->middleware('permission:Edit-Supplier')->only(['edit','update']);
    $this->middleware('permission:Delete-Supplier')->only(['destroy']);
  }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $allSuppliers=Supplier::orderBy('id','DESC')->paginate(10);
        if($request->ajax()){
            $html= view('Suppliers.load_data',['suppliers'=>$allSuppliers])->render();
            return response()->json(['html'=>$html]);
        }
        return view('Suppliers.index',['suppliers'=>$allSuppliers]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suppliers.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupplierRequest $request)
    {
         $supplier= new Supplier();
        $supplier->supplier_name= $request->supplier_name;
        $supplier->contact_name=$request->contact_name;
        $supplier->phone= $request->phone ;
        $supplier->email = $request->email ;
        $supplier->address= $request->address ;
        $supplier->save();
        return redirect()->route('suppliers.index')->with('success',"Supplier Created Successfully");
    }

   
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $supplier=Supplier::where('id',$id)->first();
        if(!$supplier){
            return redirect()->route('suppliers.index')->with('error',"Supplier not found");
        }
        return view('Suppliers.create_edit',['data'=>$supplier]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplierRequest $request, string $id)
    {
        $supplier=Supplier::where('id',$id)->first();
        if(!$supplier){
            return redirect()->route('suppliers.index')->with('error',"Supplier not found");
        }
        $supplier->supplier_name= $request->supplier_name;
        $supplier->contact_name=$request->contact_name;
        $supplier->phone= $request->phone ;
        $supplier->email = $request->email;
        $supplier->address= $request->address ;
        $supplier->save();
        return redirect()->route('suppliers.index')->with('success',"Supplier details updated succesfully");
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier=Supplier::where('id',$id)->first();
        if(!$supplier){
            session()->flash('error',"Supplier not found");
            return response()->json([
                'status'=> false,
                'message'=>"Supplier not found"
            ]);
        }
        session()->flash('success',"Supplier Deleted Successfully");
        return response()->json([
   'status'=>true,
   'message'=>"Supplier Deleted Succesfully"
        ]);
    }
}
