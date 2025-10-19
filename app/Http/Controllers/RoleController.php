<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreRolesRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class RoleController extends Controller //implements HasMiddleware
{
//    public static function middleware(): array
// {
//     return [
//         new Middleware('permission:View-Role', only: ['index', 'show']),
//         new Middleware('permission:Add-Role', only: ['create']),
//         new Middleware('permission:Edit-Role', only: ['edit']),
//         new Middleware('permission:Delete-Role', only: ['destroy'])
//     ];
// }  

    public function index()
    {
      
        $allRoles=Role::paginate(5);
        return view('Roles.index',['data'=>$allRoles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $allPermission= Permission::all();
    return view('Roles.create',compact('allPermission'));   
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store( StoreRolesRequest $request)
    {
    Role::create(['name'=>$request->name])->givePermissionTo($request->permissions);
return redirect()->route('roles.index')->with('success','Role created successfully');

    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    public function edit(string $id)
    {
      if($id){
        $data= Role::where('id',$id)->first();
        $allPermission= Permission::all();
        $hasPermission =$data->permissions->pluck('name');
        return view('Roles.create',compact('data','allPermission','hasPermission'));

      }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, string $id)
    { if($id){
        $role= Role::find($id);
      $role->name=  $request->name ;
      $role->SyncPermissions($request->permissions)  ;
      $role->save();
      return redirect()->route('roles.index')->with('success',"Role  Updated Succesfully") ;
    }
    return redirect()->route('roles.index')->with('error',"An error occured");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {  $role=Role::find($id) ;
        if(!$role){
             session()->flash('error',"No Role Found");
            return response()->json([
'status'=> false,
"message"=> "No Role Found"
            ]) ;
        }
        $role->delete();

    return  response()->json([
'status'=>true,
'message'=>'Succesfully Delleted Role'
    ]);
    }
    public function show(string $id)
    {
        //
    }
}
