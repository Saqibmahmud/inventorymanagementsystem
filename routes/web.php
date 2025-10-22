<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductCategoriesController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;

;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
//Suppliers
    Route::resource('suppliers',SupplierController::class)->middleware([
'index'=>'permission:View-Supplier',
'create'=>'permission:Add-Supplier',
'store'=>'permission:Add-Supplier',
'edit'=>'permission:Edit-Supplier',
'update'=>'permission:Edit-Supplier',
'destroy'=>'permission:Delete-Supplier'
    ]);


   //Customers
   Route::resource('customers',CustomerController::class)->middleware([
'index'=>'permission:View-Customer',
'create'=>'permission:Add-Customer',
'store'=>'permission:Add-Customer',
'edit'=>'permission:Edit-Customer',
'update'=>'permission:Edit-Customer',
'destroy'=>'permission:Delete-Customer'

   ]);
   
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
    Route::get('permissions/search',[PermissionController::class,'search'])->name('permissions.search')->middleware('permission:View-Permission');
    Route::delete('permission/{id}',[PermissionController::class,'destroy'])->name('permissions.destroy')->middleware('permission:Delete-Permission');
    Route::get('permissions/{id}/edit',[PermissionController::class,'edit'])->name('permissions.edit')->middleware('permission:Edit-Permission');
    Route::put('permissions/{id}',[PermissionController::class,'update'])->name('permissions.update')->middleware('permission:Edit-Permission');
    Route::post('permissions',[PermissionController::class,'store'])->name('permissions.store')->middleware('permission:Add-Permission');
    Route::get('permissions/create',[PermissionController::class,'create'])->name('permissions.create')->middleware('permission:Add-Permission');
    Route::get('permissions',[PermissionController::class,'index'])->name('permissions.index')->middleware('permission:View-Permission');
   
    //BRANDS 
    Route::get('brands/search',[ BrandsController::class,'Search'])->name('brands.search');
    Route::resource('brands', BrandsController::class)->middleware([
'index'=>'permission:View-Brand',
'create'=>'permission:Add-Brand',
'store'=>'permission:Add-Brand',
'edit'=>'permission:Edit-Brand',
'update'=>'permission:Edit-Brand',
'destroy'=>'permission:Delete-Brand'
    ]);
   
    //Category
    Route::get('categories/search',[ ProductCategoriesController::class,'Search'])->name('categories.search');
    Route::resource('categories', ProductCategoriesController::class)->middleware([
'index'=>'permission:View-Category',
'create'=>'permission:Add-Category',
'store'=>'permission:Add-Category',
'edit'=>'permission:Edit-Category',
'update'=>'permission:Edit-Category',
'destroy'=>'permission:Delete-Category'
    ]);
  
    //Products
    Route::resource('products', ProductsController::class)->middleware([
'index'=>'permission:View-Product',
'create'=>'permission:Add-Product',
'store'=>'permission:Add-Product',
'edit'=>'permission:Edit-Product',
'update'=>'permission:Edit-Product',
'destroy'=>'permission:Delete-Product'
    ]);
   
    //Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   
});

require __DIR__.'/auth.php';

