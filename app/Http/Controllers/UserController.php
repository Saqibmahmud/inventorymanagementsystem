<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\Middleware;

class UserController extends Controller //implements HasMiddleware
{
//      public static function middleware(): array
// {
//     return [
//         new Middleware('permission:View-User', only: ['index']),
//         new Middleware('permission:Create-User', only: ['create','store']),
//         new Middleware('permission:Edit-User', only: ['edit','update']),
//         new Middleware('permission:Delete-User', only: ['destroy'])
//     ];
// }
    public function index()
    { $all_users=User::orderBy('id','Desc')->paginate(5);
      //$role=$all_users->roles->pluck['name']; 
        return view('Users.index',['data'=>$all_users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {$roles= Role::all();
        return view('Users.create_edit',['roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UpdateUserRequest $request)
    { $validated_data= $request->validated();
        
        $validated_data['password'] = Hash::make($validated_data['password']);
      
        $new_user= User::create($validated_data);
        $new_user->SyncRoles($validated_data['roles']);

        return redirect()->route('users.index')->with('success',"User Succesfully Created");
        
    }

    public function edit(string $id)
    {   $roles=Role::all();
        $user=User::find($id);
        $hasRole=$user->roles->pluck('name');
        if(!$user){
            return redirect()->route('users.index')->with('error',"User Not found");
        }

return view('Users.create_edit',['data'=>$user,'roles'=>$roles,'hasRole'=>$hasRole]);

    }


    public function update(UpdateUserRequest $request, string $id)
    {
        $user=User::find($id);
        if(!$user){
            return redirect()->route('users.index')->with('error',"User not found");
        }
       
        $user->name=$request->name ;
        $user->email=$request->email ;
        $user->SyncRoles($request->roles);
        $user->save();
        return redirect()->route('users.index')->with('success',"Succesfully Updated USER");
        
    }

    
    public function destroy(string $id)
    {
      $user= User::find($id) ;
      if(!$user){
        session()->flash('error',"User Not found");
        return response()->json([
        'status'=>false ,
            'message'=>"USer not found"
        ]);
      }
        $user->delete();
session()->flash('success',"Succesfully Deleted User");
return response()->json([
'status'=>true,
]);
    }
}
