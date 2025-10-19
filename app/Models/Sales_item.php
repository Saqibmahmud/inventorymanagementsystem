<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sales_item extends Model
{
    protected $fillable=['sale_id','product_id','quantity','selling_price','total_price'];

public function sale(){
    return $this->hasMany(Sales_item::class,'sale_id','id') ;
}



}

