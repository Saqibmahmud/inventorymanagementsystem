<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Branches;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\Middleware;

class UserController extends Controller 
{

    public function __construct()
    {
        $this->middleware('permission:View-User')->only(['index']);
        $this->middleware('permission:Add-User')->only(['create','store']);
        $this->middleware('permission:Edit-User')->only(['edit','update']);
        $this->middleware('permission:Delete-User')->only(['destroy']);
        
    }

    public function index()
    { $curr_user=Auth::user();
        
        $all_users=User::orderBy('id','Desc')->where('branch_id',$curr_user->branch_id)->paginate(10);
      //$role=$all_users->roles->pluck['name']; 
        return view('Users.index',['data'=>$all_users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles= Role::all();
        $branches= Branches::all();
        return view('Users.create_edit',['roles'=>$roles,'branches'=>$branches]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UpdateUserRequest $request)
    { 
        $validated_data= $request->validated();
        $validated_data['password'] = Hash::make($validated_data['password']);
        $new_user= User::create($validated_data);
        $new_user->SyncRoles($validated_data['roles']);

        return redirect()->route('users.index')->with('success',"User Succesfully Created");
        
    }

    public function edit(string $id)
    {   $roles=Role::all();
        $user=User::find($id);
         $branches= Branches::all();
        $hasRole=$user->roles->pluck('name');
        if(!$user){
            return redirect()->route('users.index')->with('error',"User Not found");
        }

return view('Users.create_edit',['data'=>$user,'roles'=>$roles,'hasRole'=>$hasRole,'branches'=>$branches]);

    }


    public function update(UpdateUserRequest $request, string $id)
    {
        $user=User::find($id);
        if(!$user){
            return redirect()->route('users.index')->with('error',"User not found");
        }
      
        $user->name=$request->name ;
        $user->email=$request->email ;
        $user->branch_id=$request->branch_id;
        $user->save();
        $user->syncRoles($request->roles);
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
