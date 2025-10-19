<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermissionRequest;
use Illuminate\Auth\Events\Validated;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware ;

use Illuminate\Http\Request;

class PermissionController extends Controller //implements HasMiddleware
{
//  public static function middleware(): array
// {
//     return [
//         new Middleware('permission:View-Permission', only: ['index']),
//         new Middleware('permission:Create-Permission', only: ['create','store']),
//         new Middleware('permission:Edit-Permission', only: ['edit','update']),
//         new Middleware('permission:Delete-Permission', only: ['destroy'])
//     ];
// }
    public function index(){
$allPermissions= Permission::orderBy('id','DESC')->paginate(10);
return view('Permissions.index', ['data'=>$allPermissions]);
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





}
