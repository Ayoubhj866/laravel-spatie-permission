<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index() : View
    {
        $roles = Role::all();
        return view("admin.roles.index" , compact('roles') );
    }


    public function create()
    {
        return view('admin.roles.create');
    }
}
