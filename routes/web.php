<?php

use App\Http\Controllers\BrandsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('ssss');
Route::get('/sum/{a}/{b}',function(int $a,int $b){
    return $a+$b ;

})->whereNumber(['a','b']);
Route::get('/sub/{a}/{b}',function(int $a,int $b){
    return $a-$b ;

})->whereNumber(['a','b']);
//view route


Route::resource('brands',BrandsController::class);
