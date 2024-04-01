<?php

use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('admin')->middleware(['auth' , 'role:admin'])->name('admin.')->group(function () {
    Route::get('/', [IndexController::class, 'index']) -> name('index') ;

    Route::resource('/roles' , RoleController::class) ;
    Route::post('/roles/{role}' , [RoleController::class, 'givePermission']) -> name('roles.permission.store')  ;
    Route::post('/roles/{role}/{permission}' , [RoleController::class, 'revokPermission']) -> name('roles.permission.delete')  ;
    Route::resource('/permissions' , PermissionController::class) ;

    Route::post('/permissions/{permission}/{role}', [PermissionController::class,'revokeRole'])->name("permissions.role.delete") ;
    Route::post("/permission/{permission}", [PermissionController::class, 'giveRole'])->name("permissions.role.store") ;

    Route::get('/users' , [UserController::class , 'index']) -> name('users.index') ;
    Route::get("/users/{user}/show" , [UserController::class ,"show"]) -> name("users.show") ;
    Route::post("/users/{user}", [UserController::class, 'assignRole']) -> name("users.roles.store") ;
    Route::post("/users/{user}/{role}" , [UserController::class, 'revokeRole']) -> name('users.role.delete') ;
    Route::delete('/users/{user}' , [UserController::class, 'destroy'])->name('users.destroy') ;

}) ;


require __DIR__.'/auth.php';
