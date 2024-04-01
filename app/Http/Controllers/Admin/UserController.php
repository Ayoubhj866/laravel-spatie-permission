<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        if(Session::has("message")) {
            toast(session('message'), session('type'))->toToast()->position("bottom-end")->timerProgressBar() ;
        }

        return view("admin.users.index" ,  [
            'users' => User::where('email' , '=' , Auth::user()->email)->get() ,
        ]) ;
    }


    public function show(User $user )
    {
        if(Session::has("message")) {
            toast(session('message'), session('type'))->toToast()->position("bottom-end")->timerProgressBar() ;
        }

        $roles = Role::pluck('name' , 'id') ;
        return view("admin.users.show" , compact('user' ,'roles') ) ;
    }


    public function assignRole(Request $request, User $user )
    {
        $validated = $request->validate(['role' => 'required']) ;

        $role = Role::find($validated["role"] ) ;

        if($user->hasRole($role -> name)) {
            return back()->with('hasOne','User has already this role');
        }

        $user->assignRole($role->name);
        return back()->with(['type' => 'success' , 'message' => 'Role assigned successfylly !']);
    }



    public function revokeRole(User $user , Role $role )
    {

        if($user->hasRole($role -> name)) {
            $user ->removeRole($role -> name );
            return back() -> with([ "type" => "success" , "message" => "role revoked successfylly !"]);
        }
        return back() -> with([ "type" => "error" , "message" => "role not exist !"]);
    }


 public function destroy(User $user)
 {
    if($user -> hasRole('admin'))
    {
    return back() -> with(['type' => 'error' , 'message'=> 'You can\'t delete admin user!']);
    }

    $user -> delete() ;

    return redirect() ->route('admin.users.index') -> with(['type' => 'success' , 'message'=> 'user  deleted successfully!'] ) ;
 }


}
