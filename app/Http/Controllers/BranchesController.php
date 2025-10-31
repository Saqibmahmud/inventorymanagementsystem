<?php

namespace App\Http\Controllers;

use App\Models\Branches;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class BranchesController extends Controller 
{
     public function __construct() {
    $this->middleware('permission:View-Branch')->only(['index']);
    $this->middleware('permission:Add-Branch')->only(['create','store']);
    $this->middleware('permission:Edit-Branch')->only(['edit','update']);
    $this->middleware('permission:Delete-Branch')->only(['destroy']);
  }
    public function index(){
$branches= Branches::orderBy('id','DESC')->paginate(10);
return view('Branches.index',compact('branches'));
    }

    public function create(){
        return view('Branches.create_edit');
    }
public function store(Request $request){
   
  $validated_data=  $request->validate([
'name'=>'required',
'location'=>'required'
    ]);
    if($validated_data){
Branches::create($validated_data);
return redirect()->route('branches.index')->with('success',"Branch created succesfully");
    }
    return redirect()->route('branches.index')->with('error',"Branch could not be created");
}
public function edit($branch){
    $existing_branch=Branches::where('id',$branch)->first();
    return view('Branches.create_edit',['data'=>$existing_branch]);
}
public function update(Request $request,$branch){
    $validated_data =$request->validate([
'name'=>'required',
'location'=>'required'
    ]);
$existing_branch= Branches::where('id',$branch)->first();
if(!$existing_branch){
    return redirect()->route('branches.index')->with('error',"Branch could not be found");
}
$existing_branch->update($validated_data);
return redirect()->route('branches.index')->with('success',"Branch Updated Succesfully");

}
public function destroy($branch){
    $existing_branch= Branches::where('id',$branch)->first();
    if(!$existing_branch){
        session()->flash('error',"branch Not found");
        return response()->json([
'status'=>false,
'message'=>"branch not found"
        ]);
    }
    $existing_branch->delete();
    session()->flash('success','Branch Deleted Succesfully');
return response()->json([
'status'=>true,
'message'=>"Branch Deleted Succesfully"
]);
}

}
