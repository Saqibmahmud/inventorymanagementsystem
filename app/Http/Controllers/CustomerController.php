<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomeRequest;
use Illuminate\Routing\Controllers\HasMiddleware;

class CustomerController extends Controller 
{
  public function __construct()
    {
        $this->middleware('permission:View-Customer')->only(['index', 'show']);
        $this->middleware('permission:Add-Customer')->only(['create', 'store']);
        $this->middleware('permission:Edit-Customer')->only(['edit', 'update']);
        $this->middleware('permission:Delete-Customer')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request )
    {$allCustomers=Customer::orderBy('id','DESC')->paginate(10);
        if($request->ajax()){
            $html= view('Customers.load_data',['customers'=>$allCustomers])->render();
            return response()->json(['html'=>$html]);
        }
        return view('Customers.index',['customers'=>$allCustomers]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('Customers.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        $customer= new Customer();
        $customer->customer_name= $request->customer_name;
        $customer->customer_phone= $request->customer_phone ;
        $customer->customer_email = $request->customer_email;
        $customer->save();
        return redirect()->route('customers.index')->with('success',"Customer Created Successfully");
    }

    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer=Customer::where('id',$id)->first();
        if(!$customer){
            return redirect()->route('customers.index')->with('error',"Customer not found");
        }
        return view('Customers.create_edit',['data'=>$customer]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomeRequest $request, string $id)
    {$customer=Customer::where('id',$id)->first();
        if(!$customer){
            return redirect()->route('customers.index')->with('error',"Customer not found");
        }
        $customer->customer_name=$request->customer_name;
        $customer->customer_email=$request->customer_email;
        $customer->customer_phone=$request->customer_phone;
        $customer->save();
        return redirect()->route('customers.index')->with('success',"customer details updated succesfully");
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer=$customer=Customer::where('id',$id)->first();
        if(!$customer){
            session()->flash('error',"Customer not found");
            return response()->json([
                'status'=> false,
                'message'=>"Customer not found"
            ]);
        }
        session()->flash('success',"Cutomer Deleted Successfully");
        return response()->json([
   'status'=>true,
   'message'=>"Cutomer Deleted Succesfully"
        ]);
    }

public function search(Request $request ){
$phoneNumber= $request->input('phoneNumber');
$customers=Customer::where('customer_phone', 'like', $phoneNumber . '%')->first();  //'customer_phone', 'like', $phoneNumber . '%'
if(!$customers){
    return response()->json([
'status'=>false,
'message'=>'No customer found! '
    ]);
} 
        
 return response()->json([
    'status'=>true ,
    'data'=>$customers
 ]);        

}






}
