<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index() : View
    {
        $permissions = Permission::all();
        return view('admin.permissions.index' , compact('permissions')) ;
    }

    public function  create ()
    {
        return view("admin.permissions.create") ;
    }


    public function store( Request $request)
    {
        $validated = $request->validate(['name' => ["required" , "string" , "min:3" , 'unique:permissions,name']] ) ;

        Permission::create($validated) ;

        return redirect()->route('admin.permissions.index')->with('message' , ["type" => 'success' , 'message' => 'Permission created successfully !']) ;
    }


    public function edit(Permission $permission)
    {
        $roles =  Role::pluck('name' , 'id');
        return view("admin.permissions.edit" , ["permission" => $permission , 'roles' => $roles ]) ;
    }


    public function update(Request $request , Permission $permission)
    {
        $validated = $request->validate(['name'=> ['required' , 'string' , 'min:3' ]]);

        $permission->update($validated) ;
        return redirect()->route('admin.permissions.index')->with('message' ,  ['type' => 'success' , 'message'=> 'Permission deleted successfully !']);
    }

    public function destroy(Permission $permission)
    {
        $permission->delete() ;

        return  redirect()->route('admin.permissions.index')->with('message' ,['type' => 'success' , 'message' => 'Permission deleted successfully !']) ;
    }


    public function revokeRole (Permission $permission , Role $role)

    {
        if($permission->hasRole($role->name))
        {
            $permission -> removeRole($role -> name) ;
            return back()->with('message', ['type'=> 'success' , 'message'=> 'role deleted successfylly !']) ;
        }

        return back()->with('message', ['type'=> 'error' , 'message'=> 'role not exist !']) ;

    }

    public function giveRole(Request $request , Permission $permission )
    {
        if( $permission->hasRole(Role::find($request->role) ->name)) {
            return back()->with('hasOne', 'Role already exist !') ;
        }

        $permission->assignRole(Role::find($request->role) ->name) ;

        return back()->with('message', ['type' => 'success' , 'message' => 'role assigned successfully !']);
    }
}
