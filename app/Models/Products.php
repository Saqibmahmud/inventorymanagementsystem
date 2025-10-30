<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Products extends Model
{
    protected static function booted()
{
    static::addGlobalScope('branch', function ($builder) {
        if(Auth::check() && Auth::user()->branch_id) {
            $builder->where('branch_id', Auth::user()->branch_id);
        }
    });
}

    protected $fillable=['product_name','sku','brands_id','product_categories_id','description','price','reorder_level','supplier_id'];
public function brands(){
    return $this->belongsTo(Brands::class) ;
}
public function product_categories(){
    return $this->belongsTo(Product_Categories::class,'product_categories_id','id');
}
public function sales_item(){
    return $this->hasMany(Sales_item::class,'product_id','id');
}

public function purchases_item(){
    return $this->hasMany(Purchases_Items::class,'product_id','id');
}
public function supplier(){
    return $this->belongsTo(Supplier::class,'supplier_id','id');
}

}
