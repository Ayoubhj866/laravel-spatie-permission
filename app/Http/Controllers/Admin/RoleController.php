<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index() : View
    {
        $roles = Role::whereNotIn('name', ['admin'])->paginate(5);

        // $roles = Role::paginate(5);
        return view("admin.roles.index" , compact('roles') )->with('message','Message success !');
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

        return redirect()->route('admin.roles.index')->with('message', ['type' =>'success','message'=> 'Role deleted successfully !']);
    }


    public function edit(Role $role)
    {
        return view("admin.roles.edit" , ['role'=>$role]) ;
    }

    public function update(Request $request , Role  $role)
    {
        $validated = $request->validate(['name'=> ['required','string','min:3' , Rule::unique('roles')->ignore($role->id)] ]);

        $role->update($validated);

        return redirect()->route('admin.roles.index')->with('message', ['type'=> 'success' , 'message' => 'The role has been updated successfully'] );
    }
}
