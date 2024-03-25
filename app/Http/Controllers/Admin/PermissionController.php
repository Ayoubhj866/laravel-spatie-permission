<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

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
}
