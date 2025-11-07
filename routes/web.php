<?php

use App\Http\Controllers\BranchesController;
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
use App\Http\Controllers\PurchasesController;
use App\Http\Controllers\SalesController;
use App\Models\Branches;

;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //branches
 Route::post('/branches/select_branch', [BranchesController::class, 'set'])->name('branches.set');
Route::get('/branches/select_branch', [BranchesController::class, 'select'])->name('branches.select');
Route::get('branches',[BranchesController::class,'index'])->name('branches.index') ;
Route::get('branches/create',[BranchesController::class,'create'])->name('branches.create') ;
Route::post('branches',[BranchesController::class,'store'])->name('branches.store');
Route::get('branches/{branch}',[BranchesController::class,'show'])->name('branches.show');
Route::put('branches/{branch}',[BranchesController::class,'update'])->name('branches.update');
Route::get('branches/{branch}/edit',[BranchesController::class,'edit'])->name('branches.edit');
Route::delete('branches/{branch}',[BranchesController::class,'destroy'])->name('branches.destroy');
//sales
Route::resource('sales',SalesController::class);

//purchases
    Route::resource('purchases',PurchasesController::class);

    //Suppliers
    Route::resource('suppliers',SupplierController::class);


   //Customers
   Route::get('customers/search',[CustomerController::class,'search'])->name('customers.search') ;
   Route::resource('customers',CustomerController::class);
   
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
    Route::resource('users',UserController::class);

    
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
    Route::resource('brands', BrandsController::class);
   
    //Category
    Route::get('categories/search',[ ProductCategoriesController::class,'Search'])->name('categories.search');
    Route::resource('categories', ProductCategoriesController::class);
  
    //Products
    Route::get('products/price_search',[ProductsController::class,'productPriceByName'])->name('products.price') ;       
    Route::get('products/search', [ProductsController::class, 'search'])->name('products.search');
    Route::resource('products', ProductsController::class);;
    //Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   
});

require __DIR__.'/auth.php';

