<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_Categories extends Model
{
    protected $table = 'product_categories';
    protected $fillable=['product_category_name','product_category_code','status'];
 public function products(){
    return $this->hasMany(Products::class,'product_categories_id','id');
 }
}
