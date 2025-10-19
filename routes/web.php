<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductCategoriesController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //Roles
    Route::resource('roles',RoleController::class)->middleware([
    'index'=>'permission:View-Role',
    'create'=>'permission:Add-Role',
    'store'=>'permission:Add-Role',
    'edit'=>'permission:Edit-Role',
    'update'=>'permission:Edit-Role',
    'destroy'=>'permission:Delete-Role'
    ])  ;
    
    //Users
    Route::resource('users',UserController::class)->middleware([
  'index'=>'permission:View-User',
    'create'=>'permission:Add-User',
    'store'=>'permission:Add-User',
    'edit'=>'permission:Edit-User',
    'update'=>'permission:Edit-User',
    'destroy'=>'permission:Delete-User'
    ]);
    
    //PERMISSIONS
    Route::delete('permission/{id}',[PermissionController::class,'destroy'])->name('permissions.destroy')->middleware('permission:Delete-Permission');
    Route::get('permissions/{id}/edit',[PermissionController::class,'edit'])->name('permissions.edit')->middleware('permission:Edit-Permission');
    Route::put('permissions/{id}',[PermissionController::class,'update'])->name('permissions.update')->middleware('permission:Edit-Permission');
    Route::post('permissions',[PermissionController::class,'store'])->name('permissions.store')->middleware('permission:Add-Permission');
    Route::get('permissions/create',[PermissionController::class,'create'])->name('permissions.create')->middleware('permission:Add-Permission');
    Route::get('permissions',[PermissionController::class,'index'])->name('permissions.index')->middleware('permission:View-Permission');
   //BRANDS 
    Route::get('brands/search',[ BrandsController::class,'Search'])->name('brands.search');
    Route::resource('brands', BrandsController::class);
    //Category
    Route::get('categories/search',[ ProductCategoriesController::class,'Search'])->name('categories.search');
    Route::resource('categories', ProductCategoriesController::class);
    //Products
    Route::resource('products', ProductsController::class);
    //Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   
});

require __DIR__.'/auth.php';

