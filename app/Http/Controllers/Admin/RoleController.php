<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RoleController extends Controller
{
    public function index() : View
    {
        if(FacadesSession::has("message")) {
            toast(session('message'), session('type'))->toToast()->position("bottom-end")->timerProgressBar();
        }

        $roles = Role::whereNotIn('name', ['admin'])->paginate(5);

        return view("admin.roles.index" , compact('roles') );
    }


    public function create()
    {
        return view('admin.roles.create');
    }


    public function store (Request $request) {
        $validated = $request->validate(['name' => ['required','string','min:3' , 'unique:roles,name']]);

        $role = Role::create($validated);
        return redirect()->route('admin.roles.index')->with('message', ['type' =>'success','message'=> 'Role created successfully !']);
    }


    public function destroy(Request $request, Role $role)
    {
        // Role::destroy($role) ;
        $role ->delete();

        return redirect()->route('admin.roles.index')->with(['message'=> 'Role deleted successfully !' , 'type' => 'info']);
    }


    public function edit(Role $role)
    {
        $permissions = Permission::pluck('name','id');
        return view("admin.roles.edit" ,compact('role' , 'permissions')) ;
    }

    public function update(Request $request , Role  $role)
    {
        $validated = $request->validate(['name'=> ['required','string','min:3' , Rule::unique('roles')->ignore($role->id)] ]);

        $role->update($validated);

        return redirect()->route('admin.roles.index')->with( ['message'=> 'Role updated successfully !' , 'type' => 'success']);
    }


    public function givePermission(Request $request , Role $role)
    {
        $permission = Permission::find($request -> permission )->name ;

        if($role->hasPermissionTo($permission) )  {
            return back()->with('hasOne' , " *$permission* permission is already assigned to the *$role->name* role !") ;
        }
        $role -> givePermissionTo( $permission );
        return back()->with(['type'=> 'success' , 'message' => 'Permission assigned successfylly !'] ) ;
    }



    public function revokPermission (Role $role , string $permission )
    {
        $role->revokePermissionTo( $permission );
        return back()->with( ['type'=> 'success' , 'message'=> 'permission revoked successfylly!'] ) ;
    }
}
