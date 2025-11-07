<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Purchases_Items extends Model
{ protected $table='purchases_items';

   

    protected $fillable=['purchase_id','product_id','quantity','purchase_price','total_price','received_quantity'];

public function purchase(){
    return $this->belongsTo(Purchases::class,'purchase_id','id') ;
}

public function product(){
return $this->belongsTo(Products::class,'product_id','id') ;

}





}
