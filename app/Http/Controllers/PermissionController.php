<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermissionRequest;
use Illuminate\Auth\Events\Validated;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware ;

use Illuminate\Http\Request;

class PermissionController extends Controller 
{

public function index(Request $request) {
    $permissions = Permission::orderBy('id','DESC')->paginate(10);

    if ($request->ajax()) {
        $html = view('Permissions.load_data', ['permissions' => $permissions])->render();
        return response()->json(['html' => $html]);
    }

    return view('Permissions.index', ['permissions' => $permissions]);
}


public function create(){
   return view('Permissions.create');
}
public function store(StorePermissionRequest $request){
 Permission::create([
'name'=> $request->name
 ] );
 return redirect()->route('permissions.index')->with('success',"Permission created successfully");
  
}
public function edit($id){
$permission =Permission::find($id);
return view('Permissions.create',['data'=>$permission]);
}
public function update(Request $request,$id){
   $permission=Permission::find($id);
   $permission->name=$request->name;
   $permission->save();
   return redirect()->route('permissions.index')->with('success',"Permission updated successfully");

}
public function destroy($id){
   $permission=Permission::find($id);
   if(!$permission){
     session()->flash('error','Permission not found');
     return response()->json([
      'status'=> false,
      'message'=>"Permission Not Found"
     ]);
   }
   $permission->delete();
   session()->flash('success','Permisssion Deleted Succesfully') ;
   return response()->json([
      'status'=> true,
      'message'=>"Permission Deleted Successfully"
   ]);

}

public function search(Request $request){
   $query = $request->input('query');
   $permissions = Permission::where('name','LIKE', "%$query%")->paginate(10);

   return view('Permissions.index', compact('permissions'));
}






}
