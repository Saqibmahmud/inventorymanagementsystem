<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable=['product_name','code','brands_id','product_categories_id','description'];
public function brands(){
    return $this->belongsTo(Brands::class) ;
}
public function product_categories(){
    return $this->belongsTo(Product_Categories::class,'product_categorie_id','id');
}

}
