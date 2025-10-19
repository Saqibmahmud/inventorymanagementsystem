<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable=['product_name','sku','brands_id','product_categories_id','description','price','stock_quantity','reorder_level'];
public function brands(){
    return $this->belongsTo(Brands::class) ;
}
public function product_categories(){
    return $this->belongsTo(Product_Categories::class,'product_categorie_id','id');
}
public function Sales_item(){
    return $this->hasMany(Sales_item::class,'product_id','id');
}

}
